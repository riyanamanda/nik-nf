<?php

namespace App\Http\Controllers;

use App\Models\Patient;

class HomeController extends Controller
{
    public function index()
    {
        $patients = Patient::query()
            ->select('id', 'refId', 'nik', 'getDate', 'statusRequest')
            ->where('id', null)
            ->where('statusRequest', 0)
            ->paginate(10);

        return view('home', compact('patients'));
    }
}
