<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Schedule;

use App\Models\Vet;

class ScheduleController extends Controller
{
    public function index(Request $request){
        $vets= Vet::all();
        return view('schedule.create')->with(compact('vets'));
    }

    public function store(Request $request){
        $evento= Schedule::create($request->all());

    }
}
