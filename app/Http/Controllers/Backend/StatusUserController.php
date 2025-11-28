<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatusUserController extends Controller
{
    public function pending()
    {
        return view('maintenance.status.pending');
    }

    public function rejected()
    {
        return view('maintenance.status.rejected');
    }
}
