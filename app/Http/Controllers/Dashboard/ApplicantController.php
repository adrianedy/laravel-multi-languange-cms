<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    public function index()
    {
        return view('dashboard.applicant');
    }

    public function show()
    {
        return view('dashboard.applicant-detail');
    }
}
