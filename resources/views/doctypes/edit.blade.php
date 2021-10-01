<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Document Type Manager - Edit Document Type') }}
        </h2>
    </x-slot>

    <div class="py-12">
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
                    {!! Form::model($doctype, ['method' => 'PATCH','route' => ['doctypes.update', $doctype->id]]) !!}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Document Link:</strong>
                                    {!! Form::text('emptydoclink', $doctype->emptydoclink, array('placeholder' => 'Enter the empty document here..','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Document Description:</strong>
                                    {!! Form::text('description', $doctype->description, array('placeholder' => 'description','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Form Number:</strong>
                                    {!! Form::text('form_number', $doctype->form_number, array('placeholder' => 'form_number','class' => 'form-control')) !!}
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Department ID:</strong>
                                    {!! Form::number ('department_id', $doctype->department_id, array('placeholder' => 'enter department_id','class' => 'form-control')) !!}
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

