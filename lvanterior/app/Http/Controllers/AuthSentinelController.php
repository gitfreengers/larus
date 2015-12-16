<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Native\Facades\Sentinel;


class AuthSentinelController extends Controller {
    /**
     * Show the form for logging the user in.
     *
     * @return \Illuminate\View\View
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Handle posting of the form for logging the user in.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processLogin(Request $request)
    {
        try
        {
            $input = $request->all();
            $rules = [
                'email'    => 'required|email',
                'password' => 'required',
            ];
            $validator = \Validator::make($input, $rules);
            if ($validator->fails())
            {
                return \Redirect::back()
                    ->withInput()
                    ->withErrors($validator);
            }


            if (Sentinel::authenticate($input,false))
            {
                return \Redirect::intended('/');
            }
            $errors = 'El correo electrónico y/o contraseña no coinciden.';
        }
        catch (NotActivatedException $e)
        {
            $errors = 'Account is not activated!';
            return Redirect::to('login')->with('user', $e->getUser());
        }
        catch (ThrottlingException $e)
        {
            $delay = $e->getDelay();
            $errors = "Your account is blocked for {$delay} second(s).";
        }
        return \Redirect::back()
            ->withInput()
            ->withErrors($errors);
    }

    public function logout(){
        Sentinel::logout();
        return \Redirect::to('login');
    }





}
