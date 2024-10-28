<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SheetDB\SheetDB;

class SheetdbController extends Controller
{
    public function get() {
        $sheetdb = new SheetDB('oyq0u84zkxyt5');
        dd($sheetdb->get());
    }
}