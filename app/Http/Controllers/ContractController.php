<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;

use App\Models\ContractSubject;
use App\Models\CustomerTo;
use App\Models\Customers;
use App\Models\Witness;

class ContractController extends Controller
{

    public function index()
    {
        $contract = Contract::with('Customers','CustomerTo','Witness','ContractSubject','User')->get();

        foreach ($contract as $key => $value) {
            
            $witness = Witness::find($value->first_witness_no);

            $witnessTo = Witness::find($value->second_witness_no);

        }
                
        return view ('dashboard.contract.index' ,compact('contract','witnessTo','witness'));
    }


    public function create()
    {

        $contractSubject = ContractSubject::all();
        $customerTo = CustomerTo::all();
        $customers = Customers::all();
        $witness = Witness::all();

        return view ('dashboard.contract.create', compact('contractSubject','customerTo','customers','witness'));
    }

 
    public function store(Request $request)
    {
        $request->validate([
            'contract_date' => 'required',
            'contract_subject' => 'required',
            'first_side_no' => 'required',
            'second_side_no' => 'required',
            'first_witness_no' => 'required',
            'second_witness_no' => 'required',
        ]);

     $request_data = $request->except(['_token']);

     $request_data['user_no'] = auth()->user()->id;

     Contract::create([
        'contract_date' => $request_data['contract_date'],
        'contract_subject' => $request_data['contract_subject'],
        'first_side_no' =>$request_data['first_side_no'],
        'second_side_no' => $request_data['second_side_no'],
        'first_witness_no' => $request_data['first_witness_no'],
        'second_witness_no' => $request_data['second_witness_no'],
        'command' => $request_data['command'],
        'user_no' => $request_data['user_no'],
     ]);

        session()->flash('success',__('site.created_successfully'));

        return redirect()->route('contract.index');
         
    }


    public function show(Contract $contract)
    {
        //
    }


    public function edit( $id)
    {
        $contract = Contract::find($id);

        $contractSubject = ContractSubject::all();
        $customerTo = CustomerTo::all();
        $customers = Customers::all();
        $witness = Witness::all();

            
        $witnessTo = Witness::find($contract['second_witness_no']);


        if (!$contract) {
            
            session()->flash('error','Not found!');

            return redirect()->route('contract.index');  
        }
        return view('dashboard.contract.edit' ,compact('customers','customerTo','contract','contractSubject','witness','witnessTo'));
    }


    public function update(Request $request,  $id)
    {
        $contract = Contract::find($id);

        $request->validate([
            'contract_date' => 'required',
            'contract_subject' => 'required',
            'first_side_no' => 'required',
            'second_side_no' => 'required',
            'first_witness_no' => 'required',
            'second_witness_no' => 'required',
        ]);

     $request_data = $request->except(['_token']);

     $request_data['user_no'] = auth()->user()->id;

     $contract->update([
        'contract_date' => $request_data['contract_date'],
        'contract_subject' => $request_data['contract_subject'],
        'first_side_no' =>$request_data['first_side_no'],
        'second_side_no' => $request_data['second_side_no'],
        'first_witness_no' => $request_data['first_witness_no'],
        'second_witness_no' => $request_data['second_witness_no'],
        'command' => $request_data['command'],
        'user_no' => $request_data['user_no'],
     ]);

     

        session()->flash('success',__('site.updated_successfully'));

        return redirect()->route('contract.index');

    }


    public function destroy( $id)
    {
        Contract::find($id)->delete();

        session()->flash('success',__('site.deleted_successfully'));

        return redirect()->route('contract.index');
    }
}
