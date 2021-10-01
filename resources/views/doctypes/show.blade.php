<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Documents Manager - Document Details') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">

                <div class="flex items-center max-w-sm p-3 mx-auto space-x-4 shadow-md bg-red rounded-xl">
                    <div class="pull-right">
                        <a class="btn btn-success" href="{{ route('doctypes.index') }}"> Back to doctypes list</a>
                    </div>
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
                <div class="flex items-center max-w-sm p-3 mx-auto space-x-4 shadow-md bg-red rounded-xl">

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Empty Document Link:</strong>
                                <a href={{ $doctype->emptydoclink}}>{{ $doctype->emptydoclink}}</a>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Form Number:</strong>
                                {{ $doctype->form_number }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Description:</strong>
                                {{ $doctype->description }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Department:</strong>
                                {{ $doctype->department_id }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-2">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="items-center max-w-sm p-3 mx-auto space-x-4 shadow-md bg-red rounded-xl">
                    <div class="flex justify-between h-16">
                        <h4 class="flex items-center">List of Approving Authorities for this document</h4>
                        <div class="flex items-center sm:flex sm:items-center sm:ml-6">
                            <a class="btn btn-success" href="/docapprovalguides/create?doctype_id={{$doctype->id}}"> Create Document Approval Guide</a>
                        </div>
                    </div>
                </div>
                <div class="flex items-center max-w-sm p-3 mx-auto space-x-4 shadow-md bg-red rounded-xl">

                    <table class="table table-hover">
                        <tr>
                            <th>doctype_id</th>
                            <th>approver_sequence</th>
                            <th>approver_user_id</th>
                            <th width="280px">Action</th>
                        </tr>
                        @foreach ($doctype->find($doctype->id)->docapprovalguides as $docapprovalguide)
                            <tr>
                                <td>{{ $docapprovalguide->doctype_id}}</td>
                                <td>{{ $docapprovalguide->approver_sequence}}</td>
                                @if ($docapprovalguide->approver!=null)
                                <td>{{ $docapprovalguide->approver->email}} &nbsp;&nbsp;-&nbsp;&nbsp; {{$docapprovalguide->approver->name}}</td>
                                @else
                                <td> not found </td>
                                @endif
                                <td>
                                    <!--
                                    <a class="btn btn-info" href="{{ route('docapprovalguides.show',$docapprovalguide->id) }}">Show</a>
                                    -->
                                    <a class="btn btn-primary" href="{{ route('docapprovalguides.edit',$docapprovalguide) }}">&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a>
                                    {!! Form::open(['method' => 'DELETE','route' => ['docapprovalguides.destroy', $docapprovalguide->id],'style'=>'display:inline']) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>

                        @endforeach
                    </table>

            </div>
        </div>
    </div>
</x-app-layout>

