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

class ProductController extends Controller
{

<<<<<<< HEAD
  /**
   * Gets products based on filters.
   *
   * @param Request $request
   * @return JSON The products.
   */
  public function getProducts(Request $request)
  {
    $query = DB::table('product');

    $catgoryID = intval($request->input('categoryID'));
    if ($catgoryID != null){
        $query = $query->where('category_idCat', $catgoryID);
    }

    $minPrice = floatval($request->input('minPrice'));
    $maxPrice = floatval($request->input('maxPrice'));
    if ( $minPrice != null && $maxPrice != null && ($minPrice < $maxPrice)){
        $query = $query->whereBetween('price', [$minPrice, $maxPrice]);
    }

    $available = filter_var($request->input('productAvailability'), FILTER_VALIDATE_BOOLEAN);
    if ( $available != null){
        if ($available){
            $query = $query->where('stock', '>', 0);
        }
        else{
            $query = $query->where('stock', '=', 0);
        }
    }

    $title = $request->input('title');
    if ($title != null){
        $query = $query
            ->whereRaw('search @@ plainto_tsquery(\'english\',?)', [$title])
            ->orderByRaw('ts_rank(search,  plainto_tsquery(\'english\',?) DESC',[$title]);
    }

    $products = $query->get();
    return json_encode($products);
  }

  public function getProductBySku(Integer $sku){
    $product = Product::find($sku);
    return json_encode($product);
  }

  public function getProductsByName(String $title){
    $products = DB::table('product')
        ->whereRaw('search @@ plainto_tsquery(\'english\',?)', [$title])->get();
    return json_encode($products);
  }

