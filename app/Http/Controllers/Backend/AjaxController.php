<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    /**
     * Department Wise Designation.
     */
    
    public function deptWiseDesignation(Request $request, $id){
        $data = $request->dept_id;

        if ($id == 2) {
            $designations = Designation::where('designations.dept_id', $data)
                                        ->where('designations.slug', '!=', "receptionist")
                                        ->select('designation_id', 'designation')
                                        ->get();
        }

        if ($id == 3) {
            $designations = Designation::where('designations.dept_id', $data)
                                        ->where('designations.slug', "receptionist")
                                        ->select('designation_id', 'designation')
                                        ->get();
        }
       

        return Response::json($designations);
    }
}
