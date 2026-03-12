<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class RegisteredUserController extends Controller {
  public function create() { return view('auth.login'); }
  public function store(Request $req) {
    $req->validate(['name'=>'required|string|max:255','email'=>'required|email|unique:users','password'=>'required|min:8|confirmed','role'=>'required']);
    $user = User::create(['name'=>$req->name,'email'=>$req->email,'password'=>Hash::make($req->password),'role'=>$req->role]);
    Auth::login($user);
    return redirect()->route('dashboard');
  }
}
