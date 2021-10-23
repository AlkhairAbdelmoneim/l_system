<?php

namespace App\Http\Controllers;

use App\Models\Consults;
use App\Models\Customers;
use App\Models\SubjectConsult;
use Illuminate\Http\Request;

class ConsultsController extends Controller
{

    public function index()
    {
        $consults = Consults::with('Customers','SubjectConsult','User')->get();
        return view ('dashboard.consults.index' ,compact('consults'));
    }


    public function create()
    {
        $customers = Customers::all();
         $subjectConsult = SubjectConsult::all();

        return view ('dashboard.consults.create' ,compact('customers' ,'subjectConsult'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'consult_date' => 'required',
            'consult_subject_no' => 'required',
            'customer_name' => 'required',
            'respondent_date' => 'required',
            'respondent_time' => 'required',
            'consult_text' => 'required',
        ]);

     $request_data = $request->except(['_token']);

     $request_data['user_no'] = auth()->user()->id;

     Consults::create([
        'consult_date' => $request_data['consult_date'],
        'consult_subject_no' => $request_data['consult_subject_no'],
        'customer_name' =>$request_data['customer_name'],
        'respondent_date' => $request_data['respondent_date'],
        'respondent_time' => $request_data['respondent_time'],
        'consult_text' => $request_data['consult_text'],
        'command' => $request_data['command'],
        'user_no' => $request_data['user_no'],
     ]);

     

        session()->flash('success',__('site.created_successfully'));

        return redirect()->route('consults.index'); 
    }


    public function show(Consults $consults)
    {
        //
    }


    public function edit( $id)
    {
        $consults = Consults::find($id);

        $customers = Customers::all();
        $subjectConsult = SubjectConsult::all();


        if (!$consults) {
            
            session()->flash('error','Not found!');

            return redirect()->route('clients.index');  
        }
        return view('dashboard.consults.edit' ,compact('customers','consults','subjectConsult'));
    }


    public function update(Request $request, $id)
    {
        $consults = Consults::find($id);

        $request->validate([
            'consult_date' => 'required',
            'consult_subject_no' => 'required',
            'customer_name' => 'required',
            'respondent_date' => 'required',
            'respondent_time' => 'required',
            'consult_text' => 'required',
        ]);

     $request_data = $request->except(['_token']);

     $consults->update([
        'consult_date' => $request_data['consult_date'],
        'consult_subject_no' => $request_data['consult_subject_no'],
        'customer_name' =>$request_data['customer_name'],
        'respondent_date' => $request_data['respondent_date'],
        'respondent_time' => $request_data['respondent_time'],
        'consult_text' => $request_data['consult_text'],
        'command' => $request_data['command'],
        'user_no' => auth()->user()->id,
     ]);

        session()->flash('success',__('site.updated_successfully'));

        return redirect()->route('consults.index');
    }


    public function destroy( $id)
    {
        Consults::find($id)->delete();

        session()->flash('success',__('site.deleted_successfully'));

        return redirect()->route('consults.index');
    }
}
