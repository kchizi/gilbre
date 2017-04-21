<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\domain\Customer ;
use App\domain\Policy ;
use App\domain\Vehicle;
use Carbon\Carbon;
use App\Http\Requests\PolicyRequest;

class PoliciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Customer $customer)
    {
      $today=Carbon::now();
      $policies=$customer->policies()->orderBy('id','desc')->paginate(10);
      foreach($policies as $policy){
           if($policy->expiry_date->eq($today)){
                $policy->status="expired";
                $policy->save();

           }

       }

      return view('policies.index',compact('policies','customer'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Customer $customer)
    {
        return view('policies.create',compact('customer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Customer $customer,PolicyRequest $request)
    {  


        //dd($request);
       $policy= new Policy();
       $policy->policy_no=$request['policy_no'];
       $policy->effective_date=$request['effective_date'];
       $policy->carrier=$request['carrier'];
       $policy->agent=$request['agent'];
       $policy->duration=$request['duration_type'];
       $policy->status="drafted";
       $policy->type=$request['type'];


       
       $vehicle=Vehicle::where('registration',$request['vehicle'])->first();
       //dd($vehicle->make);
       $policy->vehicle_id=$vehicle->id;


        $x=0;
        switch ($policy->duration) {
            case 'Annual':
                $x=12;
                break;
            case 'Semi Annual':
                $x=6;
                break;
            case 'Quartely':
                $x=3;
            case 'Monthly':
                $x=1;
                break;
        }


      $policy->expiry_date = Carbon::createFromFormat('m/d/Y',$request['effective_date'])->addMonths($x);



       //$vehicle=Vehicle::find($request['vehicle']);
       $customer->policies()->save($policy);

        session()->flash('policy-create-message','policy created successfully');
        //return view('policies.index',compact('customer')); 
        return redirect()->route('policies.index',['customer'=>$customer]);
        
         
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function generate(Customer $customer,Policy $policy)
    {
      //$policy=Policy::find($policy);
      //dd($policy->mytest());

      return view('policies.generate',compact('customer','policy'));  
    }
    public function show(Customer $customer,Policy $policy)
    {
      //$policy=Policy::find($policy);
      //dd($policy->mytest());

      return view('policies.show',compact('customer','policy'));  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer,Policy $policy)
    {
        return view('policies.edit',compact('customer','policy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cancel(Customer $customer,Policy $policy){

        $policy->status='cancelled';
        $policy->save();

        session()->flash('policy-cancel-message','policy Cancelled successfully');
        //return view('policies.index',compact('customer')); 
        return redirect()->route('policies.index',['customer'=>$customer]);  


    }
}
