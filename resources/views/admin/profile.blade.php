@extends('layouts.admin')

@section('meta')
<title>Profile | Metro Bangla</title>
<meta name="description" content="Metro Bangla Operator">
@endsection

@section('content')

<div class="container-fluid">

    <div class="row">
        <h2 class="page-title">{{ __("Profile") }}</h2>
    </div>

    <div class="row">
        <div class="box box-success">
            <div class="box-body">

                <form id="edit_system_user_form" action="{{ url('admin/profile/update') }}" class="ui form add-user" method="post" accept-charset="utf-8">

                    @csrf

                    <p class="lead">&nbsp;&nbsp;Contact Information</p>
                    <hr>

                    <div class="field">
                        <label>{{ __("Contact Email") }}</label>
                        <input id="contact_email" class="block mt-1 w-full" type="text" value="@isset($userData->contact_email){{ $userData->contact_email}}@endisset" placeholder="contactemail@mail.com" name="contact_email" />
                    </div>

                    <div class="two fields">

                        <div class="field">
                            <label>{{ __("Phone") }}</label>
                            <input id="phone" class="block mt-1 w-full" type="text" placeholder="01000-000000" maxlength="12" value="@isset($userData->phone){{ $userData->phone }}@endisset" name="phone" />
                        </div>

                        <div class="field">
                            <label>{{ __("Alternative Phone") }}</label>
                            <input id="altphone" class="block mt-1 w-full" type="text" placeholder="01000-000000" maxlength="12" value="@isset($userData->altphone){{ $userData->altphone }}@endisset" name="altphone" />
                        </div>

                    </div>

                    <p class="lead">&nbsp;&nbsp;Personal Information</p>
                    <hr>

                    <div class="two fields">

                        <div class="field">
                            <label>{{ __("First Name") }}</label>
                            <input id="first_name" class="block mt-1 w-full" type="text" value="@isset($userData->first_name){{ $userData->first_name }}@endisset" name="first_name" />
                        </div>

                        <div class="field">
                            <label>{{ __("Last Name") }}</label>
                            <input id="last_name" class="block mt-1 w-full" type="text" value="@isset($userData->last_name){{ $userData->last_name }}@endisset" name="last_name" />
                        </div>

                    </div>

                    <div class="two fields">

                        <div class="field">

                            <label>{{ __("Gender") }}</label>
                            <select id="gender" class="ui dropdown uppercase" name="gender">

                                @if($userData->gender=="MALE")
                                <option selected value="MALE">MALE</option>
                                <option value="FEMALE">FEMALE</option>
                                @elseif($userData->gender=="FEMALE")
                                <option value="MALE">MALE</option>
                                <option selected value="FEMALE">FEMALE</option>
                                @else
                                <option value="" selected disabled>Select Gender</option>
                                <option value="MALE">MALE</option>
                                <option value="FEMALE">FEMALE</option>
                                @endif

                            </select>
                        </div>

                        <div class="field">

                            <label>{{ __("Civil Status") }}</label>
                            <select id="civilstatus" class="ui dropdown uppercase" name="civilstatus">

                                @if($userData->civilstatus=="SINGLE")
                                <option selected value="SINGLE">SINGLE</option>
                                <option value="MARRIED">MARRIED</option>
                                <option value="LEGALLY SEPARATED">LEGALLY SEPARATED</option>
                                @elseif($userData->civilstatus=="MARRIED")
                                <option value="SINGLE">SINGLE</option>
                                <option selected value="MARRIED">MARRIED</option>
                                <option value="LEGALLY SEPARATED">LEGALLY SEPARATED</option>
                                @elseif($userData->civilstatus=="LEGALLY SEPARATED")
                                <option value="SINGLE">SINGLE</option>
                                <option value="MARRIED">MARRIED</option>
                                <option selected value="LEGALLY SEPARATED">LEGALLY SEPARATED</option>
                                @else
                                <option value="" disabled selected>Choose Civil Status</option>
                                <option value="SINGLE">SINGLE</option>
                                <option value="MARRIED">MARRIED</option>
                                <option value="LEGALLY SEPARATED">LEGALLY SEPARATED</option>
                                @endif

                            </select>

                        </div>

                    </div>

                    <p class="lead">&nbsp;&nbsp;Permanent Address</p>
                    <hr>

                    <div class="two fields">

                        <div class="field">
                            <label>{{ __("Division") }}</label>
                            <input id="division" class="block mt-1 w-full" type="text" value="@isset($userData->division){{ $userData->division }}@endisset" name="division" />
                        </div>

                        <div class="field">
                            <label>{{ __("District") }}</label>
                            <input id="district" class="block mt-1 w-full" type="text" value="@isset($userData->district){{ $userData->district }}@endisset" name="district" />
                        </div>

                    </div>

                    <div class="field">
                        <label>{{ __("Thana") }}</label>
                        <input id="thana" class="block mt-1 w-full" type="text" value="@isset($userData->thana){{ $userData->thana }}@endisset" name="thana" />
                    </div>

                    <div class="field">
                        <label>{{ __("Postal Code") }}</label>
                        <input id="postal_code" class="block mt-1 w-full" type="tel" placeholder="0100" pattern="[0-9]{4}" value="@isset($userData->postal_code){{ $userData->postal_code }}@endisset" name="postal_code" />
                    </div>

                    <div class="field">
                        <label>{{ __("Street") }}</label>
                        <input id="street" class="block mt-1 w-full" type="text" value="@isset($userData->street){{ $userData->street }}@endisset" name="street" />
                    </div>


                    <p class="lead">&nbsp;&nbsp;Present Address</p>
                    <hr>

                    &nbsp;&nbsp;
                    <input class="block mt-1 w-full form" type="checkbox" id="profile_clone" name="profile_clone" onchange="" value="">
                    <label for="profile_clone">&nbsp Same as Permanent Address</label><br><br>


                    <div class="two fields">

                        <div class="field">
                            <label>{{ __("Division") }}</label>
                            <input id="pres_division" class="block mt-1 w-full" type="text" value="@isset($userData->pres_division){{ $userData->pres_division }}@endisset" name="pres_division" />
                        </div>

                        <div class="field">
                            <label>{{ __("District") }}</label>
                            <input id="pres_district" class="block mt-1 w-full" type="text" value="@isset($userData->pres_district){{ $userData->pres_district }}@endisset" name="pres_district" />
                        </div>

                    </div>

                    <div class="field">
                        <label>{{ __("Thana") }}</label>
                        <input id="pres_thana" class="block mt-1 w-full" type="text" value="@isset($userData->pres_thana){{ $userData->pres_thana }}@endisset" name="pres_thana" />
                    </div>

                    <div class="field">
                        <label>{{ __("Postal Code") }}</label>
                        <input id="pres_postal_code" class="block mt-1 w-full" type="tel" placeholder="0100" pattern="[0-9]{4}" value="@isset($userData->pres_postal_code){{ $userData->pres_postal_code }}@endisset" name="pres_postal_code" />
                    </div>

                    <div class="field">
                        <label>{{ __("Street") }}</label>
                        <input id="pres_street" class="block mt-1 w-full" type="text" value="@isset($userData->pres_street){{ $userData->pres_street }}@endisset" name="pres_street" />
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

                <button class="btn btn-primary" type="submit" name="submit"><i class="ui checkmark icon"></i> {{ __("Update") }}</button>
                <a href="{{ url('admin') }}" class="btn btn-secondary"><i class="ui times icon"></i> {{ __("Cancel") }}</a>

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
                contact_email: {
                    identifier: 'contact_email',
                    rules: [{
                        type: 'email',
                        prompt: 'Please Enter Contact Email'
                    }]
                },
                phone: {
                    identifier: 'phone',
                    rules: [{
                        type: 'integer',
                        prompt: 'Please Enter Contact phone'
                    }]
                },
                altphone: {
                    identifier: 'altphone',
                    rules: [{
                        type: 'integer',
                        prompt: 'Please Enter Alternate Contact Phone'
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
                },
                gender: {
                    identifier: 'gender',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please Select a Gender'
                    }]
                },
                civilstatus: {
                    identifier: 'civilstatus',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please Select a Civil Status'
                    }]
                },
                division: {
                    identifier: 'division',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please Enter Division For Permanent Address'
                    }]
                },
                district: {
                    identifier: 'district',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please Enter District For Permanent Address'
                    }]
                },
                thana: {
                    identifier: 'thana',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please Enter Thana For Permanent Address'
                    }]
                },
                postal_code: {
                    identifier: 'postal_code',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please Enter Postal Code For Permanent Address'
                    }]
                },
                street: {
                    identifier: 'street',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please Enter Street For Permanent Address'
                    }]
                },
                pres_division: {
                    identifier: 'pres_division',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please Enter Division For Present Address'
                    }]
                },
                pres_district: {
                    identifier: 'pres_district',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please Enter District For Present Address'
                    }]
                },
                pres_thana: {
                    identifier: 'pres_thana',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please Enter Thana For Present Address'
                    }]
                },
                pres_postal_code: {
                    identifier: 'pres_postal_code',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please Enter Postal Code For Present Address'
                    }]
                },
                pres_street: {
                    identifier: 'pres_street',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please Enter Street For Present Address'
                    }]
                },
            }
        });


        $('#profile_clone').on('change', function() { // on change of state
            if (this.checked) // if changed state is "CHECKED"
            {
                // do the magic here
                $('#pres_division').val($('#division').val());
                $('#pres_district').val($('#district').val());
                $('#pres_thana').val($('#thana').val());
                $('#pres_postal_code').val($('#postal_code').val());
                $('#pres_street').val($('#street').val());
            }
        })

    });
</script>

@endsection