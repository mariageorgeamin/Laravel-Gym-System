<?php

namespace App\Http\Controllers;
use App\Coach;
use App\Gym;
use Illuminate\Http\Request;

class CoachesController extends Controller
{
    
    public function index()
    {
        $coaches = Coach::all();
        return view('Coaches.index',[
            'coaches' => $coaches
        ]);
    }

    public function edit($coachId)
    {
        $coach = Coach::findOrFail($coachId);
        $gyms=Gym::all();
        // dd($coach);
        return view('Coaches.edit', [
            'coach' => $coach,
            'gyms' => $gyms,
        ]);
    }


    public function update(Request $request,$coachId)
    {
        $coachId = Coach::findOrFail($coachId);
        $coachId->update($request->all());
        return redirect()->route('Coaches.index');
    }


    public function create()
    {
        
        $coaches = Coach::all();
        $gyms = Gym::all();
        return view('Coaches.create',[
            'coaches'=>$coaches,
            'gyms'=>$gyms,
        ]);

    }


    public function store(Request $request)
    {
        Gym::create($request->all());
        return view('Coaches.index');
    }

    public function show($coachId)
    {
        $gym=Gym::all();
        $coach = Coach::find($coachId);
        return view('Coaches.show', [
            "coach"=>$coach,
            "gym"=>$gym
            ]);
    }
}
