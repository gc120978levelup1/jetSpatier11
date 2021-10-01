<?php

namespace App\Http\Controllers;

use App\Models\Doctype;
use App\Models\Document;
use App\Models\Documenttrail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    function __construct()
    {
        //$this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','show']]);
        //$this->middleware('permission:user-create', ['only' => ['create','store']]);
        //$this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        //$this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $user_id = Auth::user()->id;
        $documents = Document::where('filer_user_id','=',$user_id)->orderBy('id','DESC')->paginate(5);
        return view('documents.index',compact('documents'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $doclink = request('doclink');
        $user_id = Auth::id(); // also ex. $email = Auth::user()->email;
        $users_id = User::pluck('email','id')->all(); //used for select forms
        $doctypes_id = Doctype::pluck('description','id')->all(); //used for select forms
        return view('documents.create',compact('user_id','users_id','doctypes_id','doclink'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'doclink' => 'required',
            'doctype_id' => 'required',
            'archiver_user_id' => 'required'
        ]);

        $input = $request->all();
        $document = Document::create($input);

        return redirect()->route('documents.index')
                        ->with('success','documents saved successfully');
    }

    public function show(Document $document)
    {
        $supportdocs = $document->find($document->id)->supportdocs;
        $doctrails = $document->find($document->id)->doctrails;
        return view('documents.show',compact('document','supportdocs','doctrails'));
    }

    public function edit(Document $document)
    {
        $user_id = Auth::id(); // also ex. $email = Auth::user()->email;
        $users_id = User::pluck('email','id')->all(); //used for select forms
        $doctypes_id = Doctype::pluck('description','id')->all(); //used for select forms
        return view('documents.edit',compact('document','user_id','users_id','doctypes_id'));
    }

    public function update(Request $request, Document $document)
    {
        $this->validate($request, [
            'doclink' => 'required',
            'doctype_id' => 'required',
            'archiver_user_id' => 'required'
        ]);

        $document->update($request->all());

        return redirect()->route('documents.index')
                        ->with('success','Document updated successfully');
    }

    public function submit()
    {
        $document_id = request('document_id'); //obtain document_id from route
        $document = Document::find($document_id);
        $document->approval_status = 0; //edit the value of approval status
        $document->update();
        $document->generatedoctrails();
        $supportdocs = $document->find($document->id)->supportdocs;
        $doctrails = $document->find($document->id)->doctrails;
        return view('documents.show',compact('document','supportdocs','doctrails'))
                ->with('success','Document submitted successfully');
    }

    public function cancel()
    {
        $document_id = request('document_id'); //obtain document_id from route
        $document = Document::find($document_id);
        $document->approval_status = 4; //edit the value of approval status, 4 means cancel
        $document->update();
        $supportdocs = $document->find($document->id)->supportdocs;
        $doctrails = $document->find($document->id)->doctrails;
        //update each doctrails
        foreach ($doctrails as $doctrail)
        {
            $id = $doctrail->id;
            $dc = Documenttrail::find($id);
            $dc->approval_status = 4; //cancelled by user
            $dc->is_viewing = 0;
            $dc->update();
        }
        $doctrails = $document->find($document->id)->doctrails;
        return view('documents.show',compact('document','supportdocs','doctrails'))
                ->with('success','Document submitted successfully');
    }

    public function destroy(Document $document)
    {
        $document->delete();
        return redirect()->route('documents.index')
                        ->with('success','Document deleted successfully');
    }
}
