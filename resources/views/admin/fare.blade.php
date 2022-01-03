
@extends('layouts.admin')

@section('meta')
    <title>Fare | Metro Bangla</title>
    <meta name="description" content="Workday users, view all users, add, edit, delete users">
@endsection 

@section('content')

<div class="container-fluid">

    <div class="row">
        <div class="box box-success">
            <div class="box-body">

                <form id="add_user_form" action="{{ url('admin/fare/update') }}" class="ui form add-user" method="post" accept-charset="utf-8">
            @csrf
            <div class="field">
                <input id="id" class="block mt-1 w-full" type="text" value="@isset($fareData->id){{ $fareData->id }}@endisset" name="id" class="readonly" hidden />
            </div>

            <div class="field">
                <label>{{ __("Fare Ratio Per KM") }}</label>
                <input id="fare" class="block mt-1 w-full" type="number" step="0.01" value="@isset($fareData->fare){{ $fareData->fare}}@endisset" name="fare" />
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
        <a href="{{ url('admin') }}" class="ui black grey small button"><i class="ui times icon"></i> {{ __("Cancel") }}</a>

    </div>
    </form>


            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
$('#dataTables-example').DataTable({responsive: true,pageLength: 15,lengthChange: false,searching: true,ordering: true});

</script>
@endsection

