<?php


namespace App\Http\Controllers;

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
     * @return JSON The products.
     */
    public function getProducts(Request $request)
    {

        //+title:String Category
        //+categoryID:Integer 	Category
        //+productBrand:String 	Product Brand
        //+minPrice:Integer 	Price Lower Bound
        //+maxPrice:String 	Price Higher Bound
        //+productAvailability:boolean 	Product Availability

 /*       $card = new Card();

        $this->authorize('create', $card);

        $card->name = $request->input('name');
        $card->user_id = Auth::user()->id;
        $card->save();

        return $card;*/
        return json_encode("");
    }

    public function getProductBySku(Integer $sku){


    }

    public function getProductByName(Integer $sku){


    }

    public function getDiscounted(){


    }
}