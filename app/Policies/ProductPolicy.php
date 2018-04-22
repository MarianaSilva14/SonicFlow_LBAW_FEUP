<?php

namespace App\Policies;

use App\User;
use App\Product;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ProductPolicy
{
    use HandlesAuthorization;

    public function edit(User $user)
    {
      // Only a administrator can modify a Product
      return $user->isAdmin();
    }

    public function createNewProduct(User $user)
    {
      // Only a administrator can create a Product
      return true;
    }
}
