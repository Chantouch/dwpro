<?php

namespace App\Http\Controllers\Api;

use App\Models\Qualification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use DB;

class QualificationController extends Controller
{
    private $qualification;

    /**
     * BusinessTypeController constructor.
     * @param Qualification $qualification
     */
    public function __construct(Qualification $qualification)
    {
        $this->qualification = $qualification;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $qualification = $this->qualification->paginate(5);
        return response()->json($qualification);
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
            'description' => 'required',
        ]);
        $data['status'] = 1;
        $qualification = Qualification::create($data);
        if (!$qualification) {
            DB::rollbackTransaction();
            return redirect()->back()->withInput()->with('error', 'We unable to process your request right now.');
        }
        return $qualification;
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
        Qualification::find($id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Qualification::find($id)->delete();
        return response()->json(['done']);
    }
}
