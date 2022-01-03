@extends('layouts.operator')

@section('meta')
<title>Change Password | Metro Bangla</title>
<meta name="description" content="Metro Bangla Operator">
@endsection

@section('content')

<div class="container-fluid">

    <div class="row">
        <div class="box box-success">
            <div class="box-body">

                <form id="changePasswordForm" action="{{ url('operator/update_password') }}" class="ui form add-user" method="post" accept-charset="utf-8">

                    @csrf


                    <div class="field">
                        <label>{{ __("Old Password") }}</label>
                        <input id="old_password" class="block mt-1 w-full" type="password" value="@if(Session::has('old_password')){{Session::get('old_password')}}@endif" name="old_password" />
                    </div>

                    <div class="field">
                        <label>{{ __("New Password") }}</label>
                        <input id="new_password" class="block mt-1 w-full" type="text" value="@if(Session::has('new_password')){{Session::get('new_password')}}@endif" name="new_password" />
                    </div>

                    <div class="field">

                        @if(Session::has('message'))

                        <label class=" alert alert-success">{{Session::get('message') }}</label>

                        @endif

                    </div>


            </div>

            <div class="box-footer">

                <button class="ui positive approve small button" id="submit_btn" type="submit" name="submit"><i class="ui checkmark icon"></i> {{ __("Change") }}</button>
                <a href="{{ url('operator') }}" class="ui black grey small button"><i class="ui times icon"></i> {{ __("Cancel") }}</a>

            </div>

            </form>


        </div>
    </div>
</div>
</div>

@endsection

@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

<script>
    $(document).ready(function() {
        $("#changePasswordForm").validate({
            rules: {
                old_password: {
                    required: true,

                },
                new_password: {
                    required: true,
                    minlength: 8,
                    maxlength: 20,
                }
            },
            messages: {
                old_password: {
                    required: "Old Password is required",
                },
                new_password: {
                    required: "New Password is required",
                    maxlength: "Last name cannot be more than 20 characters"
                }

            }
        });

    });
</script>


@endsection