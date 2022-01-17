<?php

namespace App\Http\Controllers;

use App\Models\company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
      //  dd( $companies);
        return view('companies.index',compact('companies'));
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
        
        company::create($data);

     
        return redirect()->route('companies.index')
                        ->with('success','copmpany created successfully.');
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

        'Name' => 'sometimes',
        'Email' => 'sometimes',
        'logo' => 'sometimes|image|mimes:jpg,png,jpeg,gif,svg|dimensions:min_width=100,min_height=100',
        'Website_URL'=>'sometimes',
    ]); 

    $last_logo=$company->logo;
    $data=$request->except('logo');
    $logo=$request->file('logo');

     
   if($request->hasfile('logo')){
    $filename = time() . '.' . $logo->getClientOriginalName();
    $data['logo']=$logo->storeAs('Uploads',$filename,'uploads');
   }     
    
   $company->update($data);

    if(isset($last_logo) && isset( $data['logo']) ){
        Storage::disk('uploads')->delete($last_logo);
    }
        return redirect()->route('companies.index')
                        ->with('success','company updated successfully');
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
    
        return redirect()->route('companies.index')
                        ->with('success','Post deleted successfully');
    }
}
