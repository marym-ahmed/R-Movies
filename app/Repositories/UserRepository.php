<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return view('auth.login');
    }

    public function welcome()
    {
        return view('welcome');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $users = $this->userRepository->searchByName($search);
        return view('auth.search', compact('users'));
    }

    public function userLogin(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')->withSuccess('Signed in');
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }

    public function registration()
    {
        return view('auth.registration');
    }

    public function userRegistration(RegistrationRequest $request)
    {
        $data = $request->validated();
        $this->userRepository->create($data);

        return redirect("dashboard")->withSuccess('You have signed-in');
    }

    public function edit($userId)
    {
        $user = $this->userRepository->find($userId);
        return view('edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, $userId)
    {
        $data = $request->validated();
        $this->userRepository->update($userId, $data);

        return redirect()->route('login')->with('success', 'User has been updated successfully');
    }

    public function dashboard()
    {
        if (Auth::check()) {
            return view('dashboard');
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function signOut()
    {
        Auth::logout();
        return redirect('login');
    }

    public function destroy($userId)
    {
        $this->userRepository->delete($userId);
        return view('auth.login');
    }

    public function allUsers()
    {
        $users = $this->userRepository->all();
        return view('auth.index', compact('users'));
    }

    public function about()
    {
        return view('about');
    }
}
