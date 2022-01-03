@extends('layouts.operator')

@section('meta')
<title>View Card User | Metro Bangla</title>
<meta name="description" content="Metro Bangla Operator">
@endsection

@section('content')
@include('operator.modals.add_metro_card')


<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <h2 class="page-title">{{ __("Metro Card") }}
                <button class="ui positive button mini offsettop5 btn-add float-right"><i class="ui icon plus"></i>{{ __("Add") }}</button>
            </h2>
        </div>
    </div>

    <div class="row">

        <!-- Card User Data column Start -->

        <div class="col-md-6">

            <div class="box box-success">

                <div class="box-content">

                    <h4 style="text-align: center;">METRO CARD USER INFO</h4>

                    <table width="100%" class="table">

                        <thead class="thead-light">
                            <tr>

                                <th>{{ __("Title") }}</th>
                                <th>{{ __("Value") }}</th>

                            </tr>
                        </thead>

                        <tbody>

                            <tr>
                                <td>Name</td>
                                <td>@isset($card_userData->first_name){{ $card_userData->first_name }}@endisset , @isset($card_userData->last_name){{ $card_userData->last_name }}@endisset</td>
                            </tr>

                            <tr>
                                <td>Email</td>
                                <td>@isset($card_userData->email){{ $card_userData->email }}@endisset</td>
                                <!-- <td><a href="mailto:@isset($card_userData->email){{ $card_userData->email }}@endisset" class="ui circular basic icon button tiny"><i class="icon mail"></i></a> -->
                            </tr>

                            <tr>
                                <td>Phone</td>
                                <td>@isset($card_userData->phone){{ $card_userData->phone }}@endisset</td>
                                <!-- <td><a href="tel:@isset($card_userData->phone){{ $card_userData->phone }}@endisset" class="ui circular basic icon button tiny"><i class="icon phone"></i></a> -->
                            </tr>

                            <tr>
                                <td>NID</td>
                                <td>@isset($card_userData->nid){{ $card_userData->nid }}@endisset</td>
                            </tr>

                            <tr>
                                <td>Division</td>
                                <td>@isset($card_userData->division){{ $card_userData->division }}@endisset</td>
                            </tr>

                            <tr>
                                <td>District</td>
                                <td>@isset($card_userData->district){{ $card_userData->district }}@endisset</td>
                            </tr>

                            <tr>
                                <td>Thana</td>
                                <td>@isset($card_userData->thana){{ $card_userData->thana }}@endisset</td>
                            </tr>

                            <tr>
                                <td>Postal Code</td>
                                <td>@isset($card_userData->postalcode){{ $card_userData->postalcode }}@endisset</td>
                            </tr>

                            <tr>
                                <td>Street</td>
                                <td>@isset($card_userData->street){{ $card_userData->street }}@endisset</td>
                            </tr>

                        </tbody>
                    </table>

                </div>

            </div>

        </div>

        <!-- Card User Data column End -->

        <!-- Card Info Data column Start -->

        <div class="col-md-6">


            <div class="container-fluid">

                <div class="row">

                    <!-- Card user Account Data -->

                    <div class="box box-success">

                        <div class="box-content">

                            <h4 style="text-align: center;">METRO CARD USER ACCOUNT INFO</h4>

                            <table width="100%" class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>{{ __("Serial") }}</th>
                                        <th>{{ __("Account No") }}</th>
                                        <th>{{ __("Balance") }}</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php($serial=1)
                                    @isset($card_user_accountData)

                                    <tr>
                                        <td>{{ $serial++ }}</td>
                                        <td>{{ $card_user_accountData->account_no}}</td>
                                        <td>{{ $card_user_accountData->balance}}</td>

                                        <!-- <td class="align-right">
                                <a href="{{ url('/card_user/view/'.$card_user_accountData->id) }}" class="ui circular basic icon button tiny"><i class="icon eye"></i></a>
                                <a href="{{ url('/card_user/delete/'.$card_user_accountData->id) }}" class="ui circular basic icon button tiny"><i class="icon trash alternate outline"></i></a>
                            </td> -->
                                    </tr>

                                    @endisset
                                </tbody>
                            </table>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <!-- Card Data -->

                    <div class="box box-success">

                        <div class="box-content">

                            <h4 style="text-align: center;">METRO CARD INFO</h4>

                            <table width="100%" class="table" id="dataTables-example" data-order='[[ 0, "asc" ]]'>

                                <thead class="thead-light">
                                    <tr>
                                        <th>{{ __("Serial") }}</th>
                                        <th>{{ __("Card No") }}</th>
                                        <th>{{ __("Status") }}</th>
                                        <th>{{ __("Update Time") }}</th>
                                        <th></th>

                                    </tr>
                                </thead>

                                <tbody>
                                    @php($serial=1)
                                    @isset($card_info_data)
                                    @foreach ($card_info_data as $val)
                                    <tr>
                                        <td>{{ $serial++ }}</td>
                                        <td>{{ $val->card_no}}</td>
                                        <td>

                                            @if($val->status==1)
                                            Enabled
                                            @else
                                            Disabled
                                            @endif

                                        </td>

                                        <td>{{$val->updated_at}}</td>

                                        <td class="align-right">
                                            @if($val->status==1)

                                            <a href="/operator/metrocard/viewCard?id={{$val->id}}&userid={{$card_userData->id}}" class="ui circular basic icon button tiny"><i class="icon edit"></i></a>

                                            @endif

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


            <!--  Finished -->

        </div>

        <!-- Card Info Data column End -->

    </div>

</div>

@endsection

@section('scripts')


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

<script type="text/javascript">
    $('#dataTables-example').DataTable({
        responsive: true,
        lengthChange: false,
        searching: true,

    });
</script>

<script>
    $(document).ready(function() {
        $("#issue_card_form").validate({
            rules: {
                pin: {
                    required: true,
                    maxlength: 4,
                    minlength: 4
                }
            },
            messages: {
                pin: {
                    required: "PIN is required",
                    minlength: "PIN Can not be less than 3 digits",
                    maxlength: "PIN Can not be more than 4 digits"
                }

            }
        });
    });
</script>

@endsection