<?php

namespace App\Http\Controllers\Api;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use DB;

class DepartmentController extends Controller
{
    private $departments;

    public function __construct(Department $department)
    {
        $this->departments = $department;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = $this->departments->paginate(5);
        return response()->json($departments);
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, Department::rules(), Department::messages());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Please input the required field.');
        }
        $data['status'] = 1;
        $business_type = $this->departments->create($data);
        if (!$business_type) {
            DB::rollbackTransaction();
            return redirect()->back()->withInput()->with('error', 'We unable to process your request right now.');
        }
        return $business_type;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);
        $edit = $this->departments->find($id)->update($data);
        return response()->json($edit);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->departments->find($id)->delete();
        return response()->json('done');
    }
}
