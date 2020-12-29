<?php

namespace Scoris\Auth\Http\Controllers\Api;

use Illuminate\Http\Request;
use Scoris\Base\Http\Controllers\BaseController;
use Scoris\Auth\Repositories\Interfaces\AuthInterface;

class UserController extends BaseController
{
    protected $authRepository;

    public $loginAfterSignUp = true;

    public function __construct(AuthInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(Request $request)
    {
        return $this->authRepository->login($request);
    }

    public function logout(Request $request)
    {
        return $this->authRepository->logout($request);
    }

    public function store(Request $request)
    {
        return $this->authRepository->store($request);
    }

    public function update($id, Request $request)
    {
        return $this->authRepository->update($id, $request);
    }

    public function update_password($id, Request $request)
    {
        return $this->authRepository->update_password($id, $request);
    }

    public function sendmail_resetpw(Request $request)
    {
        return $this->authRepository->sendmail_resetpw($request);
    }

    public function form_reset_password()
    {
        return $this->authRepository->form_reset_password();
    }

    public function reset_password(Request $request)
    {
        return $this->authRepository->reset_password($request);
    }

    public function set_active_user(Request $request)
    {
        return $this->authRepository->set_active_user($request);
    }

}
