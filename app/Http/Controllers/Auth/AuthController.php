<?php

namespace App\Http\Controllers\Auth;

use App\Models\Blog;
use App\Models\Like;
use App\Models\User;
use App\Rules\registerRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function login()
    {
        if (!Auth::check()) {
            return view('auth.login');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect("dashboard")->withSuccess('Welkom terug');
        }
        return back()->withInput()->withError('Oops! verkeerde inloggegevens');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        if (!Auth::check()) {
            return view('auth.registration');
        } else {
            return redirect()->back();
        }
    }


    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:2|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ],
            [
                'name.required' => 'Voer een naam in',
                'name.min' => 'Naam moet minimaal 2 tekens bevatten',
                'name.unique' => 'De ingevoerde naam bestaat al bij ons',
                'email.unique' => 'Het ingevoerde email bestaat al bij ons',
                'email.required' => 'Voer een email in',
                'password.required' => 'Voer een wachtwoord in',
                'password.min:6' => 'Het wachtwoord moet minimaal 6 tekens bevatten',
            ]
        );

        $data = $request->all();

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $check = $this->create($data);
        }

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect("dashboard")->withSuccess('Welkom! je bent nu ingelogd');
        } else {
            return redirect('registratie')->withError('Oops! Er ging iets fout. Probeer het opnieuw');
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect('login')->withSuccess('Je bent uitgelogd');
    }

    public function notFoundPage()
    {
        return view('notfound');
    }

    public function getProfilePage()
    {
        $user = Auth::user();
        $blogs = Blog::where('user_id', $user->id)->get();
        $blog = Blog::where('user_id', $user->id)->first();
        $likes = Like::where('likeable_id', $blog->id)->get();

        $comments = DB::table('comments')->where('user_id', $user->id)->get();

        return view('auth.profile', compact('user', 'blog', 'blogs', 'likes', 'comments'));
    }

    public function saveProfileData(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'naam' => 'required|min:4|string|max:255',
                'email' => 'required|email|string|max:255'
            ]
        );

        $user = Auth::user();

        if ($validator->fails()) {
            return redirect('profile')->withErrors('Kan velden niet leeg laten');
        } else {
            $user->update([
                'name' => $request->naam,
                'email' => $request->email
            ]);

            return redirect('profile')->withSuccess('Profiel aangepast ');
        }
    }

    public function veranderWachtwoord()
    {
        return view('auth.change-password');
    }

    public function updateWachtwoord(Request $request)
    {
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);


        #Match The Old Password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->withError("Oud wachtwoord komt niet overeen");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->withSuccess("Wachtwoord aangepast");
    }

    public function veranderProfilePicure(Request $request)
    {
        if ($request->hasFile('profile_picure')) {
            $profile_picure = $request->file('profile_picure');
            $filename = time() . '.' . $profile_picure->getClientOriginalExtension();
            $path = 'public/images/profile_picures/' . $filename;
            Image::make($profile_picure)->resize(300, 300)->save($path);

            $user = Auth::user();
            $user->profile_picure = $filename;
            $user->save();
        } else {
            return redirect('/profile')->withError('Geen Foto geselecteerd');
        }

        return redirect('/profile')->withSuccess('Profiel foto is veranderd');
    }

    public function maakPrive(Request $request)
    {
        $user = User::find($request->member_id);
        $user->is_private = $request->status;
        $user->save();

        if ($request->status == 1){
            $arr = array('message' => 'Je profiel is nu prive');
        }else{
            $arr = array('message' => 'Je profiel is nu Openbaar');
        }
        echo json_encode($arr);
    }
}
