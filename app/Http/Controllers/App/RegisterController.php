<?php

namespace App\Http\Controllers\App;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use App\Repositories\Admin\Crud\UserRepository;

class RegisterController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('guest');

        $this->userRepository = $userRepository;
    }

    /**
     * Show the user a registration form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRegister($foreignReferrer = false)
    {
        return view('app.pages.register', compact('foreignReferrer'));
    }

    public function postRegister(Request $request, $foreignReferrer = false)
    {
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'firm' => 'required',
            'phone' => 'required|min:6',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ];

        if ( ! $foreignReferrer) {
            $rules['crd'] = 'required';
        }

        $this->validate($request, $rules);

        $input = $request->only(array_keys($rules));
        if ( ! $foreignReferrer) {
            $input['crd'] = $request->crd;
        }

        $user = $this->userRepository->create($input);
        Auth::guard()->login($user);

        event(new Registered($user));

        if ($foreignReferrer) {
            successMessage(trans('register.success.bd-fr'));
        }
        else {
            successMessage(trans('register.success.bd'));
        }

        return redirect()->route('offerings.index');
    }
}
