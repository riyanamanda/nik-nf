<?php

namespace App\Http\Controllers;

use App\Models\IndikatorKeperawatan;
use Illuminate\Http\Request;

class KeperawatanController extends Controller
{
    function index()
    {
        $keperawatan = IndikatorKeperawatan::paginate(20);

        return view('keperawatan.index', compact('keperawatan'));
    }
}
