@extends('layouts.operator')

@section('meta')
    <title>Metro Card | Metro Bangla</title>
    <meta name="description" content="Metro Bangla Operator">
@endsection 

@section('content')
@include('operator.modals.add_metro_card_user')

<div class="container-fluid">

<div class="row">
            <h2 class="page-title">{{ __("Metro Card") }}
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
                            <th>{{ __("Name") }}</th>
                            <th>{{ __("Phone") }}</th>
                            <th>{{ __("NID") }}</th>
                            <th></th>
                        </tr>
                    </thead> 

                    <tbody>
                       @php($serial=1)
                       @isset($metro_card_data)
                        @foreach ($metro_card_data as $val)
                        <tr>
                            <td>{{ $serial++ }}</td> 
                            <td>{{ $val->first_name }},{{ $val->last_name }}</td>
                            <td>{{ $val->phone }}</td>
                            <td>{{ $val->nid }}</td>

                            <td class="align-right">
                                <a href="{{ url('operator/metrocard/view/'.$val->id) }}" class="ui circular basic icon button tiny"><i class="icon eye"></i></a>
                                <!-- <a href="{{ url('/card_user/delete/'.$val->id) }}" class="ui circular basic icon button tiny"><i class="icon trash alternate outline"></i></a> -->
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<script type="text/javascript">

$('#dataTables-example').DataTable({responsive: true,pageLength: 10,lengthChange: false,searching: true,ordering: true});

</script>

<script>
    $(document).ready(function() {

        $('#add_metro_card_user_form').form({
            fields: {
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
                nid: {
                    identifier: 'nid',
                    rules: [{
                        type: 'integer',
                        max: 11,
                        prompt: 'Please Enter NID  Number'
                    }]
                },
                phone: {
                    identifier: 'phone',
                    rules: [{
                        type: 'integer',
                        prompt: 'Please Enter Contact phone'
                    }]
                },
                division: {
                    identifier: 'division',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please Enter Division'
                    }]
                },
                district: {
                    identifier: 'district',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please Enter District'
                    }]
                },
                thana: {
                    identifier: 'thana',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please Enter Thana'
                    }]
                },
                postalcode: {
                    identifier: 'postalcode',
                    rules: [{
                        type: 'integer',
                        prompt: 'Please Enter Postal Code'
                    }]
                },
                street: {
                    identifier: 'street',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please Enter Street'
                    }]
                }

            }
        });

    });
</script>


@endsection

