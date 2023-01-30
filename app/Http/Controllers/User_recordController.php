<?php

namespace App\Http\Controllers;

use App\Models\User_record;
use Illuminate\Http\Request;

class User_recordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_record = User_record::latest()->paginate(10);
    
        return view('user_record.index',compact('user_record'))
            ->with('i', (request()->input('page', 1) - 1) * 10);

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user_record.create');
        //
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
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
    
        User_record::create($request->all());
     
        return redirect()->route('user_record.index')
                        ->with('success','User created successfully.');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User_record  $user_record
     * @return \Illuminate\Http\Response
     */
    public function show(User_record $user_record)
    {
        return view('user_record.show',compact('user_record'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User_record  $user_record
     * @return \Illuminate\Http\Response
     */
    public function edit(User_record $user_record)
    {
        return view('user_record.edit',compact('user_record'));

        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User_record  $user_record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User_record $user_record)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
    
        $user_record->update($request->all());
    
        return redirect()->route('user_record.index')
                        ->with('success','User updated successfully');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User_record  $user_record
     * @return \Illuminate\Http\Response
     */
    public function destroy(User_record $user_record)
    {
        $user_record->delete();
    
        return redirect()->route('user_record.index')
                        ->with('success','User deleted successfully');
        //
    }
}
