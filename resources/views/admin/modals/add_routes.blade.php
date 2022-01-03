
<div class="ui modal medium add">
    <div class="header">{{ __("Add Train Routes") }}</div>
    <div class="content">
        <!-- <form id="add_routes_form" action="{{ url('admin/routes/add') }}" class="ui form add-user" method="post" accept-charset="utf-8"> -->

        <form id="add_routes_form" action="{{ url('admin/routes/add') }}" class="ui form add-user" method="post" accept-charset="utf-8">
            @csrf

            <div class="fields">
                <div class="sixteen wide field role">
                    <label for="">{{ __("Train Line") }}</label>
                    <select id="train_line_id" class="ui dropdown uppercase required" name="train_line_id" required>
                        <option value="">Select Train Line</option>

                        @foreach ($lineData as $val)
                        <option value={{ $val->id }}>{{ $val->name }}</option>
                        @endforeach

                    </select>
                </div>
            </div>

            <div class="fields">
                <div class="sixteen wide field role">
                    <label for="">{{ __("Start Station") }}</label>
                    <select id="station_id" class="ui dropdown uppercase" name="station_id">
                        <option value="">Select Start Station </option>

                    </select>
                </div>
            </div>

            <div class="fields">
                <div class="sixteen wide field role">
                    <label for="">{{ __("Next Station") }}</label>
                    <select id="next_station_id" class="ui dropdown uppercase" name="next_station_id">
                        <option value="">Select Next Station </option>


                    </select>
                </div>
            </div>

            
            <div class="field">
                <label>{{ __("Station Order") }}</label>
                <input id="station_order" type="number" name="station_order"  class="block mt-1 w-full" value="">
            </div>

            <div class="field">
                <label>{{ __("Distance") }}</label>
                <input id="distance" type="text" name="distance"  class="block mt-1 w-full" value="">
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
    <div class="actions">

        <button class="ui positive approve small button" type="submit" id="submit" name="submit"><i class="ui checkmark icon"></i> {{ __("Add") }}</button>
        <button class="ui grey cancel small button" type="button"><i class="ui times icon"></i> {{ __("Cancel") }}</button>
    </div>
    </form>
</div>


