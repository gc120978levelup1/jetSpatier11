<!--
Master Layout
-->
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Document Submission Manager - Document Details') }}
        </h2>
    </x-slot>

    <div class="py-3">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">

                <div class="flex items-center max-w-sm p-3 mx-auto space-x-4 shadow-md bg-red rounded-xl">
                    @if(Auth::user()->id == $document->filer_user->id)
                        <div class="pull-right">
                            <a class="btn btn-success" href="{{ route('documents.index') }}"> Back to documents list</a>
                        </div>
                    @else
                        <h4 class="flex items-center">Document Submittal</h4>
                    @endif
                </div>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong>Something went wrong.<br><br>
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
                @endif
                <div class="items-center max-w-sm p-3 mx-auto space-x-4 shadow-md bg-red rounded-xl">
                    <!--
                    Feils:
                        'doclink', 'filer_user_id', 'archiver_user_id','doctype_id', 'approval_status',
                    -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Document ID:</strong>
                                {{ $document->id}}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Document Link:</strong>
                                <a rel="noopener noreferrer" target="_blank" href={{ $document->doclink}}>{{ $document->doclink}} </a>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Filer ID:</strong>
                                {{ $document->filer_user->name}}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Filer Email:</strong>
                                {{ $document->filer_user->email}}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Recepient ID:</strong>
                                {{ $document->archiver_user->name}}&nbsp;&nbsp;/&nbsp;&nbsp;{{ $document->archiver_user->email}}
                            </div>
                        </div>


                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Document Type:</strong>
                                {{ $document->doctype->description}}&nbsp;&nbsp;/&nbsp;&nbsp;{{ $document->doctype->form_number}}
                            </div>
                        </div>
                         <div class="col-xs-12 col-sm-12 col-md-12">
                            <div>
                                <strong>Status:</strong>
                                {{ $document->approvalstatus() }}
                            </div>
                        </div>
                    </div>

                    @if(Auth::user()->id == $document->filer_user->id)
                        <div style="width:100%;">
                            <div class="row">
                                <div class="p-2 col-2 col-sm-2" style="width:100%">
                                    @if(($document->approval_status != 4)&&($document->approval_status != 5))
                                        {!! Form::model($document, ['method' => 'PATCH','route' => ['documents.cancel', $document->id]]) !!}
                                            {!! Form::submit('Cancel', ['class' => 'btn btn-warning','style'=>'width:100%;']) !!}
                                        {!! Form::close() !!}
                                    @endif
                                </div>
                                <div class="p-2 col-2 col-sm-2" style="width:100%">
                                    @if($document->approval_status == -1)
                                        {!! Form::model($document, ['method' => 'PATCH','route' => ['documents.submit', $document->id]]) !!}
                                            {!! Form::submit('Submit', ['class' => 'btn btn-danger','style'=>'width:100%;']) !!}
                                        {!! Form::close() !!}
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--
    Master/Detail - (documents/doc trail)
    'document_id', 'approver_sequence', 'approver_user_id', 'approval_status', 'is_viewing',
    -->
    <div class="py-3">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="items-center max-w-sm p-3 mx-auto space-x-4 shadow-md bg-red rounded-xl">
                    <div class="flex justify-between h-16">
                        <h4 class="flex items-center">Document Trail</h4>
                        <!-- create button
                        <div class="flex items-center sm:flex sm:items-center sm:ml-6">
                            <a class="btn btn-success" href="/supportingdocuments/create?document_id={{$document->id}}"> Add Supporting Document</a>
                        </div>
                        -->
                    </div>
                </div>
                <div class="max-w-sm p-3 mx-auto space-x-4 shadow-md bg-red rounded-xl">
                    <!-- 'document_id', 'approver_sequence', 'approver_user_id', 'approval_status', 'is_viewing', -->
                    <table class="table table-hover">
                        <tr>
                            <th>Count</th>
                            <th>Date Updated</th>
                            <th>Approver User ID</th>
                            <th>Approval Status</th>
                            <th>Viewing Status</th>
                        </tr>
                        @if($doctrails->count() > 0)
                            <tr>
                                <td>1.</td>
                                <td>{{ $doctrails[0]->created_at}}</td>
                                <td>{{ $document->filer_user->name}}</td>
                                <td>Submitted</td>
                                <td>Decided</td>
                            </tr>
                        @endif
                        @php
                            $i=1;
                        @endphp
                        @foreach ($doctrails as $key => $trail)
                            <tr>
                                <td>{{ ++$i }}.</td>
                                <td>{{ $trail->updated_at}}</td>
                                <td>{{ $trail->approveruser->name}} / {{ $trail->approveruser->email}}</td>
                                <td>{{ $trail->approvalstatus() }}</td>
                                <td>{{ $trail->isviewing() }}</td>
                            </tr>

                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--
    Master/Detail - (documents/support docs)
    -->
    <div class="py-3">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="items-center max-w-sm p-3 mx-auto space-x-4 shadow-md bg-red rounded-xl">
                    <div class="flex justify-between h-16">
                        <h4 class="flex items-center">List of supporting documents</h4>
                        @if(Auth::user()->id == $document->filer_user->id)
                            <div class="flex items-center sm:flex sm:items-center sm:ml-6">
                                <a class="btn btn-success" href="/supportingdocuments/create?document_id={{$document->id}}"> Add Supporting Document</a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="max-w-sm p-3 mx-auto space-x-4 shadow-md bg-red rounded-xl">
                    <!-- 'doclink', 'document_id', -->
                    <table class="table table-hover">
                        <tr>
                            <th>Count</th>
                            <th>Support Document ID</th>
                            <th>Support Document Link</th>
                            <th width="280px">Action</th>
                        </tr>
                        @php
                            $i=0;
                        @endphp
                        @foreach ($supportdocs as $key => $doc)
                            <tr>
                                <td>{{ ++$i }}.</td>
                                <td>{{ $doc->id }}</td>
                                <td><a rel="noopener noreferrer" target="_blank" href={{ $doc->doclink}} target="">{{ $doc->doclink}}</a> </td>
                                <td>
                                    @if(Auth::user()->id == $document->filer_user->id)
                                        <!-- <a class="btn btn-info" href="{{ route('docapprovalguides.show',$doc->id) }}">Show</a> -->
                                        <a class="btn btn-primary" href="{{ route('supportingdocuments.edit',$doc) }}">&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a>
                                        {!! Form::open(['method' => 'DELETE','route' => ['supportingdocuments.destroy', $doc->id],'style'=>'display:inline']) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                    @endif
                                </td>
                            </tr>

                        @endforeach
                    </table>

            </div>
        </div>
    </div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
</x-app-layout>

