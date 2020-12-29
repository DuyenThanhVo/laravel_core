<?php

namespace Scoris\Contact\Http\Controllers;

use Scoris\Base\Http\Controllers\BaseController;

class ContactController extends BaseController
{
    public function index() {
        return view('plugins/contact::index');
    }
}
