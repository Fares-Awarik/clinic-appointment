<?php

namespace App\Http\Controllers;
use App\Models\Doctor;

abstract class Controller
{
    public function index()
{
    $doctors = Doctor::all();
    return view('doctors.index', compact('doctors'));
}
}
