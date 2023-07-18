<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Home extends Controller
{
     public function welcomepage() {
        return view('welcome');
     }

     public function registrationpage() {
      return view("registration");
     }
}
