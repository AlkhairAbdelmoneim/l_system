<?php

namespace App\Http\Controllers;

use App\Models\Appeal;
use App\Models\Prosecution;
use Illuminate\Http\Request;

class AppealController extends Controller
{

    public function index()
    {

        $appeal = Appeal::with('Prosecution')->get();
        return view ('dashboard.appeal.index' ,compact('appeal'));
    }


    public function create()
    {
        $prosecution = Prosecution::all();
        return view ('dashboard.appeal.create' ,compact('prosecution'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'appeal_date' => 'required',
            'prosecution_date' => 'required',
            'provirus_judge' => 'required',
            'appeal_judge' => 'required',
            'judge_meant_date' => 'required',

        ]);

     $request_data = $request->except(['_token']);

     Appeal::create([
         'appeal_date' => $request_data['appeal_date'],
         'prosecution_date' => $request_data['prosecution_date'],
         'provirus_judge' => $request_data['provirus_judge'],
         'appeal_judge' => $request_data['appeal_judge'],
         'judge_meant_date' => $request_data['judge_meant_date'],
         'command' => $request_data['command'],
         'user_no' => auth()->user()->id,
     ]);

        session()->flash('success',__('site.created_successfully'));

        return redirect()->route('appeal.index');  
    }


    public function show(Appeal $appeal)
    {
        //
    }


    public function edit( $id)
    {
        $appeal = Appeal::find($id);
        $prosecution = Prosecution::all();

        if (!$appeal) {
            
            session()->flash('error',__('Not found (:'));

            return redirect()->route('appeal.index');  
        }
        return view('dashboard.appeal.edit' ,compact('appeal','prosecution'));
    }


    public function update(Request $request, $id)
    {
        $appeal = Appeal::find($id);

        $request->validate([
            'appeal_date' => 'required',
            'prosecution_date' => 'required',
            'provirus_judge' => 'required',
            'appeal_judge' => 'required',
            'judge_meant_date' => 'required',

        ]);

     $request_data = $request->except(['_token']);

     $appeal->update([
         'appeal_date' => $request_data['appeal_date'],
         'prosecution_date' => $request_data['prosecution_date'],
         'provirus_judge' => $request_data['provirus_judge'],
         'appeal_judge' => $request_data['appeal_judge'],
         'judge_meant_date' => $request_data['judge_meant_date'],
         'command' => $request_data['command'],
         'user_no' => auth()->user()->id,
     ]);

        session()->flash('success',__('site.updated_successfully'));

        return redirect()->route('appeal.index'); 
    }


    public function destroy( $id)
    {
        Appeal::find($id)->delete();

        session()->flash('success',__('site.deleted_successfully'));

        return redirect()->route('appeal.index');
    }
}
