<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin/home';

    public function __construct()
    {
      $this->middleware('guest')->except('logout');
    }

    public function guard()
    {
     return Auth::guard('admin');
    }
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.home');
        }else{
            return view('auth.admin_login');
        }
    }

    public function login(Request $request)
    {
    $this->validate($request, [
        'username' => 'required', //VALIDASI KOLOM USERNAME
        //TAPI KOLOM INI BISA BERISI EMAIL ATAU USERNAME
        'password' => 'required|string|min:6',
        'captcha' => 'required|captcha'
    ]);

    //LAKUKAN LOGIN
    if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])) {
        //JIKA BERHASIL, MAKA REDIRECT KE HALAMAN HOME
        return redirect()->route('admin.home');
    }
    //JIKA SALAH, MAKA KEMBALI KE LOGIN DAN TAMPILKAN NOTIFIKASI
    throw ValidationException::withMessages([
        'username' => ['Username/Password salah.'],
    ]);

    return redirect()->route('admin.login')->with(['username' => 'Username/Password salah!']);
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('admin/login')
            ->withSuccess('Terimakasih, selamat datang kembali!');
    }
}
