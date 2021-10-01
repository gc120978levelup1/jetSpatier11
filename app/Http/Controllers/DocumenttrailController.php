<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumenttrailController extends Controller
{
    function __construct()
    {
        //$this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','show']]);
        //$this->middleware('permission:user-create', ['only' => ['create','store']]);
        //$this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        //$this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Document $document)
    {

    }

    public function edit(Document $document)
    {
        //
    }

    public function update(Request $request, Document $document)
    {
        //
    }

    public function destroy(Document $document)
    {
        //
    }
}
