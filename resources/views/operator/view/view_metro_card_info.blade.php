@extends('layouts.operator')

@section('meta')
    <title>Metro Card Info | Metro Bangla</title>
    <meta name="description" content="Metro Bangla Operator">
@endsection 

@section('content')

<div class="container">

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

                <form id="add_user_form" action="{{ url('operator/metrocard/updateCard') }}" class="ui form add-user" method="post" accept-charset="utf-8">
            @csrf

            <div class="field">
                <input id="id" class="block mt-1 w-full" type="text" value="@isset($card_info_data->id){{ $card_info_data->id }}@endisset" name="id" class="readonly" hidden />
            </div>

            <div class="field">
                <input id="userid" class="block mt-1 w-full" type="text" value="@isset($userid){{ $userid}}@endisset" name="userid" class="readonly" hidden />
            </div>


            <div class="field">
                <label>{{ __("Card No") }}</label>
                <input id="card_no" class="block mt-1 w-full" type="number" value="@isset($card_info_data->card_no){{ $card_info_data->card_no }}@endisset" name="card_no" />
            </div>

            
            <div class="fields">
                <div class="sixteen wide field role">
                    <label for="">{{ __("Access Status") }}</label>
                    <select id="status" class="ui dropdown uppercase" name="status">
                        <option value="">Select Role</option>

                        @isset($card_info_data->status)
                        
                        @if($card_info_data->status==1)
                        <option selected value="1">Enabled</option>
                        <option value="0">Disabled</option>
                        @else
                        <option value="1">Enabled</option>
                        <option selected value="0">Disabled</option>
                        @endif
                        
                        @endisset
                    
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
      
        <a href="view/{{$userid}}" class="ui black grey small button"><i class="ui times icon"></i>{{ __("Cancel") }}</a>


    </div>
    </form>


            </div>
        </div>
    </div>
</div>

@endsection



