<?php

namespace App\Policies;

use App\User;
use App\Comment;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class CommentPolicy
{
    use HandlesAuthorization;

    public function edit(User $user, Comment $comment)
    {
      // Only the owner can modify his comment
      return $user->usename == $comment->user_username;
    }
}
