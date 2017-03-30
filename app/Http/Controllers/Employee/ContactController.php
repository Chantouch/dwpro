<?php

namespace App\Http\Controllers\Employee;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{

    protected $contacts;

    /**
     * ContactController constructor.
     * @param Contact $contact
     */
    public function __construct(Contact $contact)
    {
        $this->contacts = $contact;
        $this->middleware('auth:employee');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = $this->contacts->with([
            'employee', 'position', 'department'
        ])->where('employee_id', $this->emp_id())->paginate(10);
        return response()->json($contacts);
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
        ]);
        $data['employee_id'] = $this->emp_id();
        $edit = $this->contacts->create($data);
        return response()->json($edit);
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
        ]);
        $edit = $this->contacts->find($id)->update($data);
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
        $contact = $this->contacts->find($id);
        $contact->delete();
        return response()->json(['message' => 'Contact deleted successfully.']);
    }

    /**
     * @return mixed
     * @get employee id
     */
    public function emp_id()
    {
        return Auth::guard('employee')->id();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_contact_deleted()
    {
        $contact_deleted = $this->contacts->where('employee_id', $this->emp_id())->with([
            'employee', 'position', 'department'
        ])->onlyTrashed()->paginate(10);
        return response()->json($contact_deleted);
    }

    public function restore_contact($id)
    {
        $contact_restore = $this->contacts->where('employee_id', $this->emp_id())->onlyTrashed()->find($id);
        $contact_restore->restore();
        return response()->json(['message' => 'Contact restore successfully']);
    }
}
