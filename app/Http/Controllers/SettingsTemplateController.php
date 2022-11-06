<?php

namespace App\Http\Controllers;

use App\DtbActivityLog;
use App\SettingTemplate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settingTemplates = SettingTemplate::latest()->get();
        return view('settings.template.index', compact('settingTemplates'));
  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.template.create');
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
            'name'=> 'required',
            'templat_des'=> 'required',
            
        ]);
        $settingTemplate = new SettingTemplate();
        $settingTemplate->name = $request->name;
        $settingTemplate->description = $request->templat_des;
        $result = $settingTemplate->save();
        if($result){
            DtbActivityLog::updateActivityLog('added', 'a new settings-template');
        }
        return redirect('/settings-template')->with('message-success', "New template Added Successfully.");
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
        $editData = SettingTemplate::find($id);
        return view('settings.template.create', compact('editData'));
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
            'name'=> 'required',
            'templat_des'=> 'required',
            
        ]);
        $settingTemplate = SettingTemplate::find($id);
        $settingTemplate = new SettingTemplate();
        $settingTemplate->name = $request->name;
        $settingTemplate->description = $request->templat_des;
        $result = $settingTemplate->save();
        if($result){
            DtbActivityLog::updateActivityLog('added', 'a new settings-template');
        }
        return redirect('/settings-template')->with('message-success', "Template uodated Successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function deleteTemplateView($id)
     {
        return view('settings/template/deleteTemplate', compact('id'));
     }
    public function destroy($id)
    {
        $settingTemplate = SettingTemplate::where('id',$id)->delete();
        DtbActivityLog::updateActivityLog('deleted', 'a setting template');
        if($settingTemplate) {
            return redirect()->route('settings-template.index')->with('message-success', 'Template has been removed Successfully.');
            } else {
            return redirect('add-member')->with('message-danger', 'Something went wrong');
        }
    }

    public function getTemplate(Request $request)
    {
        $id = $request->id;
        $template = SettingTemplate::find($id);
        return response()->json($template);
    }
}
