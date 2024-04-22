<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function adminHome(): View
    {
        return view('admin.home');
    }

    public function managerHome(): View
    {
        return view('manager.home');
    }

    public function profile(): View
    {
        return view('profile.index');
    }

    public function editprofile(): View
    {
        return view('profile.edit');
    }

    public function updateprofile(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->storeAs('avatars', $filename, 'public');
            $data['avatar'] = $filename;
        }

        $user->update($data);

        return redirect()->route('profile')
                        ->with('success','Profile updated successfully');
    }
}
