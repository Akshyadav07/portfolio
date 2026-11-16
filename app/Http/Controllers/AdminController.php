<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function edit(){
        $profile = Profile::first();
    }
}
