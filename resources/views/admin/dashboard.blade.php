@extends('layouts.admin')

@section('meta')
<title>Dashboard | Metro Bangla Rail</title>
<meta name="description" content="Metro Bangla Operator">
@endsection

@section('content')


<div class="container-fluid">

        <div class="row">


                <div class="col-md-6">

                        <!-- Card user Count Data -->

                        <div class="box box-success">

                                <div class="box-content">

                                        <h4 style="text-align: center;">METRO CARD USER REGISTERED</h4>

                                        <table width="100%" class="table" id="dataTables-example" data-order='[[ 0, "asc" ]]'>

                                                <thead class="thead-light">
                                                        <tr>
                                                                <th>{{ __("Title") }}</th>
                                                                <th>{{ __("Value") }}</th>

                                                        </tr>
                                                </thead>

                                                <tbody>

                                                        <tr>

                                                                <td>Total</td>
                                                                <td>{{$userTotal}}</td>

                                                        </tr>

                                                        <tr>
                                                                <td>This Year</td>
                                                                <td>{{$userYear}}</td>

                                                        </tr>

                                                        <tr>
                                                                <td>This month</td>
                                                                <td>{{$userdMonth}}</td>

                                                        </tr>

                                                        <tr>
                                                                <td>Today</td>
                                                                <td>{{$userToday}}</td>

                                                        </tr>

                                                </tbody>
                                        </table>

                                </div>

                        </div>


                </div>


                <div class="col-md-6">

                        <!-- Card user Count Data -->

                        <div class="box box-success">

                                <div class="box-content">

                                        <h4 style="text-align: center;">METRO CARD ISSUED</h4>

                                        <table width="100%" class="table" id="dataTables-example" data-order='[[ 0, "asc" ]]'>

                                                <thead class="thead-light">
                                                        <tr>
                                                                <th>{{ __("Title") }}</th>
                                                                <th>{{ __("Value") }}</th>

                                                        </tr>
                                                </thead>

                                                <tbody>

                                                        <tr>

                                                                <td>Total</td>
                                                                <td>{{$cardTotal}}</td>

                                                        </tr>

                                                        <tr>
                                                                <td>This Year</td>
                                                                <td>{{$cardYear}}</td>

                                                        </tr>

                                                        <tr>

                                                                <td>This month</td>
                                                                <td>{{$cardMonth}}</td>

                                                        </tr>

                                                        <tr>

                                                                <td>Today</td>
                                                                <td>{{$cardToday}}</td>

                                                        </tr>

                                                </tbody>

                                        </table>

                                </div>

                        </div>


                </div>


        </div>


        <div class="row">


                <div class="col-md-6">

                        <!-- Card user Count Data -->

                        <div class="box box-success">

                                <div class="box-content">

                                        <h4 style="text-align: center;">METRO DATA</h4>

                                        <table width="100%" class="table" id="dataTables-example" data-order='[[ 0, "asc" ]]'>

                                                <thead class="thead-light">
                                                        <tr>
                                                                <th>{{ __("Title") }}</th>
                                                                <th>{{ __("Value") }}</th>

                                                        </tr>
                                                </thead>

                                                <tbody>

                                                        <tr>

                                                                <td>Train Lines</td>
                                                                <td>{{$lineCount}}</td>

                                                        </tr>

                                                        <tr>
                                                                <td>Stations</td>
                                                                <td>{{$stationCount}}</td>

                                                        </tr>

                                                        <tr>

                                                                <td>Routes</td>
                                                                <td>{{$routesCount}}</td>

                                                        </tr>

                                                        <tr>

                                                                <td>Operators</td>
                                                                <td>{{$userCount}}</td>

                                                        </tr>

                                                        <tr>

                                                                <td>Fare Ratio Per K.M</td>
                                                                <td>{{$fareData->fare}} Tk</td>

                                                        </tr>

                                                </tbody>

                                        </table>

                                </div>

                        </div>


                </div>


                <div class="col-md-6">

                        <!-- Card user Count Data -->

                        <div class="box box-success">

                                <div class="box-content">

                                        <h4 style="text-align: center;">COMPLAINT</h4>

                                        <table width="100%" class="table" id="dataTables-example" data-order='[[ 0, "asc" ]]'>

                                                <thead class="thead-light">
                                                        <tr>
                                                                <th>{{ __("Title") }}</th>
                                                                <th>{{ __("Value") }}</th>

                                                        </tr>
                                                </thead>

                                                <tbody>

                                                        <tr>

                                                                <td>Total Registered</td>
                                                                <td>{{$totalComplaint}}</td>

                                                        </tr>

                                                        <tr>
                                                                <td>Pending</td>
                                                                <td>{{$pendingComplaint}}</td>

                                                        </tr>

                                                        <tr>
                                                                <td>Solved</td>
                                                                <td>{{$repliedComplaint}}</td>

                                                        </tr>

                                                </tbody>

                                        </table>

                                </div>

                        </div>


                </div>


        </div>


</div>

@endsection