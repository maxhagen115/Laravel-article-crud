<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserPageController extends Controller
{
    public function userpage()
    {
        $data = User::orderBy('created_at', 'desc')
        ->where('id', '!=', auth()->id())->get();

        return view('users.userpage', compact('data'));
    }

    public function showUser($id)
    {
        try{
            $userdata = User::findorFail($id);
            $blogdata = Blog::where('user_id', $userdata->id)->get();
            return view('users.user', compact('userdata', 'blogdata'));
        }
        catch(ModelNotFoundException $exception){
            return redirect()->to('users');
        }
    }
}

