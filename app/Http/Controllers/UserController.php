<?php

namespace App\Http\Controllers;

use App\Models\Positions;
use App\Models\Golongan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PDF;

class UserController extends Controller
{
    public function register()
    {
        $data['title'] = 'Register';
        return view('user/register', $data);
    }

    public function register_action(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nip' => 'required|unique:users',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
        ]);

        $user = new User([
            'name' => $request->name,
            'nip' => $request->nip,
            'password' => Hash::make($request->password),
        ]);
        $user->save();

        return redirect()->route('users.index')->with('success', 'Data berhasil ditambahkan!');
    }


    public function login()
    {
        $data['title'] = 'Login';
        return view('user/login', $data);
    }

    public function login_action(Request $request)
    {
        $request->validate([
            'nip' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt(['nip' => $request->nip, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'password' => 'Wrong nip or password',
        ]);
    }

    public function password()
    {
        $data['title'] = 'Change Password';
        return view('user/password', $data);
    }

    public function password_action(Request $request)
    {
        $request->validate([
            'old_password' => 'required|current_password',
            'new_password' => 'required|confirmed',
        ]);
        $user = User::find(Auth::id());
        $user->password = Hash::make($request->new_password);
        $user->save();
        $request->session()->regenerate();
        return back()->with('success', 'Password changed!');
    }
    
    public function profile()
{
    $user = Auth::user(); // Get the authenticated user

    if ($user) {
        $title = "User Profile";
        return view('user.profile', compact('user', 'title'));
    } else {
        return redirect()->route('login')->with('error', 'You must be logged in to view your profile.');
    }
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function index()
    {
        $title = "Data user";
        $users = User::with('jabatan','golongan')->paginate(15);
        return view('users.index', compact(['users', 'title']));
    }

    public function create(Request $request)
{
    $title = "Create User / Register";
    $jbt = Positions::all();
    $gln = Golongan::all();

    if ($request->isMethod('post')) {
        $request->validate([
            'name' => 'required',
            'golongan_id' => 'required',
            'nip' => 'required|unique:users',
            'password' => 'required',
            'position' => 'required',
        ]);

        // Create a new user based on the registration data
        $user = User::create([
            'name' => $request->input('name'),
            'golongan_id' => $request->input('golongan_id'),
            'nip' => $request->input('nip'),
            'password' => Hash::make($request->input('password')),
            'position' => $request->input('position'),
        ]);

        // You can also log in the user automatically here if needed

        return redirect()->route('users.index')->with('success', 'User has been created and registered successfully.');
    }

    return view('users.create', compact(['title', 'jbt', 'gln']));
}


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'golongan_id' => 'required',
            'nip' => 'required|unique:users',
            'password' => 'required',
            'position' => 'required',
        ]);

        User::create($request->post());

        return redirect()->route('users.index')->with('success', 'users has been created successfully.');
    }

    public function edit(User $user)
    {
        
        $title = "Edit Data position";
        $jbt = Positions::all();
        $gln = Golongan::all();
        return view('users.edit', compact('user', 'title','jbt','gln'));
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'golongan_id' => 'required',
            'nip' => 'required|unique:users,nip,' . $id,
            'position' => 'required',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->golongan_id = $request->golongan_id;
        $user->nip = $request->nip;
        $user->position = $request->position;
        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    

    public function exportPdf()
    {
        $title = "Laporan Data User";
        $users = User::orderBy('id', 'asc')->get();
        $pdf = PDF::loadView('users.pdf', compact(['users', 'title']));
        return $pdf->stream('laporan-user-pdf');
    }
}
