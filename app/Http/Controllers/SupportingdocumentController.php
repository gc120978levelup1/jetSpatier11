<?php

namespace App\Http\Controllers;

use App\Models\Supportingdocument;
use Illuminate\Http\Request;
use App\Models\Doctype;
use App\Models\Document;
use App\Models\User;

class SupportingdocumentController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //'doclink', 'document_id',
        $document_id = request('document_id');
        return view('supportingdocuments.create',compact('document_id'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'doclink' => 'required',
        ]);
        $input = $request->all();
        $document = Supportingdocument::create($input);
        $document_id = request('document_id');
        $document = Document::find($document_id);
        $supportdocs = $document->find($document->id)->supportdocs;
        $doctrails = $document->find($document->id)->doctrails;
        return view('documents.show',compact('document','supportdocs','doctrails'));
    }

    public function show(Supportingdocument $supportingdocument)
    {
        //
    }

    public function edit(Supportingdocument $supportingdocument)
    {
        return view('supportingdocuments.edit',compact('supportingdocument'));
    }

    public function update(Request $request, Supportingdocument $supportingdocument)
    {
        $this->validate($request, [
            'doclink' => 'required',
        ]);
        $input = $request->all();
        $supportingdocument->update($input);
        $document_id = request('document_id');
        $document = Document::find($document_id);
        $supportdocs = $document->find($document->id)->supportdocs;
        $doctrails = $document->find($document->id)->doctrails;
        return view('documents.show',compact('document','supportdocs','doctrails'));
    }

    public function destroy(Supportingdocument $supportingdocument)
    {
        //$document_id = $supportingdocument->document_id;
        //$supportingdocument->delete();
        //$document = Document::find($document_id);
        $document = $supportingdocument->document;
        $supportingdocument->delete();
        $supportdocs = $document->find($document->id)->supportdocs;
        $doctrails = $document->find($document->id)->doctrails;
        return view('documents.show',compact('document','supportdocs','doctrails'));
    }
}
