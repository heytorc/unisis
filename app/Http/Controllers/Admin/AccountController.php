<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    public function index()
    {   
        $uid = auth()->user()->id;
        return view('admin.account.index', compact('uid'));
    }
}
