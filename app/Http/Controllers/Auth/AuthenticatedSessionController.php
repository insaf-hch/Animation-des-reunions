<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthenticatedSessionController extends Controller {
  public function create() { return view('auth.login'); }
  public function store(Request $req) {
    $req->validate(['email'=>'required|email','password'=>'required']);
    if(!Auth::attempt($req->only('email','password'), $req->boolean('remember'))) {
      return back()->withErrors(['email'=>'Email ou mot de passe incorrect.'])->withInput()->with('_form','login');
    }
    $req->session()->regenerate();
    return redirect()->intended(route('dashboard'));
  }
  public function destroy(Request $req) {
    Auth::logout();
    $req->session()->invalidate();
    $req->session()->regenerateToken();
    return redirect()->route('login');
  }
}
