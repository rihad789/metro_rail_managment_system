@extends('layouts.admin')

@section('meta')
<title>Train Line | Metro Bangla</title>
<meta name="description" content="Workday users, view all users, add, edit, delete users">
@endsection

@section('content')
@include('admin.modals.add_train_line')


<div class="container-fluid">

    <div class="row">
        <h2 class="page-title">{{ __("TRAIN LINE") }}
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
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($serial=1)
                        @isset($lineData)
                        @foreach ($lineData as $val)
                        <tr>
                            <td>{{ $serial++ }}</td>
                            <td>{{ $val->name }}</td>

                            <td class="align-right">
                                <a href="{{ url('/admin/train_line/view/'.$val->id) }}" class="ui circular basic icon button tiny"><i class="icon edit outline"></i></a>
                                <a href="{{ url('/admin/train_line/delete/'.$val->id) }}" onclick="return confirm('Are you sure you want to delete?')" class="ui circular basic icon button tiny remove-user"><i class="icon trash alternate outline"></i></a>
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
        pageLength: 15,
        lengthChange: false,
        searching: true,
        ordering: true
    });
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

<script>

    $(document).ready(function() {


        $('#add_train_line_form').form({
                        fields: {
                            name: {
                                        identifier: 'name',
                                        rules: [{
                                                type: 'empty',
                                                prompt: 'Please Enter Train Line  name'
                                        }]
                                },

                        }
                });

    });

</script>


@endsection