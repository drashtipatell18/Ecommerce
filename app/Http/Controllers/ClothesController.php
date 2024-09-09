<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClothesController extends Controller
{
    public function clothes(){
        return view('clothes.view_clothes');
    }   
    public function clothesCreate(){
        return view('clothes.create_clothes');
    }
}
