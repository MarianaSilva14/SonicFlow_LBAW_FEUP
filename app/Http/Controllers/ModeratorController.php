<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\User;

class ModeratorController extends Controller
{
    /**
     * Shows the page of a moderator.
     *
     * @return Response
     */
    public function show()
    {
        $user = Auth::user();

        if ($user->role === 'MOD')
            return view('pages.moderation');
        else
            return redirect(url('homepage'));
    }

}