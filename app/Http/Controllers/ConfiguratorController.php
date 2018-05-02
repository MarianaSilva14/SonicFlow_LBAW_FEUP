<?php


namespace App\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class ConfiguratorController extends Controller
{
  public function show()
  {
    $count = DB::table('category')->count();

    for($i = 1; $i <= $count; $i++){
      $productsByCategory[$i-1] = $this->getProductsByCategory($i);
    }

    return view('pages.configurator',['productsByCategory'=>$productsByCategory]);

  }

  public function getProductsByCategory(int $category_id){
    return DB::table('product')
              ->where('product.category_idcat', $category_id)
              ->join('category','product.category_idcat','=','category.id')
              ->get();
  }
}
