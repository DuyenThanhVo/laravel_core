<?php

namespace Scoris\Telegram\Http\Controllers;

use Scoris\Base\Http\Controllers\BaseController;

class TelegramController extends BaseController
{
    public function index() {
        return view('plugins/telegram::index');
    }
}
