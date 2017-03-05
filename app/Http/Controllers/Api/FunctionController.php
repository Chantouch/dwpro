<?php

namespace App\Http\Controllers\Api;

use App\Models\Department;
use App\Models\Functions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use DB;

class FunctionController extends Controller
{
    private $functions;

    public function __construct(Functions $functions)
    {
        $this->functions = $functions;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $functions = $this->functions->paginate(5);
        return response()->json($functions);
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
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);
        $data['status'] = 1;
        $functions = $this->functions->create($data);
        if (!$functions) {
            DB::rollbackTransaction();
            return redirect()->back()->withInput()->with('error', 'We unable to process your request right now.');
        }
        return $functions;
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
        $edit = $this->functions->find($id)->update($data);
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
        $this->functions->find($id)->delete();
        return response()->json('done');
    }
}
