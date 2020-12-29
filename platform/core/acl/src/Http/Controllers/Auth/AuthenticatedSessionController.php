<?php

namespace Scoris\ACL\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Scoris\ACL\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Assets;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        Assets::addStylesDirectly('vendor/core/css/pages/login/classic/login-4.css');
        return view('core/acl::auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param \App\Http\Requests\Auth\LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {

        do_action(USER_ACTION_BEFORE_LOGIN);

        $request->authenticate();

        $request->session()->regenerate();

        do_action(USER_ACTION_AFTER_LOGIN);

        return redirect()->route('dashboard');
    }

    /**
     * Destroy an authenticated session.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        do_action(USER_ACTION_BEFORE_LOGOUT);

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        do_action(USER_ACTION_AFTER_LOGOUT);

        return redirect('/');
    }
}
