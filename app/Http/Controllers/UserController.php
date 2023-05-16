<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user.access');
    }

    //     public function showProfile()
    // {
    //     $user = Auth::user();
    //     $name = $user->name;
    //     $email = $user->email;

    //     return view('admin.profile')->with('name',$name);
    // }

    public function details(string $id)
    {
        // $user = auth()->user();
        // return view('admin.profile', compact('user'));

        $user = User::findOrFail($id);
        return view('user.details')->with('user', $user);
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('user.edit')->with('user', $user);
    }

    public function editConfirm(Request $request, $id)
    {
        $user = User::findOrFail($id);
        // dd($request->has('name'));
        // Validate the form submission
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'password' => 'nullable|min:8',
            'role' => ['required'],
            'birthday' => ['nullable'],
            'profile' => ['required', 'string'],
            'phone' => ['nullable'],
            'address' => ['nullable'],
        ]);

        $user->update($validatedData);

        // Display the confirmation page with the edited information
        return view('user.edit-confirm', compact('user'));
        // return view('user.edit-confirm', ['user' => $user, 'data' => $validatedData]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        $user->birthday = $request->input('birthday');
        $user->profile = $request->input('profile');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');

        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();


        return redirect()->route('admin.dashboard', ['id' => $user->id])->with('success', 'User information updated successfully.');


        // public function update(Request $request, $id)
        // {
        //     $user = User::find($id);
        //     $user->name = $request->input('name');
        //     $user->email = $request->input('email');
        //     $user->role = $request->input('role');
        //     $user->birthday = $request->input('birthday');
        //     $user->profile = $request->input('profile');
        //     $user->phone = $request->input('phone');
        //     $user->address = $request->input('address');
        //     $user->update();

        //     return redirect()->route('admin.dashboard', ['id' => $user->id])->with('success', 'User information updated successfully.');

        // $user = User::findOrFail($id);

        // $password = $user->password;
        // if ($password) {
        //     $user->password = bcrypt($password);
        // }
        // $user->update($request->all());
        // // return redirect()->route('user.show');
        // return redirect()->route('admin.dashboard', ['id' => $user->id])->with('success', 'User information updated successfully.');

        // Redirect to a success page or display a success message
        // return redirect()->route('user.details', ['id' => $user->id])->with('success', 'User information updated successfully.');
    }

    //     public function update(Request $request, string $id)
    //     {
    //         $this->validate($request, [
    //             'name' => ['required', 'string', 'max:255'],
    //             'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //             'password' => ['required', 'string', 'min:8', 'confirmed'],
    //             'role' => ['required'],
    //             'birthday' => ['nullable'],
    //             'profile' => ['required', 'string'],
    //             'phone' => ['nullable'],
    //             'address' => ['nullable'],
    //         ]);

    //         //create post
    //         $user = User::find($id);
    //         $user->name = $request->input('name');
    //         $user->email = $request->input('email');
    //         $user->role = $request->input('role');
    //         $user->birthday = $request->input('birthday');
    //         $user->profile = $request->input('profile');
    //         $user->phone = $request->input('phone');
    //         $user->address = $request->input('address');
    //         $user->save();

    //         return redirect('/admin/dashboard')->with('success', 'User Updated');
    //     }
}