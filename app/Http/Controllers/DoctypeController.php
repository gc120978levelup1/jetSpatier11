<?php

namespace App\Http\Controllers;

use App\Models\Doctype;
use Illuminate\Http\Request;
use App\Http\Controllers\DocapprovalguideController;

class DoctypeController extends Controller
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
        $doctypes = Doctype::latest()->paginate(5);
        return view('doctypes.index',compact('doctypes'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('doctypes.create');
    }

    public function store(Request $request)
    {
        request()->validate([
            'description' => 'required',
            'form_number' => 'required',
            'department_id' => 'required',
        ]);

        Doctype::create($request->all());

        return redirect()->route('doctypes.index')
                        ->with('success','Document created successfully.');
    }

    public function show(Doctype $doctype)
    {
        return view('doctypes.show',compact('doctype'));
    }

    public function edit(Doctype $doctype)
    {
        return view('doctypes.edit',compact('doctype'));
    }

    public function update(Request $request, Doctype $doctype)
    {
        request()->validate([
            'description' => 'required',
            'form_number' => 'required',
            'department_id' => 'required',
        ]);

        $doctype->update($request->all());

        return redirect()->route('doctypes.index')
                        ->with('success','Document updated successfully');
    }

    public function destroy(Doctype $doctype)
    {
        $doctype->delete();

        return redirect()->route('doctypes.index')
                        ->with('success','Document deleted successfully');
    }
}
