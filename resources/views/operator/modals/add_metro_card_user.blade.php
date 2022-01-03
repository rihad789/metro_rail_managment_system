<div class="ui modal medium add">
    <div class="header">{{ __("Add New Metro Card User") }}</div>
    <div class="content">
        <form id="add_metro_card_user_form" action="{{ url('operator/metrocard/register') }}" class="ui form add-user" method="post" accept-charset="utf-8">
            @csrf
            <div class="two fields">
                <div class="field">
                    <label for="">{{ __("First Name") }}</label>
                    <input id="first_name" type="text" name="first_name" class="block mt-1 w-full">
                </div>
                <div class="field">
                    <label for="">{{ __("Last Name") }}</label>
                    <input id="last_name" type="text" name="last_name" class="block mt-1 w-full">
                </div>
            </div>

            <div class="two fields">

                <div class="field">
                    <label for="gender">{{ __("Gender") }}</label>
                    <select id="gender" class="ui dropdown uppercase" name="gender">
                        <option value="" selected disabled>Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div class="field">
                    <label>{{ __("Email (Optional)") }}</label>
                    <input id="email" type="text" name="email" class="block mt-1 w-full">
                </div>

            </div>

            <div class="two fields">

                <div class="field">
                    <label>{{ __("NID") }}</label>
                    <input id="nid" class="block mt-1 w-full" type="text" placeholder="0100000000" maxlength="11" name="nid" />
                </div>

                <div class="field">
                    <label>{{ __("Phone") }}</label>
                    <input id="phone" class="block mt-1 w-full" type="text" placeholder="01000-000000" maxlength="12" name="phone" />
                </div>

            </div>

            <!-- <div class="field">
                <label>{{ __("NID") }}</label>
                <input id="nid" class="block mt-1 w-full" type="number" name="nid" />
            </div> -->

            <div class="two fields">
                <div class="field">
                    <label>{{ __("Division") }}</label>
                    <input id="division" class="block mt-1 w-full" type="text" name="division" />
                </div>
                <div class="field">
                    <label>{{ __("District") }}</label>
                    <input id="district" class="block mt-1 w-full" type="text" name="district" />
                </div>
            </div>

            <div class="two fields">
                <div class="field">
                    <label>{{ __("Thana") }}</label>
                    <input id="thana" class="block mt-1 w-full" type="text" name="thana" />
                </div>
                <div class="field">
                    <label>{{ __("Postal Code") }}</label>
                    <input id="postalcode" class="block mt-1 w-full" type="text" placeholder="0100" maxlength="4" name="postalcode" />
                </div>
            </div>

            <div class="field">
                <label>{{ __("Street") }}</label>
                <input id="street" class="block mt-1 w-full" type="text" name="street" />
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

        <button class="ui positive approve small button" type="submit" name="submit"><i class="ui checkmark icon"></i> {{ __("Register") }}</button>
        <button class="ui grey cancel small button" type="button"><i class="ui times icon"></i> {{ __("Cancel") }}</button>
    </div>
    </form>
</div>