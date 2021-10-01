<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Document Submission Manager - Edit form for submittal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">

                <div class="flex items-center max-w-sm p-3 mx-auto space-x-4 shadow-md bg-red rounded-xl">
                    <div class="pull-right">
                        <a class="btn btn-success" href="{{ route('documents.index') }}"> Back to documents list</a>
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
                    {!! Form::model($document, ['method' => 'PATCH','route' => ['documents.update', $document->id]]) !!}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Document Type:</strong>
                                    {!! Form::select('doctype_id', $doctypes_id, $document->doctypes_id, array('class' => 'form-control','multiple')) !!}
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Document Link:</strong>
                                    {!! Form::text('doclink', $document->doclink, array('placeholder' => 'Enter the form link here..','class' => 'form-control')) !!}
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Recepient User ID:</strong>
                                    {!! Form::select('archiver_user_id', $users_id, $document->archiver_user_id, array('class' => 'form-control','multiple')) !!}
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Approval status:</strong>
                                    {!! Form::number ('approval_status', $document->approval_status, array('placeholder' => 'enter approval status','class' => 'form-control')) !!}
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>User ID:</strong>
                                    {!! Form::number('filer_user_id', $user_id, array('placeholder' => 'user id','class' => 'form-control')) !!}
                                </div>
                            </div>

                            <div class="text-center col-xs-12 col-sm-12 col-md-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    {!! Form::close() !!}

                </div>

            </div>
        </div>
    </div>
</x-app-layout>

