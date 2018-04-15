<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\User;

class AdministratorController extends Controller
{

    /**
     * Shows the page of an admin.
     *
     * @return Response
     */
    public function show()
    {
        $user = Auth::user();

        if ($user->role === 'ADMIN')
            return view('pages.administration');
        else
            return redirect(url('homepage'));
    }


}