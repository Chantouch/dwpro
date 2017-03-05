<?php

namespace App\Http\Controllers\Employee;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{

    public $post;

    /**
     * PostController constructor.
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //        $item = Post::latest()->paginate(1);
        //        $response = [
        //            'pagination' => [
        //                'total' => $item->total(),
        //                'per_page' => $item->perPage(),
        //                'current_page' => $item->currentPage(),
        //                'last_page' => $item->lastPage(),
        //                'from' => $item->firstItem(),
        //                'to' => $item->lastItem()
        //            ],
        //            'data' => $item,
        //        ];
        //        return response()->json($response);

        $item = $this->post->paginate(5);
        return response()->json($item);
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
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);
        $create = Post::create($request->all());
        return response()->json($create);
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
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);

        $edit = Post::find($id)->update($request->all());
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
        Post::find($id)->delete();
        return response()->json('done');
    }
}
