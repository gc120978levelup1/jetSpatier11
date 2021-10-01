<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Document Type Manager') }}
        </h2>
    </x-slot>
    <div class="py-5 mx-auto max-w-7xl sm:px-6 lg:px-8 ">
        <img  class="float-left object-cover p-1 rounded-full h-25 w-25" src="https://www.planetware.com/wpimages/2020/02/france-in-pictures-beautiful-places-to-photograph-eiffel-tower.jpg">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam venenatis et lorem sit amet vehicula. Etiam vel nibh nec nisi euismod mollis ultrices condimentum velit. Proin velit libero, interdum ac rhoncus sit amet, pellentesque ac turpis. Quisque ac luctus turpis, vel efficitur ante. Cras convallis risus vel vehicula dapibus. Donec eget neque fringilla, faucibus mi quis, porttitor magna. Cras pellentesque leo est, et luctus neque rutrum eu. Aliquam consequat velit sed sem posuere, vitae sollicitudin mi consequat. Mauris eget ipsum sed dui rutrum fringilla. Donec varius vehicula magna sit amet auctor. Ut congue vehicula lectus in blandit. Vivamus suscipit eleifend turpis, nec sodales sem vulputate a. Curabitur pulvinar libero viverra, efficitur odio eu, finibus justo. Etiam eu vehicula felis.</p>
    </div>
    <!-- py-10 means put 10 spaces from above-->
    <div>
        <!-- kini na div below has class width fixed -->
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <!-- kini na div below has class to make all items horizontally aligned -->
               <div class="flex p-3 shadow-md">
                    <div class="pull-right">
                        <a class="btn btn-success" href="{{ route('doctypes.create') }}"> Create New Document</a>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="p-2 shadow-md rounded-xl">

                    <table class="table table-hover">
                        <tr>
                            <th>No</th>
                            <th>form_number</th>
                            <th>description</th>
                            <th>department_id</th>
                            <th width="280px">Action</th>
                        </tr>
                        @foreach ($doctypes as $key => $doctype)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $doctype->form_number}}</td>
                                <td>{{ $doctype->description}}</td>
                                <td>{{ $doctype->department_id}}</td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('doctypes.show',$doctype->id) }}">Show</a>
                                    <a class="btn btn-primary" href="{{ route('doctypes.edit',$doctype->id) }}">Edit</a>
                                        {!! Form::open(['method' => 'DELETE','route' => ['doctypes.destroy', $doctype->id],'style'=>'display:inline']) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {!! $doctypes->render() !!}
                </div>
            </div>
            <br/>
        </div>
    </div>
</x-app-layout>

