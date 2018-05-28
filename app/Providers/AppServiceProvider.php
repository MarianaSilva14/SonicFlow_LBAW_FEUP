<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Product;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      View::composer(['common.header','pages.administration'], function ($view) {
            $view->with('categories',DB::table('category')->get());
        });
      View::composer(['partials.compareOverlay'], function ($view) {
        $compareProducts = array();
        if(array_key_exists('compareProducts',$_COOKIE)){
          $temp = json_decode($_COOKIE['compareProducts'],TRUE);
          foreach ($temp as $key => $value) {
            array_push($compareProducts,Product::find($key));
          }
        }
        $view->with('compareProds',$compareProducts);
      });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
