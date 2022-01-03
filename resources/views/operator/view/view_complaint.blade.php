@extends('layouts.operator')

@section('meta')
<title>Edit Complain | Metro Bangla</title>
<meta name="description" content="Workday users, view all users, add, edit, delete users">
@endsection

@section('content')

<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <h2 class="page-title">{{ __("Complaint") }}</h2>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-content">

                    <form id="add_user_form" action="{{ url('operator/complaint/update') }}" class="ui form add-user" method="post" accept-charset="utf-8">
                        @csrf
                        <div class="field">
                            <input id="id" class="block mt-1 w-full" type="text" value="@isset($complaint->id){{ $complaint->id }}@endisset" name="id" class="readonly" hidden />
                        </div>

                        <div class="field">
                            <label>{{ __("Name") }}</label>
                            <input id="name" class="block mt-1 w-full" type="text" value="@isset($complaint->name){{ $complaint->name }}@endisset" name="name" class="readonly" readonly />
                        </div>

                        <div class="field">
                            <label>{{ __("Phone") }}</label>
                            <input id="phone" type="text" name="phone" class="block mt-1 w-full" value="@isset($complaint->phone){{ $complaint->phone }}@endisset" class="readonly" readonly>
                            <!-- <a href="tel:@isset($complaint->phone){{ $complaint->phone }}@endisset" class="ui circular basic icon button tiny"><i class="icon eye"></i></a> -->

                        </div>


                        <div class="field">
                            <label>{{ __("Complain Type") }}</label>
                            <input id="complain" type="text" name="complain" class="block mt-1 w-full" value="@isset($complaint->type){{ $complaint->type }}@endisset" class="readonly" readonly>
                        </div>

                        <div class="fields">
                            <div class="sixteen wide field role">
                                <label for="">{{ __("Complain Status") }}</label>
                                <select id="complain_status" class="ui dropdown" name="complain_status">

                                    <option value="">Select Status</option>
                                    @if($complaint->status == '1')

                                    <option selected value="1">Solution provided</option>
                                    <option value="0">Pending</option>

                                    @else

                                    <option value="1">Solution provided</option>
                                    <option selected value="0">Pending</option>

                                    @endif

                                </select>
                            </div>
                        </div>

                        <div class="field">
                            <div class="ui error message">
                                <i class="close icon"></i>
                                <div class="header"></div>
                                <ul class="list">
                                    <li class=""></li>
                                </ul>
                            </div>
                        </div>
                </div>
                <div class="box-footer">

                    <button class="ui positive approve small button" type="submit" name="submit"><i class="ui checkmark icon"></i> {{ __("Update") }}</button>
                    <a href="{{ url('operator/complaint') }}" class="ui black grey small button"><i class="ui times icon"></i> {{ __("Cancel") }}</a>

                </div>
                </form>

            </div>
        </div>

    </div>

</div>

@endsection