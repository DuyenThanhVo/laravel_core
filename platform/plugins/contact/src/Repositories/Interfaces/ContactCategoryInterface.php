<?php

namespace Scoris\Contact\Repositories\Interfaces;
use Illuminate\Http\Request;

interface ContactCategoryInterface
{
    public function index();
    public function store(Request $request);
    public function delete($id);
}

