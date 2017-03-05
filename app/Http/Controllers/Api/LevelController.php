<?php

namespace App\Http\Controllers\Api;

use App\Models\Level;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use DB;

class LevelController extends Controller
{
    private $level;

    /**
     * BusinessTypeController constructor.
     * @param Level $level
     */
    public function __construct(Level $level)
    {
        $this->level = $level;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $level = $this->level->paginate(5);
        return response()->json($level);
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
        $level = Level::create($data);
        if (!$level) {
            DB::rollbackTransaction();
            return redirect()->back()->withInput()->with('error', 'We unable to process your request right now.');
        }
        return $level;
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
        Level::find($id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Level::find($id)->delete();
        return response()->json(['done']);
    }
}
