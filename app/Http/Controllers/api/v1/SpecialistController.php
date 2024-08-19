<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Specialist;

class SpecialistController extends Controller
{
    //
    /**
     * Display all the specialist data in the database
     */
    public function index()
    {
        return Specialist::all();
    }
}
