@extends('layouts.operator')

@section('meta')
<title>Account | Metro Bangla</title>
<meta name="description" content="Metro Bangla Admin">
@endsection

@section('content')

<div class="container-fluid">

    <div class="row">
        <h2 class="page-title">{{ __("Account") }}</h2>
    </div>

    <div class="row">

        <div class="box box-success">

            <div class="box-body">

                <form id="edit_system_user_form" action="{{ url('operator/account/update') }}" class="ui form add-user" method="post" accept-charset="utf-8">

                    @csrf

                    <p class="lead">&nbsp;&nbsp;Profile</p>
                    <hr>

                    <div class="field">
                        <input id="id" class="block mt-1 w-full" type="text" value="@isset($userData->id){{ $userData->id }}@endisset" name="id" class="readonly" hidden />
                    </div>

                    <div class="two fields">

                        <div class="field">
                            <label>{{ __("First Name") }}</label>
                            <input id="first_name" class="block mt-1 w-full" type="text" value="@isset($userData->first_name){{ $userData->first_name }}@endisset" name="first_name" class="readonly" disabled />
                        </div>

                        <div class="field">
                            <label>{{ __("Last Name") }}</label>
                            <input id="last_name" class="block mt-1 w-full" type="text" value="@isset($userData->last_name){{ $userData->last_name }}@endisset" name="last_name" class="readonly" disabled />
                        </div>

                    </div>

                    <div class="field">
                        <label>{{ __("Login Email") }}</label>
                        <input id="email" class="block mt-1 w-full" type="text" value="@isset($userData->email){{ $userData->email}}@endisset" placeholder="contactemail@mail.com" name="email" />
                        <hr>
                        <label>{{ __("Be aware!This email address is your identity on Metrobangla and is used to login") }}</label>
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
                <button class="btn btn-primary" type="submit" name="submit"><i class="ui checkmark icon"></i> {{ __("Update Profile") }}</button>
            </div>
            </form>

        </div>
    </div>

    <div class="row">
        <div class="box box-success">
            <div class="box-body">

                <form id="changePasswordForm" action="{{ url('operator/account/update_password') }}" class="ui form add-user" method="post" accept-charset="utf-8">

                    @csrf
                    <p class="lead">&nbsp;&nbsp;Password</p>
                    <hr>

                    <div class="field">
                        <label>{{ __("Old Password") }}</label>
                        <input id="old_password" class="block mt-1 w-full" type="password" value="@if(Session::has('old_password')){{Session::get('old_password')}}@endif" name="old_password" autocomplete="off" />
                    </div>

                    <div class="field">
                        <label>{{ __("New Password") }}</label>
                        <input id="new_password" class="block mt-1 w-full" type="password" value="@if(Session::has('new_password')){{Session::get('new_password')}}@endif" name="new_password" />
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

                <button class="btn btn-primary" id="submit_btn" type="submit" name="submit"><i class="ui checkmark icon"></i> {{ __("Change Password") }}</button>

            </div>

            </form>

        </div>
    </div>

</div>

</div>

@endsection


@section('scripts')


<script>
    $(document).ready(function() {

        $('#edit_system_user_form').form({
            fields: {
                email: {
                    identifier: 'email',
                    rules: [{
                        type: 'email',
                        prompt: 'Please Provide Login Email'
                    }]
                },
                first_name: {
                    identifier: 'first_name',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please Enter First Name'
                    }]
                },
                last_name: {
                    identifier: 'last_name',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please Enter Last Name'
                    }]
                }
            }
        });


        $("#changePasswordForm").validate({
            rules: {
                new_password: {
                    minlength: 8,
                    maxlength: 20,
                }
            },
            messages: {
                new_password: {
                    minlength:"New Password must be 8 character long",
                    maxlength: "New Password cannot be more than 20 characters"
                }
            }
        });


        $('#changePasswordForm').form({
            fields: {
                old_password: {
                    identifier: 'old_password',
                    rules: [{
                        type: 'empty',
                        prompt: 'Old Password Required'
                    }]
                },
                new_password: {
                    identifier: 'new_password',
                    rules: [{
                        type: 'empty',
                        prompt: 'New Password Required'
                    }]
                }
            }
        });


    });
</script>

@endsection