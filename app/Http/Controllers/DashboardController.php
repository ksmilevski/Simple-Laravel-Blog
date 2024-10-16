<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\HasMiddleware;

class DashboardController extends Controller
{

    public function index(){

         $posts=Auth::user()->posts()->latest()->paginate(4);
        return view('users.dashboard',['posts'=>$posts]);

    }

    public function userPosts(User $user)
    {
        $userPosts = $user->posts()->latest()->paginate(4);
        return view('users.posts',[
            'posts'=>$userPosts,
            'user'=>$user
        ]);
    }

}
