<?php

namespace App\Http\Controllers;

use App\Models\contactperson;
use App\Models\company;

use Illuminate\Http\Request;

class ContactPersonsController extends Controller
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
    
        return view('persons.index',compact('contactperson','companies') )
            ->with('i', (request()->input('page', 1) - 1) * 10);
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
    public function store(Request $request)
    {
        $request->validate([
            'FirstName' => 'required',
            'LastName' => 'required',
            'Company' => 'required',
            'Email' => 'required',
            'Phone'=>'required',
            'LinkdinProfileURL'=>'required',
        ]); 
        contactperson::create($request->all());
 
        return redirect()->route('persons.index')
                        ->with('success','Post created successfully.');
    
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
        $companies=company::all();
        return view('persons.edit', compact('contactperson','companies'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\contactperson  $contactperson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, contactperson $person)
    {
      

        $request->validate([
            'FirstName' => 'sometimes',
            'LastName' => 'sometimes',
            'Company' => 'sometimes',
            'Email' => 'sometimes',
            'Phone'=>'sometimes',
            'LinkdinProfileURL'=>'sometimes',
        ]);
        
        $person->update($request->all());
    
        return redirect()->route('persons.index')
                        ->with('success','company updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\contactperson  $contactperson
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contactperson=contactperson::findOrFail($id);

        $contactperson->delete($id);

    
        return redirect()->route('persons.index')
                        ->with('success','Post deleted successfully');
    
    }
}
