<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Schedule;

use App\Models\Vet;

use Carbon\Carbon;

class ScheduleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request){
        $vets= Vet::all();
        $schedule= Schedule::all();
        return view('schedule.create')->with(compact('vets','schedule'));
    }

    public function store(Request $request){

        $user= \Auth::user();
        
        $evento= Schedule::create($request->all());
        $evento->user_id = $user->id;
    }

    public function show(Schedule $evento){
        $evento= Schedule::all();
        return response()->json($evento);
    }

    public function edit($id){
        $evento= Schedule::find($id);

        $evento->start = Carbon::createFromFormat('Y-m-d H:i:s', $evento->start)->format('Y-m-d');
        $evento->end = Carbon::createFromFormat('Y-m-d H:i:s', $evento->end)->format('Y-m-d');

        return response()->json($evento);
        
    }

    public function destroy($id){

        $user= \Auth::user();

        $evento= Schedule::find($id);

        if($user && $evento->user_id == $user->id){
            $evento->delete();
            return redirect()->route('home');
        }

    }

    public function update(Request $request, Schedule $schedule){
        $schedule->update($request->all());
        return response()->json($schedule);
    }
}
