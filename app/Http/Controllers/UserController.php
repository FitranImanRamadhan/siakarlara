<?php

namespace App\Http\Controllers;

use App\Models\Positions;
use App\Models\Golongan;
use App\Models\User; //Mengeksekusi database
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

        return redirect()->route('login')->with('success', 'Registration success. Please login!');
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

    public function create()
    {
        $title = "Tambah data user";
        $jbt = Positions::all();
        $gln = Golongan::all();
        return view('users.create', compact(['title','jbt','gln']));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'jabatan_id' => 'required',
            'nip' => 'required|unique:users',
            'password' => 'required',
            'position' => 'required',
            'departement' => 'required',
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
            'jabatan_id' => 'required',
            'golongan_id' => 'required',
            'nip' => 'required|unique:users,nip,' . $id,
            'position' => 'required',
            'departement' => 'required',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->jabatan_id = $request->jabatan_id;
        $user->golongan_id = $request->golongan_id;
        $user->nip = $request->nip;
        $user->position = $request->position;
        $user->departement = $request->departement;
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
