<?php

namespace App\Http\Controllers;

use App\Models\Sessions;
use Illuminate\Http\Request;

use App\Models\Prosecution;
use App\Models\Courts;
use App\Models\Lawyers;
use App\Models\Judges;

class SessionsController extends Controller
{

    public function index()
    {

        $sessions = Sessions::with('Prosecutions','Courts' ,'Lawyers' ,'Judge','User')->get();

        foreach ($sessions as  $value) {

            $lawyerTo = Lawyers::find($value->lawyerTo_name);
        }


        return view ('dashboard.sessions.index',compact('sessions','lawyerTo'));
    }

 
    public function create()
    {
        $prosecutions = Prosecution::all();
        $courts = Courts::all();
        $lawyers = Lawyers::all();
        $judge = Judges::all();

        return view ('dashboard.sessions.create' ,compact('prosecutions','courts','lawyers','judge'));
    }


    public function store(Request $request)
    {
        $request_data = $request->except(['_token']);
        $request->validate([
            'session_date' => 'required',
            'session_time' => 'required',
            'prose_date'  => 'required',
            'court_name'=> 'required',
           'lawyer_name'=> 'required',
         'lawyerTo_name' => 'required',
            'judge_name'=> 'required',
          'end_decision'=> 'required',
        ]);

        Sessions::create([
            'session_time' => $request_data['session_time'],
            'session_date' => $request_data['session_date'],
            'prose_date' => $request_data['prose_date'],
            'court_name' =>$request_data['court_name'],
            'lawyer_name' => $request_data['lawyer_name'],
            'lawyerTo_name' => $request_data['lawyerTo_name'],
            'judge_name' => $request_data['judge_name'],
            'session_decision' => $request_data['session_decision'],
            
            'end_decision' => $request_data['end_decision'],
            'command' => $request_data['command'],
            
            'user_no' => auth()->user()->id,
        ]);

        session()->flash('success',__('site.created_successfully'));

        return redirect()->route('sessions.index');  
    }


    public function show(Sessions $sessions)
    {
        //
    }


    public function edit( $id)
    {

        $sessions = Sessions::find($id);

        if (!$sessions) {
            
            session()->flash('error',__('Not found (:'));

            return redirect()->route('sessions.index');  
        }

        $prosecutions = Prosecution::all();
        $courts = Courts::all();
        $lawyers = Lawyers::all();
        $judge = Judges::all();

        return view ('dashboard.sessions.edit' ,compact('sessions','prosecutions','courts','lawyers','judge'));
    }


    public function update(Request $request,  $id)
    {
        $sessions = Sessions::find($id);
        
        $request_data = $request->except(['_token']);
        $request->validate([
            'session_date' => 'required',
            'session_time' => 'required',
            'prose_date'  => 'required',
            'court_name'=> 'required',
           'lawyer_name'=> 'required',
         'lawyerTo_name' => 'required',
            'judge_name'=> 'required',
          'end_decision'=> 'required',
        ]);

        $sessions->update([
            'session_time' => $request_data['session_time'],
            'session_date' => $request_data['session_date'],
            'prose_date' => $request_data['prose_date'],
            'court_name' =>$request_data['court_name'],
            'lawyer_name' => $request_data['lawyer_name'],
            'lawyerTo_name' => $request_data['lawyerTo_name'],
            'judge_name' => $request_data['judge_name'],
            'session_decision' => $request_data['session_decision'],
            
            'end_decision' => $request_data['end_decision'],
            'command' => $request_data['command'],
            
            'user_no' => auth()->user()->id,
        ]);

        session()->flash('success',__('site.created_successfully'));

        return redirect()->route('sessions.index');  
    }


    public function destroy( $id)
    {
        Sessions::find($id)->delete();

        session()->flash('success',__('site.deleted_successfully'));

        return redirect()->route('sessions.index');
    }
}
