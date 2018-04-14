<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Card;

class CustomerController extends Controller
{



    /**
     * Creates a new customer.
     *
     * @return Customer The customer created.
     */
    public function create(Request $request)
    {
        $customer = new Customer();

        $customer->user_username = $request->input('user_username');
        $customer->name = $request->input('name');
        $customer->address = $request->input('address');
        $customer->loyaltyPoints = $request->input('loyaltyPoints');
        $customer->newsletter = $request->input('newsletter');
        $customer->inactive = $request->input('inactive');


        $customer->save();

        return $customer;
    }


    public function delete(Request $request, $id)
    {
        /*$card = Card::find($id);

        $this->authorize('delete', $card);
        $card->delete();

        return $card;*/
    }

}