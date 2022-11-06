<?php

namespace App\Http\Controllers;

use App\FacilityType;
use App\DtbActivityLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FacilityTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = FacilityType::all();
        return view('settings.facilityType.index',compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'type_name'=>'required' 
        ]);

        $roles = new FacilityType();
        $roles->type_name = $request->type_name;
        $results = $roles->save();
        DtbActivityLog::updateActivityLog('created', 'a facility Type');

        if($results) {
            return redirect('/settings-facility-types')->with('message-success', 'New facility type has been added');
        } else {
            return redirect('/settings-facility-types')->with('message-danger', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $types = FacilityType::all();
        $editData = FacilityType::find($id);
        return view('settings.facilityType.index',compact('types','editData'));
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
        $request->validate([
            'type_name'=>'required' 
        ]);

        $roles = FacilityType::find($id);
        $roles->type_name = $request->type_name;
        $results = $roles->save();
        DtbActivityLog::updateActivityLog('updated', 'a facility Type');

        if($results) {
            return redirect('/settings-facility-types')->with('message-success', 'Facility type has been updated');
        } else {
            return redirect('/settings-facility-types')->with('message-danger', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = FacilityType::find($id);
        $result = $type->delete();
        DtbActivityLog::updateActivityLog('deleted', 'a facility Type');
        if($result) {
            return redirect()->route('settings-facility-types.index')->with('message-success', 'Facility Type has been removed Successfully.');
            } else {
            return redirect()->route('settings-facility-types.index')->with('message-danger', 'Something went wrong');
        }
    }

    public function deleteUserView($user_id){
        return view('settings/users/deleteUser', compact('user_id'));
    }
}
