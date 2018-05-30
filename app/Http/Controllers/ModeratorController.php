<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Comment;
use App\Customer;
use App\Moderator;


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
      return view('pages.moderation',['comments'=>Comment::getModView(), 'numberOffenses' => Comment::getNumberOffenses(), 'banned'=>Customer::getUsersBanned()]);
    else
      return redirect(url('homepage'));
  }

  // return form to fill out to create a new moderator
  public function create(){
      return view('pages.addModerator',[]);
  }

  // post here to insert into db
    public function createModerator(Request $request){

        $user = null;

        try{
            DB::beginTransaction();

            $user = User::create([
                'username' => $request->input('username'),
                'password' => bcrypt($request->input('password')),
                'email' => $request->input('email'),
                'role' => 'MOD'

            ]);

            $moderator = Moderator::create([
                'user_username' => $user['username'],
            ]);
            $moderator->save();

            DB::commit();

        } catch(\Exception $e){
            DB::rollBack();
        }

        return redirect(route('moderation'));
    }
}
