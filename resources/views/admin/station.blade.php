@extends('layouts.admin')

@section('meta')
<title>Stations | Metro Bangla</title>
<meta name="description" content="Workday users, view all users, add, edit, delete users">
@endsection

@section('content')
@include('admin.modals.add_stations')


<div class="container-fluid">

    <div class="row">
        <h2 class="page-title">{{ __("Stations") }}
            <button class="ui positive button mini offsettop5 btn-add float-right"><i class="ui icon plus"></i>{{ __("Add") }}</button>
        </h2>
    </div>

    <div class="row">
        <div class="box box-success">
            <div class="box-body">

                <table width="100%" class="table" id="dataTables-example" data-order='[[ 0, "asc" ]]'>
                    <thead class="thead-light">
                        <tr>
                            <th>{{ __("Serial") }}</th>
                            <th>{{ __("Name") }}</th>
                            <th>{{ __("Train Line") }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($serial=1)
                        @isset($stationData)
                        @foreach ($stationData as $val)
                        <tr>
                            <td>{{ $serial++ }}</td>
                            <td>{{ $val->name }}</td>
                            <td>{{ $val->linename }}</td>

                            <td class="align-right">
                                <a href="{{ url('admin/stations/view/'.$val->id) }}" class="ui circular basic icon button tiny"><i class="icon edit outline"></i></a>
                                <a href="{{ url('admin/stations/delete/'.$val->id) }}" onclick="return confirm('Are you sure you want to delete?')" class="ui circular basic icon button tiny"><i class="icon trash alternate outline"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script type="text/javascript">
    $('#dataTables-example').DataTable({
        responsive: true,
        pageLength: 10,
        lengthChange: false,
        searching: true,
        ordering: true
    });
</script>


<script>
    $(document).ready(function() {

        $('#add_station_form').form({
            fields: {


                train_line_id: {
                    identifier: 'train_line_id',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please Select A Train Line First'
                    }]
                },
                name: {
                    identifier: 'name',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please Enter Station name'
                    }]
                },

            }
        });

    });
</script>

@endsection