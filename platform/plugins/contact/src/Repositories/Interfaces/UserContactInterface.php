<?php

namespace Scoris\Contact\Repositories\Interfaces;
use Illuminate\Http\Request;

interface UserContactInterface
{
    public function store(Request $request);
    public function delete($id);
    public function export_csv();
    public function import_csv(Request $request);
}

