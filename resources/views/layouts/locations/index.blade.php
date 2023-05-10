<x-app-layout>
    <div class="col-md-12 col-sm-12  ">
        @include('layouts.flash.flash')
        <div class="x_panel">
            <div class="x_content">

                <a href="{{route('location.create')}}" class="btn btn-primary">
                    <i class="fa fa-plus"></i>
                    <span class="vr"></span>
                    Add New
                </a>

                <div class="table-responsive">
                    <table id="locationTable" class="table table-striped jambo_table bulk_action">
                        <thead>
                            <tr class="headings">
                                <th class="column-title">Department</th>
                                <th class="column-title">Location Name</th>
                                <th class="column-title">Location Address</th>
                                <th class="column-title">Status </th>
                                <th class="column-title"><span class="nobr">Action</span></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($data as $value)
                            <tr class="even pointer">
                                <td class=" ">{{$value->department->department}}</td>
                                <td class=" ">{{$value->location_name}}</td>
                                <td class=" ">{{$value->location_address}}</td>
                                <td class=" "> <span class="badge badge-secondary">{{$value->status->status ?? ''}}</span></td>
                                <td class=" ">
                                    <div class="btn-group">
                                        <a href="{{ route('location.edit', $value->id) }}" class="btn btn-info m-1 btn-sm rounded" title="Edit"><i class="fa fa-edit" small>&nbsp Edit</i></a>

                                        <form action="{{ route('location.destroy', $value->id) }}" method="POST">

                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger delete-header m-1 btn-sm rounded" title="Delete"><i class="fa fa-trash" small>&nbsp Delete</i></button>
                                        </form>
                                    </div>
                                </td>
                                </td>
                            </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>
@include('layouts.scripts.location-script')
@include('layouts.scripts.messages-script')