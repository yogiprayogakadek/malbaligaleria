<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ModController extends Controller
{
    public function index()
    {
        return view('subdomain.mod.index');
    }
}
