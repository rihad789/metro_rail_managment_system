<div class="ui modal medium add">
    <div class="header">{{ __("Add New Station") }}</div>
    <div class="content">
        <form id="add_station_form" action="{{ url('admin/stations/add') }}" class="ui form add-user" method="post" accept-charset="utf-8">
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

            <div class="field">
                <label>{{ __("Name") }}</label>
                <input id="name" class="block mt-1 w-full" type="text" name="name" />
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

        <button class="ui positive approve small button" type="submit" name="submit"><i class="ui checkmark icon"></i> {{ __("Add") }}</button>
        <button class="ui grey cancel small button" type="button"><i class="ui times icon"></i> {{ __("Cancel") }}</button>
    </div>
    </form>
</div>