<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Hash;
use Exception;

class LoginBasic extends Controller
{
  public function index()
  {
    if (auth()->check() && auth()->user()->id) {
      return redirect('/'); // Redirect to the home page if userType has a value
    }
    return view('content.authentications.auth-login-basic');
  }

  public function login(Request $request)
  {
    $data = request(['username', 'password']);

    $hashedInputPassword = Hash::make($data['password']);
    //dd($hashedInputPassword);
    //$pword = Crypt::encryptString($data['password']);

    try {
      $this->checkTooManyFailedAttempts();

      $credentials = [
        'username' => $request['username'],
        'password' => $request['password'],
      ];

      if (!Auth::attempt($credentials)) {
        RateLimiter::hit($this->throttleKey(), $seconds = 3600);

        throw new Exception(
          'Invalid username or password. Attempts remaining: ' . RateLimiter::remaining($this->throttleKey(), 11)
        );
      }

      RateLimiter::clear($this->throttleKey());

      return response()->json([
        'status_code' => 0,
        'Message' => '',
      ]);
    } catch (Exception $error) {
      //dd($error);
      return response()->json([
        'status_code' => 1,
        'Message' => $error->getMessage(),
      ]);
    }
  }

  public function throttleKey()
  {
    return Str::lower(request('username')) . '|' . request()->ip();
  }

  public function checkTooManyFailedAttempts()
  {
    if (!RateLimiter::tooManyAttempts($this->throttleKey(), 10)) {
      return;
    }

    $seconds = RateLimiter::availableIn($this->throttleKey());

    throw new Exception('Too many login attempts. Try again in ' . gmdate('H:i:s', $seconds));
  }
}
