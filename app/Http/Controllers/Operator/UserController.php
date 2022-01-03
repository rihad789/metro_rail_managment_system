<?php

namespace App\Http\Controllers\Operator;

use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    //

    public function index()
    {

        $userEmail = Auth::user()->email;

        $userData = DB::table("users")
            ->select("users.email","users.contact_email", "users.phone","users.altphone","users.first_name","users.last_name","users.gender",
            "users.civilstatus", "users.division", "users.district", "users.thana", "users.street", "users.postal_code", "users.pres_division", "users.pres_district", "users.pres_thana", "users.pres_street", "users.pres_postal_code")
            ->where("email", "=", $userEmail)
            ->first();

        return view('operator.profile', compact('userData'));
    }

    public function update_profile(Request $request)
    {

        $userEmail = Auth::user()->email;

        $contact_email = $request->contact_email;
        $altphone = $request->altphone;
        $last_name = $request->last_name;

        $pres_division = $request->pres_division;
        $pres_district = $request->pres_district;
        $pres_thana = $request->pres_thana;
        $pres_postal_code = $request->pres_postal_code;
        $pres_street = $request->pres_street;

        $affectedRow = DB::update("UPDATE users SET contact_email = '$contact_email',altphone = '$altphone',
         last_name = '$last_name',pres_division = '$pres_division', pres_district = '$pres_district', pres_thana = '$pres_thana',
         pres_postal_code = '$pres_postal_code', pres_street = '$pres_street' WHERE email= '$userEmail'");

        //return response()->json(['contact_email' => $contact_email, 'phone' => $phone, 'altphone' => $altphone, 'first_name' => $first_name, 'last_name' => $last_name, 'gender' => $gender, 'civilstatus' => $civilstatus,'division' => $division, 'district' => $district, 'thana' => $thana, 'street' => $street, 'postal_code' => $postal_code,'pres_division' => $pres_division, 'pres_district' => $pres_district, 'pres_thana' => $pres_thana, 'pres_postal_code' => $pres_postal_code, 'pres_street' => $pres_street]);


        if ($affectedRow == 1) {
            return redirect('operator/profile')->with('success', trans("Profile Updated Successfully!"));
        }
        else
        {
            return back()->with('error', trans("Profile is Already Updated!"));
        }
    }

    public function account()
    {
        $userEmail = Auth::user()->email;

        $userData = DB::table("users")
            ->select(
                "users.id",
                "users.email",
                "users.first_name",
                "users.last_name",
            )
            ->where("email", "=", $userEmail)
            ->first();


        return view('operator.account', compact('userData'));
    }


    public function update_operator_account(Request $request)
    {

        $userEmail = Auth::user()->email;

        $id = $request->id;
        $email = $request->email;
        //$first_name = $request->first_name;
        //$last_name = $request->last_name;

        $affectedRow = DB::update("UPDATE users SET email = '$email' WHERE id= '$id'");

        //return response()->json(['contact_email' => $contact_email, 'phone' => $phone, 'altphone' => $altphone, 'first_name' => $first_name, 'last_name' => $last_name, 'gender' => $gender, 'civilstatus' => $civilstatus,'division' => $division, 'district' => $district, 'thana' => $thana, 'street' => $street, 'postal_code' => $postal_code,'pres_division' => $pres_division, 'pres_district' => $pres_district, 'pres_thana' => $pres_thana, 'pres_postal_code' => $pres_postal_code, 'pres_street' => $pres_street]);


        if ($affectedRow == 1) {
            return redirect('operator/account')->with('success', trans("Account Updated Successfully!"));
        } else {
            return back()->with('error', trans("Account is Already updated!"));
        }

    }

    public function update_password(Request $request)
    {

        $auth_email = Auth::user()->email;

        //$auth_email="ebnaamirfoysal@yahoo.com";

        $old_password = str_replace(' ', '', $request->old_password);;
        $new_password = str_replace(' ', '', $request->new_password);

        //$string = str_replace(' ', '', $request->new_password);

        $oldPasswordHash = User::select('password')
            ->where("email", "=", $auth_email)
            ->first();

        if (Hash::check($old_password, $oldPasswordHash->password)) {
            $affectedRow = User::where('email', $auth_email)->update(['password' => Hash::make($new_password)]);

            if ($affectedRow == 1) {

                return redirect('/operator/account')->with('success', trans("Password changed successfully!"));
            }
        } else {

            $message = "Old Password doesn't match";
            return redirect('/operator/account')->with('error', trans("Sorry! Old Password doesn't match!"));
        }


        //return response()->json(['message' => 'Successfully Posted']);
    }
}
