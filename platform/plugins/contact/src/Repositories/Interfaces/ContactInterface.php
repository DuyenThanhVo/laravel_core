<?php

namespace Scoris\Contact\Repositories\Interfaces;
use Illuminate\Http\Request;

interface ContactInterface
{
    public function list_user_contact($id);
    public function index();
    public function store(Request $request);
    public function delete($id);
}

