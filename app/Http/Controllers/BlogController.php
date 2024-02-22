<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BlogController extends Controller
{

    public function dashboard()
    {
        $user_id = optional(Auth::user())->id;
        $user = User::find($user_id);

        if (Auth::check()) {
            return view('dashboard')
                ->with('blogs', $user->blog)
                ->with('user', Auth::user());
        }

        return redirect('login');
    }

    public function return_dashboard()
    {
        if (Auth::check()) {
            return redirect('dashboard');
        } else {
            return redirect('login');
        }
    }

    public function blogs()
    {
        $data = Blog::orderBy('created_at', 'desc')->get();

        return view('blogs.blogs', compact('data'));
    }

    public function showBlog($id)
    {

        try{
            $blog = Blog::findorFail($id);
            return view('blogs.blog', compact('blog'));
        }
        catch(ModelNotFoundException $exception){
            return redirect()->to('blogs');
        }
    }

    public function addBlog()
    {
        return view('blogs.add-blog');
    }

    public function saveBlog(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'beschrijving' => 'required',
            'image' => 'image|nullable|max:2048|dimensions:max_height=250'
        ], [
            'image.dimensions' => 'Je foto mag een maximale hoogte hebben van 250 pixels',
            'beschrijving.required' => 'Het beschrijvingveld is verplicht',
            'title.required' => 'Het titelveld is verplicht.'
        ]);

        $title = $request->title;
        $beschrijving = $request->beschrijving;
        $image = $request->file('image');

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('/images/blogimg'), $imageName);
        } else {
            $imageName = 'default.jpeg';
        }

        if (Blog::where('title', $title)->exists()) {
            return redirect("/add-blog")->withInput()->withError('Titel bestaat al');
        } else {
            $blog = new Blog();
            $blog->title = $title;
            $blog->beschrijving = $beschrijving;
            $blog->image = $imageName;
            $blog->user_id = auth()->user()->id;
            $blog->user_name = auth()->user()->name;
            $blog->save();

            return redirect("/blog/$blog->id")->withSuccess('Blog is aangemaakt');
        }
    }

    public function updateBlog(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'beschrijving' => 'required',
            'image' => 'image|nullable|max:2048|dimensions:max_height=250'
        ], [
            'image.dimensions' => 'Je foto mag een maximale hoogte hebben van 250 pixels',
            'beschrijving.required' => 'Het beschrijvingveld is verplicht',
            'title.required' => 'Het titelveld is verplicht.'
        ]);

        $id = $request->id;
        $title = $request->title;
        $beschrijving = $request->beschrijving;
        $image = $request->image;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('/images/blogimg'), $imageName);
        } else {
            $imageName = 'default.jpeg';
        }

        if ($request->hasFile('image')) {
            $image = $imageName;
            Blog::where('id', '=', $id)->update([
                'title' => $title,
                'beschrijving' => $beschrijving,
                'image' => $image
            ]);
        } else {
            Blog::where('id', '=', $id)->update([
                'title' => $title,
                'beschrijving' => $beschrijving,
            ]);
        }
        return redirect("/blog/$id")->withSuccess('Blog is bewerkt');
    }

    public function editBlog($id)
    {
        $data = Blog::where('id', '=', $id)->first();
        if (auth()->user()->id !== $data->user_id) {
            return redirect('/blogs')->with('error', 'Deze pagina is niet voor u bestemd');
        }
        return view('blogs.edit-blog', compact('data'));
    }

    public function deleteBlog($id)
    {
        $blog = Blog::find($id);
        if (auth()->user()->id !== $blog->user_id) {
            return redirect('/blogs')->with('error', 'Deze pagina is niet voor u bestemd');
        }

        if ($blog->image != 'default.jpeg') {
            Storage::delete('public/images/' . $blog->image);
        }

        $blog->delete();
        return redirect('/blogs')->withSuccess('Blog is verwijderd');
    }
}
