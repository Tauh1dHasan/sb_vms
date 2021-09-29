<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/* included models */
use App\Models\VisitorType;

class VisitorTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visitor_types = VisitorType::where('visitor_type_status', 0)
                                    ->orWhere('visitor_type_status', 1)
                                    ->get();

        return view('backend.pages.admin.visitorType.index', compact('visitor_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.admin.visitorType.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = session('loggedUser');

        $visitor_type = new VisitorType;

        $visitor_type->visitor_type = $request->visitor_type;
        $visitor_type->slug = strtolower($request->visitor_type);
        $visitor_type->entry_user_id = $user_id;
        $visitor_type->entry_datetime = now();

        $visitor_type->save();

        Session()->flash('success' , 'Visitor Type Added Successfully !!!');
        return redirect()->route('admin.visitorType.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $visitor_type = VisitorType::where('visitor_type_id', $id)->first();

        return view('backend.pages.admin.visitorType.show', compact('visitor_type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $visitor_type = VisitorType::where('visitor_type_id', $id)->first();

        return view('backend.pages.admin.visitorType.edit', compact('visitor_type'));
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
        $user_id = session('loggedUser');

        $old_visitor_type = VisitorType::find($id);

        $old_visitor_type->visitor_type_status = 2;
        $old_visitor_type->modified_user_id = $user_id;
        $old_visitor_type->modified_datetime = now();

        $visitor_type = new VisitorType;

        $visitor_type->visitor_type = $request->visitor_type;
        $visitor_type->slug = strtolower($request->visitor_type);
        $visitor_type->visitor_type_status = $request->visitor_type_status;
        $visitor_type->old_visitor_type_id = $old_visitor_type->visitor_type_id;
        $visitor_type->entry_user_id = $user_id;
        $visitor_type->entry_datetime = now();

        $visitor_type->save();
        $old_visitor_type->save();

        Session()->flash('success' , 'Visitor Type Updated Successfully !!!');
        return redirect()->route('admin.visitorType.index');
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
}
