<?php

namespace App\Http\Controllers;

use App\Models\Docapprovalguide;
use App\Models\Doctype;
use App\Models\User;
use Illuminate\Http\Request;


class DocapprovalguideController extends Controller
{
    function __construct()
    {
        //$this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
        //$this->middleware('permission:role-create', ['only' => ['create','store']]);
        //$this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        //$this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        if (request('doctype_id')!=''){
            $doctype = Doctype::find(request('doctype_id'));
            return redirect()->route('doctypes.show',compact('doctype'));
        }else{
            $docapprovalguides = Docapprovalguide::latest()->paginate(5);
            return view('docapprovalguides.index',compact('docapprovalguides'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
        }
    }

    public function create()
    {
        $users = User::all();
        $doctype_id = request('doctype_id');
        return view('docapprovalguides.create',compact('doctype_id','users'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'doctype_id' => 'required',
            'approver_sequence' => 'required',
            'approver_user_id' => 'required',
        ]);

        Docapprovalguide::create($request->all());
        $doctype = Doctype::find(request('doctype_id'));
        return redirect()->route('doctypes.show',compact('doctype'))
                        ->with('success','Approver created successfully.');
    }

    public function show(Docapprovalguide $docapprovalguide)
    {

    }

    public function edit(Docapprovalguide $docapprovalguide)
    {
        return view('docapprovalguides.edit',compact('docapprovalguide'));
    }

    public function update(Request $request, Docapprovalguide $docapprovalguide)
    {
        request()->validate([
            'doctype_id' => 'required',
            'approver_sequence' => 'required',
            'approver_user_id' => 'required',
        ]);

        $docapprovalguide->update($request->all());
        //$doctype = $docapprovalguide->doctype();
        $doctype = Doctype::find(request('doctype_id'));
        return redirect()->route('doctypes.show',compact('doctype'))
                        ->with('success','Approver updated successfully.');
    }

    public function destroy(Docapprovalguide $docapprovalguide)
    {
        $doctype = Doctype::find($docapprovalguide->doctype_id);
        $docapprovalguide->delete();
        return redirect()->route('doctypes.show',compact('doctype'))
                        ->with('success','Approver deleted successfully...');
    }
}
