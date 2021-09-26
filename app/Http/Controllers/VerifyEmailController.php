<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
=======
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
>>>>>>> refs/remotes/origin/master
use App\Models\User;

class VerifyEmailController extends Controller
{
<<<<<<< HEAD

=======
>>>>>>> refs/remotes/origin/master
    public function __invoke(Request $request): RedirectResponse
    {
        $user = User::find($request->route('id'));

        if ($user->hasVerifiedEmail()) {
<<<<<<< HEAD
            return redirect(env('FRONT_URL') . 'api/user/email/verify/already-success');
=======
            return redirect(env('FRONT_URL') . '/email/verify/already-success');
>>>>>>> refs/remotes/origin/master
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

<<<<<<< HEAD
        return redirect(env('FRONT_URL') . 'api/user/email/verify/success');
=======
        return redirect(env('FRONT_URL') . '/email/verify/success');
>>>>>>> refs/remotes/origin/master
    }
}