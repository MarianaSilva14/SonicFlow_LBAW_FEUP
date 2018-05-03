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

        if (Auth::check() && Auth::user()->role === 'ADMIN'){
            $mods = $this->getModerators();
            return view('pages.administration', ['moderators'=> $mods]);
        }
        else
            return redirect(url('homepage'));
    }

    public function getModerators(){
      $user = Auth::user();

      if ($user->role === 'ADMIN'){
        $mods = DB::table('moderator')
                  ->join('user','moderator.user_username','=','user.username')
                  ->orderBy('joindate', 'desc')
                  ->get();

        return $mods;
      }
      else
        return [];
    }


}
