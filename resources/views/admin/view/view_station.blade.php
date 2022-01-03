@extends('layouts.admin')

@section('meta')
<title>View Station | Metro Bangla</title>
<meta name="description" content="Workday users, view all users, add, edit, delete users">
@endsection

@section('content')

<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <h2 class="page-title">{{ __("Edit Station") }}</h2>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-content">

                    <form id="add_user_form" action="{{ url('admin/stations/edit') }}" class="ui form add-user" method="post" accept-charset="utf-8">
                        @csrf

                        @isset($stationData)
                        @foreach ($stationData as $val)

                        <div class="field">
                            <input id="id" class="block mt-1 w-full" type="text" value="@isset($val->id){{ $val->id }}@endisset" name="id" class="readonly" hidden />
                        </div>

                        <div class="field">
                            <label>{{ __("Train Line Name") }}</label>
                            <input id="lineName" class="block mt-1 w-full" type="text" value="@isset($val->linename){{ $val->linename }}@endisset" name="lineName" readonly disabled />
                        </div>

                        <div class="field">
                            <label>{{ __("Station Name") }}</label>
                            <input id="name" class="block mt-1 w-full" type="text" value="@isset($val->name){{ $val->name }}@endisset" name="name" />
                        </div>

                        @endforeach
                        @endisset


                        <div class="field">

                            @if(Session::has('message'))

                            <label class=" alert alert-success">{{Session::get('message') }}</label>

                            @endif

                        </div>

                </div>
                <div class="box-footer">

                    <button class="ui positive approve small button" type="submit" name="submit"><i class="ui checkmark icon"></i> {{ __("Update") }}</button>
                    <a href="{{ url('admin/stations') }}" class="ui black grey small button"><i class="ui times icon"></i> {{ __("Cancel") }}</a>

                </div>
                </form>

            </div>
        </div>

    </div>

</div>

@endsection