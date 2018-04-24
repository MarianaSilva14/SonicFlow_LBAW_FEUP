<?php


namespace App\Http\Controllers;

use App\Answer;
use App\AttributeProduct;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Customer;
use App\User;
use App\Product;
use phpDocumentor\Reflection\Types\Integer;
use App\Rating;

class ProductController extends Controller
{

  /**
   * Gets products based on filters.
   *
   * @param Request $request
   * @return JSON The products.
   */
  public function getProducts(Request $request){
      $products = Product::getProductsReference($request);
      return json_encode($products);
  }

  public function getProductBySku(Integer $sku){
    $product = Product::find($sku);
    return json_encode($product);
  }

  public function getProductsByName(String $title){
      $products = Product::getProductByName($title);
      return json_encode($products);
  }

  public function getDiscounted(){
    $discounted_products = Product::getDiscountedProducts();
    return json_encode($discounted_products);
  }

  public function editForm($sku){
    try {
      $this->authorize('edit',Product::class);
    } catch (Exception $e) {
      return redirect('homepage');
    }
    $product = Product::find($sku);
    return view('pages.editProduct',['product'=>$product,
                                      'attributes'=>$product->attributes(),
                                      'categories'=>DB::table('category')->get()
                                    ]);
  }

  public function update(Request $request, $sku){
    try {
      $this->authorize('edit',Product::class);
    } catch (Exception $e) {
      return redirect('homepage');
    }

    $product = Product::findOrFail($sku);

    if($request->hasFile('pictures')){
      $files = $request->file('pictures');
      $picPath = "";
      foreach ($files as $key=>$file) {
        if($key==0){
          $picPath .= $file->store('public/'.$sku, ['public']);
        }else{
          $picPath .= ';'.$file->store('public/'.$sku, ['public']);
        }
      }
      $product->picture = $picPath;
    }

    try {
      $product->title = $request->input('title');
      $product->description = $request->input('description');
      $product->price = $request->input('price');
      $product->discountprice = $request->input('discountPrice');
      $product->stock = $request->input('stock');
      $product->save();
    } catch (\Exception $e) {
      return $e->getMessage();
    }

    $attributes_to_update = $request->input('productAttributes');
    foreach ($attributes_to_update as $attribute_id => $attribute_value){
      if ($attribute_value == '')
        $attribute_value = 'N/A';
      $product->setProductAttribute($attribute_id,$attribute_value);
    }
      return view('pages.product', ['product' => $product,'images'=>$product->getImages(),'attributes' => $product->attributes() ]);
  }

  public function show($sku){
    $product = Product::findOrFail($sku);
    return view('pages.product',['product'=>$product,'images'=>$product->getImages(),'attributes'=>$product->attributes()]);
  }

  public function create(){
    try{
      $this->authorize('createNewProduct',Product::class);
    }catch(Exception $e){
      return redirect('homepage');
    }
    return view('pages.addProduct',['categories'=>DB::table('category')->get()]);
  }

  public function addComment($sku, Request $request){
      $user = Auth::user();
      $comment_text = $request->input('commentary');

      try {
        $comment = Comment::create([
          'user_username' => $user->username,
          'commentary' => $comment_text,
          'flagsno' => 0,
          'product_idproduct' => $sku
        ]);
      } catch (\Exception $e) {
        return $e->getMessage();
      }

      $parent_id = intval($request->input('parent_id'));
      if ($parent_id != null){
          $child_id = $comment->id;
          try {
            Answer::create([
                'comment_idparent' => $parent_id,
                'comment_idchild' => $child_id
            ]);
          } catch (\Exception $e) {
            return $e->getMessage();
          }
      }

      return url('product', ['id' => $sku]);
  }

  public function commentFlag($id){
    $comment = Comment::findOrFail($id);
    try {
      $comment->flag();
    } catch (\Exception $e) {
     return response('Unable to flag comment',500);
    }
    return response('',200);
  }

  public function commentDelete($id){
    $comment -> Comment::findOrFail($id);
    try {
      $comment->deleteContent();
    } catch (\Exception $e) {
      return response('Unable to delete content',500);
    }

    return response('',200);
  }

  public function updateRating($sku, Request $request){
    $user = Auth::user();
    $rating = Rating::where([['customer_username','=',$user->username],['product_idproduct','=',$sku]])->first();
    if($rating == null)
      $rating = Rating::create(['customer_username'=>$user->username, 'product_idproduct'=>$sku, 'value' => $request->input('value')]);
    else
      Rating::where([['customer_username','=',$user->username],['product_idproduct','=',$sku]])->update(['value' => $request->input('value')]);
    return json_encode($request->input('value'));
  }
}
