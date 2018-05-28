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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
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
      return json_encode($products->get());
  }

  public function getProductBySku(Integer $sku){
    $product = Product::find($sku);
    return json_encode($product);
  }

  public function getProductsByName(String $title){
      $products = Product::getProductByName($title);
      return json_encode($products);
  }

  public function getDiscounted(Request $request){
      $discounted_products = Product::getDiscountedProducts($request);
      $discounted = [];
      foreach ($discounted_products as $dis){
          $view = View::make('partials.product_mini', ['product' => $dis,'profile'=>FALSE]);
          array_push($discounted, (string) $view);
      }

      return json_encode($discounted);
  }

  public function getBestSellers(Request $request){
      $bestsellers_products = Product::getBestSellersProducts($request);
      $bestsellers = [];
      foreach ($bestsellers_products as $bs){
          $view = View::make('partials.product_mini', ['product' => $bs,'profile'=>FALSE]);
          array_push($bestsellers, (string) $view);
      }

      return json_encode($bestsellers);
  }

  public function getRecommendations(Request $request){
      $recommendations_products = Product::getRecommendationsProducts($request);

      $recommendations = [];
      foreach ($recommendations_products as $rp){
          $view = View::make('partials.product_mini', ['product' => $rp,'profile'=>FALSE]);
          array_push($recommendations, (string) $view);
      }

      return json_encode($recommendations);
  }

  public function editForm($sku){
    try {
      $this->authorize('edit',Product::class);
    } catch (Exception $e) {
        Log::error($e->getMessage());
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
        Log::error($e->getMessage());
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

    $validatedData = $request->validate([
       'title' => 'required',
       'description' => 'nullable',
       'price' => 'required',
       'discountprice' => 'nullable',
       'stock' => 'required'
     ]);

    try {
      $product->title = $request->input('title');
      $product->description = $request->input('description');
      $product->price = $request->input('price');
      $product->discountprice = $request->input('discountPrice');
      $product->stock = $request->input('stock');
      $product->save();
    } catch (\Exception $e) {
        Log::error($e->getMessage());
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
    $favorite = $product->isFavorite();
    return view('pages.product',['product'=>$product,'images'=>$product->getImages(),'attributes'=>$product->attributes(),'favorite'=>$favorite]);
  }

  public function create(){
    try{
      $this->authorize('createNewProduct',Product::class);
    }catch(Exception $e){
        Log::error($e->getMessage());
        return redirect('homepage');
    }
    return view('pages.addProduct',['categories'=>DB::table('category')->get()]);
  }

  public function addComment($sku, Request $request){
    if (!Auth::check()) {
      return redirect(route('login'));
    }

    $user = Auth::user();
    if($user->isBanned() || !$user->isCustomer()){
      return redirect(route('product',['id'=>$sku]));
    }
    $comment_text = $request->input('commentary');

    $validatedData = $request->validate([
       'commentary' => 'required',
       'parent_id' => 'nullable'
    ]);

    Product::findOrFail($sku);

    try {
      $comment = Comment::create([
        'user_username' => $user->username,
        'commentary' => $comment_text,
        'flagsno' => 0,
        'product_idproduct' => $sku
      ]);
    } catch (\Exception $e) {
        Log::error($e->getMessage());
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
            Log::error($e->getMessage());
            return $e->getMessage();
        }
    }

    return redirect(route('product', ['id' => $sku,'#comment']));
  }

  public function commentFlag($id){
    $comment = Comment::findOrFail($id);
    try {
      $comment->flag();
    } catch (\Exception $e) {
        Log::error($e->getMessage());
        return response('Unable to flag comment',500);
    }
  }

  public function commentDelete($id){
    $comment = Comment::findOrFail($id);
    try {
      $this->authorize('edit',$comment);
      if (Auth::user()->isCustomer()) {
        $comment->deleteContentCust();
      }else if(Auth::user()->isModerator()){
        $comment->deleteContentMod();
      }
    } catch (\Exception $e) {
        Log::error($e->getMessage());
        return response(json_encode($comment).json_encode(Auth::user()),500);
    }
  }

  public function commentApprove($id){
    $comment = Comment::findOrFail($id);
    try {
      $this->authorize('edit',$comment);
      $comment->approve();
    } catch (\Exception $e) {
        Log::error($e->getMessage());
        return response('Unable to approve comment',500);
    }
    return response($comment->id,200);
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

  public function createProduct(Request $request){
    $validatedData = $request->validate([
       'title' => 'required',
       'category' => 'required',
       'price' => 'required',
       'discountPrice' => 'nullable',
       'rating' => 'nullable',
       'stock' => 'required',
     ]);

    $title = $request->input('title');
    $category = $request->input('category');
    $standard_price = $request->input('price');
    $discount_price = $request ->input('discountPrice');
    $available_stock = $request->input('stock');

    $product = Product::create([
      'title' => $title,
      'category_idcat' => $category,
      'price' => $standard_price,
      'discountprice' => $discount_price,
      'rating' => 0,
      'stock' => $available_stock
    ]);

    if($request->hasFile('pictures')){
      $files = $request->file('pictures');
      $picPath = "";
      foreach ($files as $key=>$file) {
        if($key==0){
          $picPath .= $file->store('public/'.$product->sku, ['public']);
        }else{
          $picPath .= ';'.$file->store('public/'.$product->sku, ['public']);
        }
      }
      $product->picture = $picPath;
    }

    $product->save();

    return redirect()->route('product',['id'=>$product->sku]);
  }

  public function listProducts(Request $request){
      $query_products = Product::getProductsReference($request);

      $query_products->leftJoin('favorite',function ($join) {
          if(Auth::check())
              $username = Auth::user()->username;
          else
              $username = "";
          $join->on('product.sku','=','favorite.product_idproduct')
              ->where('favorite.customer_username','=', $username);
      });
      $query_products->join('category','category.id','=','product.category_idcat');

      $products = $query_products->paginate(12);

      $products->appends(['categoryID' => $request->input('categoryID'),
                          'title' => $request->input('title'),
                          'productAvailability' => $request->input('productAvailability'),
                          'minPrice' => $request->input('minPrice'),
                          'maxPrice' => $request->input('maxPrice'),
                          'sortBy' => $request->input('sortBy')
                        ]);

      return view('pages.listProducts',['products'=>$products, 'profile'=>false,'request'=>$request]);
  }

  public function compare(){
    $products = array();
    $prodAttributes = array();
    $temp = json_decode($_COOKIE['compareProducts'],TRUE);
    foreach ($temp as $key => $value) {
      $tempProd = Product::find($key);
      if($tempProd){
        array_push($products,$tempProd);
        $attributes = $tempProd->attributes();
        $attributes->sku = $tempProd->sku;
        array_push($prodAttributes,$attributes);
      }
    }
    if (empty($products)) {
      return redirect(route('homepage'));
    }else{
      return view('pages.comparator',['products'=>$products,'prodAttributes'=>$prodAttributes]);
    }
  }
}
