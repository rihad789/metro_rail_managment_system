<div class="ui modal medium add">
    <div class="header">{{ __("Issue New Card") }}</div>
    <div class="content">
        <form id="issue_card_form" action="{{ url('operator/metrocard/issue_new_card') }}" class="ui form add-user" method="post" accept-charset="utf-8">
            @csrf


            <div class="fields">
                <div class="sixteen wide field role">
                    <input id="id" class="block mt-1 w-full" type="number" value="@isset($card_userData->id){{ $card_userData->id }}@endisset" class="readonly" readonly name="id" hidden>

                </div>
            </div>
            
            <div class="fields">
                <div class="sixteen wide field role">
                    <label for="">{{ __("Account No") }}</label>
                    <input id="account_no" class="block mt-1 w-full" type="text"  value="@isset($card_user_accountData->account_no){{ $card_user_accountData->account_no }}@endisset" class="readonly" readonly name="account_no">

                </div>
            </div>

            <div class="field">
                <label>{{ __("PIN") }}</label>
                <input id="pin" class="block mt-1 w-full" type="text" placeholder="0100" maxlength="4"   name="pin"  />
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