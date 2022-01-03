@extends('layouts.admin')

@section('meta')
<title>Routes | Metro Bangla</title>
<meta name="description" content="Workday users, view all users, add, edit, delete users">
@endsection

@section('content')
@include('admin.modals.add_routes')


<div class="container-fluid">

        <div class="row">
                <h2 class="page-title">{{ __("ROUTES") }}
                        <button class="ui positive button mini offsettop5 btn-add float-right"><i class="ui icon plus"></i>{{ __("Add") }}</button>
                </h2>
        </div>

        <div class="row">
                <div class="box box-success">
                        <div class="box-body">
                                @if ($errors->any())
                                <div class="ui error message">
                                        <i class="close icon"></i>
                                        <div class="header">{{ __("There were some errors with your submission") }}</div>
                                        <ul class="list">
                                                @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                                @endforeach
                                        </ul>
                                </div>
                                @endif
                                <table width="100%" class="table" id="dataTables-example" data-order='[[ 0, "asc" ]]'>
                                        <thead class="thead-light">
                                                <tr>
                                                        <th>{{ __("Serial") }}</th>
                                                        <th>{{ __("Train Line") }}</th>
                                                        <th>{{ __("Station") }}</th>
                                                        <th>{{ __("Next Station") }}</th>
                                                        <th>{{ __("Station Order") }}</th>
                                                        <th>{{ __("Distance") }}</th>
                                                        <th></th>
                                                </tr>
                                        </thead>
                                        <tbody>


                                                @php($serial=1)
                                                @isset($routeData)
                                                @foreach ($routeData as $val)
                                                <tr>
                                                        <td>{{ $serial++ }}</td>
                                                        <td>{{ $val->linename }}</td>
                                                        <td>{{ $val->stationname }}</td>
                                                        <td>{{ $val->nextstationname}}</td>
                                                        <td>{{ $val->station_order }}</td>
                                                        <td>{{ $val->distance }} Km</td>
                                                        <td class="align-right">
                                                                <a href="{{ url('admin/routes/delete/'.$val->id) }}" onclick="return confirm('Are you sure you want to delete?')" class="ui circular basic icon button tiny"><i class="icon trash alternate outline"></i></a>
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

                $("#train_line_id").change(function() {

                        var train_line_id = $(this).val();

                        // clear all values 
                        $('#station_id option:not(:first)').remove();
                        $('#next_station_id option:not(:first)').remove();


                        $.ajax({
                                url: 'routes/getStations/' + train_line_id,
                                type: 'get',
                                dataType: 'json',
                                success: function(response) {

                                        var len = 0;
                                        if (response.data != null) {
                                                len = response.data.length;
                                        }

                                        if (len > 0) {


                                                for (var i = 0; i < len; i++) {
                                                        var id = response.data[i].id;
                                                        var name = response.data[i].name;

                                                        var option = "<option value='" + id + "'>" + name + "</option>";

                                                        $("#station_id").append(option);
                                                        $("#next_station_id").append(option);

                                                }
                                        }
                                },

                        });
                });

                $('#add_routes_form').form({
                        fields: {
                                train_line_id: {
                                        identifier: 'train_line_id',
                                        rules: [{
                                                type: 'empty',
                                                prompt: 'Please Select A Train Line'
                                        }]
                                },
                                station_id: {
                                        identifier: 'station_Id',
                                        rules: [{
                                                type: 'empty',
                                                prompt: 'Please Select A Start Station'
                                        }]
                                },
                                next_station_id: {
                                        identifier: 'next_station_Id',
                                        rules: [{
                                                type: 'empty',
                                                prompt: 'Please Select A Next Station'
                                        }]
                                },
                                station_order: {
                                        identifier: 'station_order',
                                        rules: [{
                                                type: 'empty',
                                                prompt: 'Please Enter Station Order'
                                        }]
                                },
                                distance: {
                                        identifier: 'distance',
                                        rules: [{
                                                type: 'empty',
                                                prompt: 'Please Enter Distance'
                                        }]
                                },

                        }
                });

        });
</script>


@endsection