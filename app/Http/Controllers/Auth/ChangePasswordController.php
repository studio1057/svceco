<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use Auth;
use Illuminate\Contracts\View\View as ViewInterface;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Toast;
use View;
use Hash;
use Redirect;

class ChangePasswordController extends Controller
{
    /**
     * @return ViewInterface
     */
    public function get()
    {
        return View::make('dashboard.password');
    }

    /**
     * @param ChangePasswordRequest $request
     *
     * @return RedirectResponse
     */
    public function post(ChangePasswordRequest $request)
    {
        $data = $request->all();
        $user           = Auth::user();

        if (! Hash::check($data['password'], $user->password)) {
            return Redirect::back()->withErrors(['current_password' => 'Your current password is incorrect.']);
        }

        $user->password = bcrypt($data['new_password']);
        $user->save();

        Toast::success('Your password has been updated.');

        return new RedirectResponse('/dashboard');
    }
}
