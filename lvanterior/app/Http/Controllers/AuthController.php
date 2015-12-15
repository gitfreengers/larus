<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Cartalyst\Sentinel\Activations\EloquentActivation;

class AuthController extends Controller {

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
            //$remember = (bool) Input::get('remember', false);

            if (Sentinel::authenticate($input))
            {
                return \Redirect::intended('/');
            }
            $errors = 'Invalid login or password.';
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

    /**
     * Show the form for the user registration.
     *
     * @return \Illuminate\View\View
     */

    public function register()
    {
        return view('auth.register');
    }

    /**
     * Handle posting of the form for the user registration.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processRegistration(Request $request)
    {
        $input = $request->all();
        $rules = [
            'first_name'       => 'required',
            'last_name'        => 'required',
            'email'            => 'required|email|unique:users',
            'password'         => 'required',
            'retype_password'  => 'required|same:password',
        ];

        $validator = \Validator::make($input, $rules);

        if ($validator->fails())
        {
            return \Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }
        if ($user = Sentinel::register($input))
        {
            $activation = Activation::create($user);
            $code = $activation->code;

            if(Activation::complete($user, $code))
            {
                return \Redirect::to('login')
                    ->withSuccess('Your accout was successfully created. You might login now.')
                    ->with('userId', $user->getUserId());

            }

        }
        return \Redirect::to('register')
            ->withInput()
            ->withErrors('Failed to register.');
    }




}
