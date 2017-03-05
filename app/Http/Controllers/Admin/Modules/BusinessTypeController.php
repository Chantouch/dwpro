<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Models\BusinessType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use DB;

class BusinessTypeController extends Controller
{

    private $business_type;

    /**
     * BusinessTypeController constructor.
     * @param BusinessType $businessType
     */
    public function __construct(BusinessType $businessType)
    {
        $this->business_type = $businessType;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.modules.business-type.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrator.modules.business-type.create');
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
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);
        $data['status'] = 1;
        $business_type = BusinessType::create($data);
        if (!$business_type) {
            DB::rollbackTransaction();
            return redirect()->back()->withInput()->with('error', 'We unable to process your request right now.');
        }
        return redirect()->route('admin.modules.business-types.index')->with('success', 'You data was saved.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('administrator.modules.business-type.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('administrator.modules.business-type.edit');
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
        BusinessType::find($id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BusinessType::find($id)->delete();
        return response()->json(['done']);
    }
}
