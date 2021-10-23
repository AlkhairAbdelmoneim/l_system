<?php

namespace App\Http\Controllers;

use App\Models\Prosecution;
use Illuminate\Http\Request;
use App\Models\Customers;
use App\Models\CustomerTo;
use App\Models\ProseText;
use App\Models\CauseLawsuit;

class ProsecutionController extends Controller
{

    public function index()
    {

        $customers = Customers::all();
        $customerTo = CustomerTo::all();
        $proseText = ProseText::all();
        $causeLawsuit = CauseLawsuit::all();

        $prosecution = Prosecution::with('Customer','CustomerTo' ,'ProseText' ,'CauseLawsuit','User')->get();
        return view ('dashboard.prosecution.index' ,compact('prosecution','customers','customerTo','proseText','causeLawsuit'));
    }


    public function create()
    {
        $customers = Customers::all();
        $customerTo = CustomerTo::all();
        $proseText = ProseText::all();
        $causeLawsuit = CauseLawsuit::all();
        return view ('dashboard.prosecution.create' ,compact('customers',
        'customerTo','proseText','causeLawsuit'));
    }

 
    public function store(Request $request)
    {
        // return auth()->user()->id;

        $request_data = $request->except(['_token']);
        $request->validate([
            'prose_date' => 'required',
            'customer_name' => 'required',
            'customerTo_name' => 'required',
            'prose_text_name' => 'required',
            'prose_type' => 'required',
            'cause_lawsuit_name' => 'required',
        ]);

        Prosecution::create([
            'prose_date' => $request_data['prose_date'],
            'customer_name' => $request_data['customer_name'],
            'customerTo_name' => $request_data['customerTo_name'],
            'prose_text_name' =>$request_data['prose_text_name'],
            'prose_type' => $request_data['prose_type'],
            'cause_lawsuit_name' => $request_data['cause_lawsuit_name'],
            'user_no' => auth()->user()->id,
        ]);



        session()->flash('success',__('site.created_successfully'));

        return redirect()->route('prosecution.index');  
    }


    public function show(Prosecution $prosecution)
    {
        //
    }


    public function edit( $id)
    {
        $prosecution = Prosecution::find($id);

        if (!$prosecution) {
            
            session()->flash('error',__('Not found (:'));

            return redirect()->route('prosecution.index');  
        }

        $customers = Customers::all();
        $customerTo = CustomerTo::all();
        $proseText = ProseText::all();
        $causeLawsuit = CauseLawsuit::all();
        return view ('dashboard.prosecution.edit' ,compact('prosecution','customers','customerTo','proseText','causeLawsuit'));
    }


    public function update(Request $request,  $id)
    {
        $prosecution = Prosecution::find($id);

        $request_data = $request->except(['_token']);

        $request->validate([
            'prose_date' => 'required',
            'customer_name' => 'required',
            'customerTo_name' => 'required',
            'prose_text_name' => 'required',
            'prose_type' => 'required',
            'cause_lawsuit_name' => 'required',

        ]);

       $prosecution->update([
            'prose_date' => $request_data['prose_date'],
            'customer_name' => $request_data['customer_name'],
            'customerTo_name' => $request_data['customerTo_name'],
            'prose_text_name' =>$request_data['prose_text_name'],
            'prose_type' => $request_data['prose_type'],
            'cause_lawsuit_name' => $request_data['cause_lawsuit_name'],
            'user_no' => auth()->user()->id,
        ]);

        session()->flash('success',__('site.updated_successfully'));

        return redirect()->route('prosecution.index'); 
    }


    public function destroy( $id)
    {
        Prosecution::find($id)->delete();

        session()->flash('success',__('site.deleted_successfully'));

        return redirect()->route('prosecution.index');
    }
}
