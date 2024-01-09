<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Session\Store;
//use Symfony\Component\HttpFoundation\Session\Session;

use Session;
use App\Models\User;
use Illuminate\Contracts\Session\Session as ContractsSessionSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Illuminate\Support\Facades\Session as FacadesSession;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;

class userAuthController extends Controller
{
   public function index()
    {
       return view('auth.login');
    }
    public function welcome()
    {
       return view('welcome');}

    public function search(Request $request){
        $search = $request->input('search');
        $users = user::query()->where('name', 'LIKE', "%{$search}%")->get();
        return view('auth.search', compact('users'));
    }

    public function userLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('Signed in');
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }

    public function registration()
    {
        return view('auth.registration');
    }

    public function userRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect("dashboard")->withSuccess('You have signed-in');
    }

    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])

      ]);
    }



    /////////////////////////////////*

    public function edit(user $user)
    {
        return view('edit',compact('user'));
    }
    public function update(Request $request, user $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',

        ]);

        $user->fill($request->post())->save();

        return redirect()->route('login')->with('success','user Has Been updated successfully');
    }



    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function signOut() {
       // Session()::flush();
        session()->flush();
        Auth::logout();

        return Redirect('login');
    }
    public function destroy(user $user)
    {
        $user->delete();
     return view('auth.login');

    }
    public function allUsers()
    {
       // $user= User::get();
        //return view('auth.index', compact('users'));
        return view('auth.index')->with('users',User::all());
    }
    public function about()
       {
          return view('about');
        }


    }
