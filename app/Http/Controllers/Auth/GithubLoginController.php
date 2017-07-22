<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Entity\User;
use Socialite;
use Auth;

class GithubLoginController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $gitUser = Socialite::driver('github')->user();
        $user = User::where('email', $gitUser->getEmail())->first();

        if(is_null($user)) {
            $nameArray = explode(' ', $gitUser->getName());

            $user = new User();
            $user->first_name = $nameArray[0];
            $user->last_name = (!empty($nameArray[1])) ? $nameArray[1] : '';
            $user->email = $gitUser->getEmail();
            $user->password = bcrypt($gitUser->token);
            $user->is_active = true;
            $user->is_admin = false;
            $user->save();
        }

        Auth::login($user);

        return redirect()->route('cars.index');
    }
}