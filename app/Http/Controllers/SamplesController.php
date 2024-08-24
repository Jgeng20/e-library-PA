<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SamplesController extends Controller
{
    public function datepicker()
    {
        return view('pages.samples.datepicker');
    }
}