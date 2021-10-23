<?php

namespace App\Http\Controllers;

use App\Models\Authorization;
use Illuminate\Http\Request;

use App\Models\Witness;
use App\Models\Clients;
use App\Models\ClientsTo;

class AuthorizationController extends Controller
{

    public function index()
    {
        $authorization = Authorization::with('Witness','Clients','ClientTo','User')->get();

        foreach ($authorization as $key => $value) {
            
            $witness = Witness::find($value->first_witness_no);

            $witnessTo = Witness::find($value->second_witness_no);

        }

        return view ('dashboard.authorization.index' ,compact('authorization','witness','witnessTo'));
    }


    public function create()
    {
        $witness = Witness::all();
        $clients = Clients::all();
        $clientTo = ClientsTo::all();
        return view ('dashboard.authorization.create' ,compact('clients','clientTo','witness'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'authorization_date' => 'required',
            'authorization_type' => 'required',
            'client_name' => 'required',
            'clientTo_name' => 'required',
            'authorization_subject_no' => 'required',
            'first_witness_no' => 'required',
            'second_witness_no' => 'required',
        ]);

     $request_data = $request->except(['_token']);

     $request_data['user_no'] = auth()->user()->id;

     Authorization::create([
        'authorization_date' => $request_data['authorization_date'],
        'authorization_type' => $request_data['authorization_type'],
        'client_name' =>$request_data['client_name'],
        'clientTo_name' => $request_data['clientTo_name'],
        'authorization_subject_no' => $request_data['authorization_subject_no'],
        'first_witness_no' => $request_data['first_witness_no'],
        'second_witness_no' => $request_data['second_witness_no'],
        'command' => $request_data['command'],
        'user_no' => $request_data['user_no'],
     ]);

        session()->flash('success',__('site.created_successfully'));

        return redirect()->route('authorization.index');
    }


    public function show(Authorization $authorization)
    {
        //
    }


    public function edit( $id)
    {
        $authorization = Authorization::find($id);

        $witness = Witness::all();
        $clients = Clients::all();
        $clientTo = ClientsTo::all();

            
        $witnessTo = Witness::find($authorization['second_witness_no']);


        if (!$authorization) {
            
            session()->flash('error','Not found!');

            return redirect()->route('authorization.index');  
        }
        return view('dashboard.authorization.edit' ,compact('authorization','witness','clients','clientTo','witness'));
    }


    public function update(Request $request, $id)
    {
        $authorization = Authorization::find($id);

        $request->validate([
            'authorization_date' => 'required',
            'authorization_type' => 'required',
            'client_name' => 'required',
            'clientTo_name' => 'required',
            'authorization_subject_no' => 'required',
            'first_witness_no' => 'required',
            'second_witness_no' => 'required',
        ]);

     $request_data = $request->except(['_token']);

     $request_data['user_no'] = auth()->user()->id;

     $authorization->update([
        'authorization_date' => $request_data['authorization_date'],
        'authorization_type' => $request_data['authorization_type'],
        'client_name' =>$request_data['client_name'],
        'clientTo_name' => $request_data['clientTo_name'],
        'authorization_subject_no' => $request_data['authorization_subject_no'],
        'first_witness_no' => $request_data['first_witness_no'],
        'second_witness_no' => $request_data['second_witness_no'],
        'command' => $request_data['command'],
        'user_no' => $request_data['user_no'],
     ]);

        session()->flash('success',__('site.updated_successfully'));

        return redirect()->route('authorization.index');
    }


    public function destroy( $id)
    {
        Authorization::find($id)->delete();

        session()->flash('success',__('site.deleted_successfully'));

        return redirect()->route('authorization.index');
    }
}
