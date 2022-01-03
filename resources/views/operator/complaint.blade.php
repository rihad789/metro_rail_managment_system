@extends('layouts.operator')

@section('meta')
    <title>Complaint | Metro Bangla</title>
    <meta name="description" content="Workday users, view all users, add, edit, delete users">
@endsection 

@section('content')

<div class="container-fluid">

<div class="row">
        <h2 class="page-title">{{ __("COMPLAINTS") }}

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
                            <th>{{ __("Solution Status") }}</th>
                            <th></th>
                        </tr>
                    </thead> 
                    <tbody>
                       @php($serial=1)
                       @isset($complaintData)
                        @foreach ($complaintData as $val)
                        <tr>
                            <td>{{ $serial++ }}</td> 
                            <td>{{ $val->name }}</td>
                            <td>{{ $val->phone }}</td>
                            <td>
                                <span>
                                @if($val->status == '1') 
                                    Solution Provided
                                @else
                                    Pending
                                @endif
                                </span>
                            </td>
                            <td class="align-right">
                                <a href="{{ url('operator/complaint/view/'.$val->id) }}" class="ui circular basic icon button tiny"><i class="icon eye"></i></a>
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
                pageLength: 8,
                lengthChange: false,
                searching: true,
                ordering: true
        });
</script>

@endsection

