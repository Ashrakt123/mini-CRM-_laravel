<?php

namespace App\Http\Controllers\Api;
use App\Models\company;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class companiesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = company::latest()->paginate(10);
        return  $companies;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
        return view('companies.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        
        $request->validate([
            'Name' => 'required',
            'Email' => 'required',
            'logo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|dimensions:min_width=100,min_height=100',
            'Website_URL'=>'required',
        ]); 
        $data=$request->except('logo');
        $logo=$request->file('logo');

         
       if($request->hasfile('logo')){
        $filename = time() . '.' . $logo->getClientOriginalName();
        $data['logo']=$logo->storeAs('Uploads',$filename,'uploads');
       }     
        
        $companies =company::create($data);
        return $companies;

     
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(company $company)
    {
        return view('companies.show',compact('company'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(company $company)
    {
        return view('companies.edit',compact('company'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, company $company)
    {
        $request->validate([

        'Name' => 'required',
        'Email' => 'required',
        'logo' => 'sometimes|image|mimes:jpg,png,jpeg,gif,svg|dimensions:min_width=100,min_height=100',
        'Website_URL'=>'required',
    ]); 

    $last_logo=$company->logo;
    $data=$request->except('logo');
    $logo=$request->file('logo');

     
   if($request->hasfile('logo')){
    $filename = time() . '.' . $logo->getClientOriginalName();
    $data['logo']=$logo->storeAs('Uploads',$filename,'uploads');
   }     
    
   $companies= $company->update($data);
   return $companies;

    if(isset($last_logo) && isset( $data['logo']) ){
        Storage::disk('uploads')->delete($last_logo);
    }
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(company $company)
    {
        $company->delete();
        return $company ;
    
       
    }
}

