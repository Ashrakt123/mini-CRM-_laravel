<?php

namespace App\Http\Controllers\Api;
use App\Models\contactperson;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class contactPersonsController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies=company::all();

        $contactperson = contactperson::latest()->paginate(10);
    
        return $companies . $contactperson ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $companies=company::all();
        return view('persons.create ',compact('companies'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request ,contactperson $contactperson)
    {
        $request->validate([
            'FirstName' => 'required',
            'LastName' => 'required',
            'Company' => 'required',
            'Email' => 'required',
            'Phone'=>'required',
            'LinkdinProfileURL'=>'required',
        ]); 
        $contactperson ->create($request->all());
 
        return   $contactperson  ;
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\contactperson  $contactperson
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $companies=company::all();
        $contactperson=contactperson::findOrFail($id);
        return view('persons.show',compact('contactperson','companies'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\contactperson  $contactperson
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contactperson=contactperson::findOrFail($id);

        return view('persons.edit', compact('contactperson'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\contactperson  $contactperson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, contactperson $contactperson)
    {
        $request->validate([
            'FirstName' => 'required',
            'LastName' => 'required',
            'Company' => 'required',
            'Email' => 'required',
            'Phone'=>'required',
            'LinkdinProfileURL'=>'required',
        ]);
    
        $contactperson ->update($request->all());
    
        return  $contactperson ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\contactperson  $contactperson
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,contactperson $contactperson)
    {
        $contactperson=contactperson::findOrFail($id);

        $contactperson->delete($id);

    
        return  $contactperson ;
    
    }
}
