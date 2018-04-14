<?php

namespace App\Policies;

use App\User;
use App\Customer;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class CustomerPolicy
{
    use HandlesAuthorization;

    public function profile(User $user, Customer $customer)
    {
      // Only a customer can see his profile
      return $user->username == $customer->user_username;
    }

    public function list(User $user)
    {
      // Any user can list its own cards
      return Auth::check();
    }

    public function create(User $user)
    {
      // Any user can create a new card
      return Auth::check();
    }
}
