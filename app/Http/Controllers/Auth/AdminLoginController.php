<?php 

namespace App\Http\Controllers\Auth;


use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminLoginController extends Controller
{
	use AuthenticatesUsers;

    protected $guard = 'admin';
    protected $redirectTo = '/home';
    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    protected function guard()
    {
        return Auth::guard($this->guard);
    }

    public function login(Request $request)
    {     

        if (auth()->guard("admin")->attempt(['email' => $request->email, 'password' => $request->password])) {
           
            return redirect()->route("home");
        }
       dd("Gagal");
    }

    public function logout(Request $request)
    {
        Auth::guard("admin")->logout();
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect()->guest(route("adminLogin"));
    }
}
