<?php

namespace Scoris\Auth\Repositories\Interfaces;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

interface AuthInterface
{
    public function __construct ( Model $model );
    public function login ( Request $request );
    public function logout ( Request $request );
    public function store ( Request $request );
    public function update ( int $id, Request $request );
    public function update_password ( int $id, Request $request );
    public function sendmail_resetpw ( Request $request );
    public function form_reset_password ();
    public function reset_password ( Request $request );
    public function set_active_user ( Request $request );
}

