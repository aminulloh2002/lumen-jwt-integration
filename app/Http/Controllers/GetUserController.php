<?php

namespace App\Http\Controllers;
use App\Models\User;


class GetUserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

    public function index()
    {
        return response()->json([
            'data' =>  User::all()
        ],200);
    }
}
