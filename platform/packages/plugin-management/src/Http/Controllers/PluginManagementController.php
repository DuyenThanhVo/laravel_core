<?php

namespace Scoris\PluginManagement\Http\Controllers;

use Illuminate\Http\Request;
use Scoris\Base\Http\Controllers\BaseController;

class PluginManagementController extends BaseController {
    public function index(Request $request) {
        return view('packages/plugin-management::index');
    }
}