  public function getDiscounted(){
    $discounted_products = DB::table('product')->whereNotNull('discountprice')->get();
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

    $product = Product::find($sku);

    if($request->hasFile('pictures')){
      $files = $request->file('pictures');
      foreach ($files as $key=>$file) {
        if($key==1){
          $picPath .= $request->file('picture')->store('public/'.$sku, ['public']);
        }else{
          $picPath .= ';'.$request->file('picture')->store('public/'.$sku, ['public']);
        }
      }
      $product->picture = $picPath;
    }

    $product->title = $request->input('title');
    $product->description = $request->input('description');
    $product->price = $request->input('price');
    $product->discountprice = $request->input('discountPrice');
    $product->stock = $request->input('stock');
=======
    /**
     * Gets products based on filters.
     *
     * @param Request $request
     * @return JSON The products.
     */
    public function getProducts(Request $request)
    {
        $query = DB::table('product');

        $catgoryID = intval($request->input('categoryID'));
        if ($catgoryID != null) {
            $query = $query->where('category_idCat', $catgoryID);
        }

        $minPrice = floatval($request->input('minPrice'));
        $maxPrice = floatval($request->input('maxPrice'));
        if ($minPrice != null && $maxPrice != null && ($minPrice < $maxPrice)) {
            $query = $query->whereBetween('price', [$minPrice, $maxPrice]);
        }

        $available = filter_var($request->input('productAvailability'), FILTER_VALIDATE_BOOLEAN);
        if ($available != null) {
            if ($available) {
                $query = $query->where('stock', '>', 0);
            } else {
                $query = $query->where('stock', '=', 0);
            }
        }

        $title = $request->input('title');
        if ($title != null) {
            $query = $query
                ->whereRaw('search @@ plainto_tsquery(\'english\',?)', [$title])
                ->orderByRaw('ts_rank(search,  plainto_tsquery(\'english\',?) DESC', [$title]);
        }

        $products = $query->get();

        //+title:String Category
        //+categoryID:Integer 	Category
        //+productBrand:String 	Product Brand
        //+minPrice:Integer 	Price Lower Bound
        //+maxPrice:String 	Price Higher Bound
        //+productAvailability:boolean 	Product Availability


        return json_encode($products);
    }

    public function getProductBySku(Integer $sku)
    {
        $product = DB::table('product')->where('sku', $sku)->first();
        return json_encode($product);
    }

    public function getProductsByName(String $title)
    {
        $products = DB::table('product')
            ->whereRaw('search @@ plainto_tsquery(\'english\',?)', [$title])->get();
        return json_encode($products);
    }

    public function getDiscounted()
    {
        $discounted_products = DB::table('product')->whereNotNull('discountprice')->get();
        return json_encode($discounted_products);
    }

    public function editForm($sku)
    {
        try {
            $this->authorize('edit', Product::class);
        } catch (Exception $e) {
            return redirect('homepage');
        }
        $product = Product::find($sku);
        return view('pages.editProduct', ['product' => $product,
            'attributes' => $product->attributes(),
            'categories' => DB::table('category')->get()
        ]);
    }

    public function update(Request $request, $sku)
    {
        try {
            $this->authorize('edit', Product::class);
        } catch (Exception $e) {
            return redirect('homepage');
        }

        $product = Product::find($sku);

        if ($request->hasFile('pictures')) {
            $files = $request->file('pictures');
            foreach ($files as $key => $file) {
                if ($key == 1) {
                    $picPath .= $request->file('picture')->store('public/' . $sku, ['public']);
                } else {
                    $picPath .= ';' . $request->file('picture')->store('public/' . $sku, ['public']);
                }
            }
            $product->picture = $picPath;
        }

        $product->title = $request->input('title');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->discountprice = $request->input('discountPrice');
        $product->stock = $request->input('stock');

        $product->save();


        $attributes_to_update = $request->input('attributes');
        foreach ($attributes_to_update as $attribute_id => $attribute_value) {
            if ($attribute_value == '')
                $attribute_value = 'NA';

            DB::table('attribute_product')
                ->where('product_idproduct', $sku)
                ->where('attribute_idattribute', $attribute_id)
                ->update(['value' => $attribute_value]);
        }
>>>>>>> d896db8663157ddb4cd4729ef4e9d5148590d502

    $product->save();

<<<<<<< HEAD
=======
        return view('pages.product', ['product' => $product, 'attributes' => $product->attributes()]);
>>>>>>> d896db8663157ddb4cd4729ef4e9d5148590d502

    $attributes_to_update = $request->input('attributes');
    foreach ($attributes_to_update as $attribute_id => $attribute_value){
      if ($attribute_value == '')
        $attribute_value = 'N/A';
      $product->setAttribute($attribute_id,$attribute_value);
    }
<<<<<<< HEAD
      return view('pages.product', ['product' => $product, 'attributes' => $product->attributes() ]);
  }

  public function show($sku){
    $product = Product::find($sku);
    return view('pages.product',['product'=>$product,'attributes'=>$product->attributes()]);
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

      $comment = Comment::create([
          'user_username' => $user->username,
          'commentary' => $comment_text,
          'flagsno' => 0,
          'product_idproduct' => $sku
      ]);

      $parent_id = intval($request->input('parent_id'));
      if ($parent_id != null){
          $child_id = $comment->id;

          Answer::create([
              'comment_idparent' => $parent_id,
              'comment_idchild' => $child_id
          ]);
      }

      return url('product', ['id' => $sku ]);
  }
=======

    public function show($sku)
    {
        $product = Product::find($sku);
        return view('pages.product', ['product' => $product, 'attributes' => $product->attributes()]);
    }

    public function create()
    {
        try {
            $this->authorize('createNewProduct', Product::class);
        } catch (Exception $e) {
            return redirect('homepage');
        }
        return view('pages.addProduct', ['categories' => DB::table('category')->get()]);
    }

    public function addComment($sku, Request $request)
    {
        $user = Auth::user();
        $comment_text = $request->input('commentary');

        $comment = Comment::create([
            'user_username' => $user->username,
            'commentary' => $comment_text,
            'flagsno' => 0,
            'product_idproduct' => $sku
        ]);

        $parent_id = intval($request->input('parent_id'));
        if ($parent_id != null) {
            $child_id = $comment->id;

            Answer::create([
                'comment_idparent' => $parent_id,
                'comment_idchild' => $child_id
            ]);
        }

        return url('product', ['id' => $sku]);
    }
>>>>>>> d896db8663157ddb4cd4729ef4e9d5148590d502
}
