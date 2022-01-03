<div class="ui modal medium add">
    <div class="header">{{ __("Add New Train Line") }}</div>
    <div class="content">
        <form id="add_train_line_form" action="{{ url('admin/train_line/add') }}" class="ui form add-user" method="post" accept-charset="utf-8">
            @csrf
            <div class="field">
                <label>{{ __("Name") }}</label>
                <input id="name" class="block mt-1 w-full" type="text" name="name"  />
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

