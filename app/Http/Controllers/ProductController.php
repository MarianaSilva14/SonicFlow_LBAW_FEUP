<?php


namespace App\Http\Controllers;

use App\Answer;
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

      //+title:String Category
      //+categoryID:Integer 	Category
      //+productBrand:String 	Product Brand
      //+minPrice:Integer 	Price Lower Bound
      //+maxPrice:String 	Price Higher Bound
      //+productAvailability:boolean 	Product Availability


      return json_encode($products);
    }

    public function getProductBySku(Integer $sku){
      $product = DB::table('product')->where('sku', $sku)->first();
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
      $this->authorize('edit');

      return view('pages.newProduct');
    }

    public function show($sku){
      $product = Product::find($sku);
      return view('pages.product',['editable'=>FALSE,'product'=>$product,'attributes'=>$product->attributes()]);
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
}
