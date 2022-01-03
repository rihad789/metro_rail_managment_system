<?php

namespace App\Http\Controllers\Admin;

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

    public function admin_profile()
    {


        $userEmail = Auth::user()->email;

        $userData = DB::table("users")
            ->select(
                "users.contact_email",
                "users.phone",
                "users.altphone",
                "users.first_name",
                "users.last_name",
                "users.gender",
                "users.civilstatus",
                "users.division",
                "users.district",
                "users.thana",
                "users.street",
                "users.postal_code",
                "users.pres_division",
                "users.pres_district",
                "users.pres_thana",
                "users.pres_street",
                "users.pres_postal_code"
            )
            ->where("email", "=", $userEmail)
            ->first();


        return view('admin.profile', compact('userData'));
        //return response()->json(["userData"=> $userData]);
    }

    public function admin_profile_update(Request $request)
    {

        $userEmail = Auth::user()->email;

        $contact_email = $request->contact_email;
        $phone = $request->phone;
        $altphone = $request->altphone;
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $gender = $request->gender;
        $civilstatus = $request->civilstatus;

        $division = $request->division;
        $district = $request->district;
        $thana = $request->thana;
        $street = $request->street;
        $postal_code = $request->postal_code;

        $pres_division = $request->pres_division;
        $pres_district = $request->pres_district;
        $pres_thana = $request->pres_thana;
        $pres_postal_code = $request->pres_postal_code;
        $pres_street = $request->pres_street;


        $affectedRow = DB::update("UPDATE users SET contact_email = '$contact_email', phone = '$phone', altphone = '$altphone', first_name = '$first_name',
         last_name = '$last_name', gender = '$gender', civilstatus = '$civilstatus',division = '$division', district = '$district', thana = '$thana', 
         street = '$street', postal_code = '$postal_code',pres_division = '$pres_division', pres_district = '$pres_district', pres_thana = '$pres_thana',
         pres_postal_code = '$pres_postal_code', pres_street = '$pres_street' WHERE email= '$userEmail'");

        //return response()->json(['contact_email' => $contact_email, 'phone' => $phone, 'altphone' => $altphone, 'first_name' => $first_name, 'last_name' => $last_name, 'gender' => $gender, 'civilstatus' => $civilstatus,'division' => $division, 'district' => $district, 'thana' => $thana, 'street' => $street, 'postal_code' => $postal_code,'pres_division' => $pres_division, 'pres_district' => $pres_district, 'pres_thana' => $pres_thana, 'pres_postal_code' => $pres_postal_code, 'pres_street' => $pres_street]);


        if ($affectedRow == 1) {
            return redirect('admin/profile')->with('success', trans("Profile Updated Successfully!"));
        } else {
            return back()->with('error', trans("Profile is Already updated!"));
        }
    }


    public function admin_account()
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


        return view('admin.account', compact('userData'));
    }


    public function update_admin_account(Request $request)
    {


        $id = $request->id;
        $email = $request->email;
        //$first_name = $request->first_name;
        //$last_name = $request->last_name;

        $affectedRow = DB::update("UPDATE users SET email = '$email' WHERE id= '$id'");

        //return response()->json(['contact_email' => $contact_email, 'phone' => $phone, 'altphone' => $altphone, 'first_name' => $first_name, 'last_name' => $last_name, 'gender' => $gender, 'civilstatus' => $civilstatus,'division' => $division, 'district' => $district, 'thana' => $thana, 'street' => $street, 'postal_code' => $postal_code,'pres_division' => $pres_division, 'pres_district' => $pres_district, 'pres_thana' => $pres_thana, 'pres_postal_code' => $pres_postal_code, 'pres_street' => $pres_street]);


        if ($affectedRow == 1) {
            return redirect('admin/account')->with('success', trans("Account Updated Successfully!"));
        } else {
            return back()->with('error', trans("Account is Already updated!"));
        }

    }


    public function admin_update_password(Request $request)
    {

        $auth_email = Auth::user()->email;

        //$auth_email="ebnaamirfoysal@yahoo.com";

        $old_password = str_replace(' ', '', $request->old_password);;
        $new_password = str_replace(' ', '', $request->new_password);

        $oldPasswordHash = User::select('password')
            ->where("email", "=", $auth_email)
            ->first();

        if (Hash::check($old_password, $oldPasswordHash->password)) {
            $affectedRow = User::where('email', $auth_email)->update(['password' => Hash::make($new_password)]);

            if ($affectedRow == 1) {

                return redirect('/admin/account')->with('success', trans("Password changed successfully!"));
            }
        } else {

            return redirect('/admin/account')->with('error', trans("Sorry! Old Password doesn't match!"));
        }


        //return response()->json(['message' => 'Successfully Posted']);
    }


    public function users()
    {

        $userEmail = Auth::user()->email;

        $user = DB::select(DB::raw("select users.id,users.email,users.first_name,users.last_name,roles.display_name from users 
            INNER JOIN role_user on role_user.user_id=users.id INNER JOIN roles on roles.id=role_user.role_id where NOT users.email='$userEmail'"));

        return view('admin.users', compact('user'));
    }


    public function add_users(Request $request)
    {

        $emailExixt = DB::table("users")
            ->where("email", "=", $request->email)
            ->count();

        if ($emailExixt >= 1) {
            return back()->with('error', trans("User already registered!"))->withInput();
        } else {
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user->attachRole("operator");

            return redirect('admin/users')->with('success', trans("User registered successfully!"));
        }
    }

    public function view_users($id)
    {

        $userEmail = Auth::user()->email;

        $userData = DB::table("users")
            ->select(
                "users.id",
                "users.email",
                "users.contact_email",
                "users.phone",
                "users.altphone",
                "users.first_name",
                "users.last_name",
                "users.gender",
                "users.civilstatus",
                "users.division",
                "users.district",
                "users.thana",
                "users.street",
                "users.postal_code",
                "users.pres_division",
                "users.pres_district",
                "users.pres_thana",
                "users.pres_street",
                "users.pres_postal_code"
            )
            ->where("id", "=", $id)
            ->first();

        return view('admin.view.view_user', compact('userData'));


        //return response()->json(['userData'=>$userData]);
    }


    public function update_users(Request $request)
    {

        $id = $request->id;

        $email = $request->email;
        $contact_email = $request->contact_email;
        $phone = $request->phone;
        $altphone = $request->altphone;
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $gender = $request->gender;
        $civilstatus = $request->civilstatus;

        $division = $request->division;
        $district = $request->district;
        $thana = $request->thana;
        $street = $request->street;
        $postal_code = $request->postal_code;

        $pres_division = $request->pres_division;
        $pres_district = $request->pres_district;
        $pres_thana = $request->pres_thana;
        $pres_postal_code = $request->pres_postal_code;
        $pres_street = $request->pres_street;


        $affectedRow = DB::update("UPDATE users SET email = '$email' , contact_email = '$contact_email', phone = '$phone', altphone = '$altphone', first_name = '$first_name',
         last_name = '$last_name', gender = '$gender', civilstatus = '$civilstatus',division = '$division', district = '$district', thana = '$thana', 
         street = '$street', postal_code = '$postal_code',pres_division = '$pres_division', pres_district = '$pres_district', pres_thana = '$pres_thana',
         pres_postal_code = '$pres_postal_code', pres_street = '$pres_street' WHERE id= $id");

        //return response()->json(['contact_email' => $contact_email, 'phone' => $phone, 'altphone' => $altphone, 'first_name' => $first_name, 'last_name' => $last_name, 'gender' => $gender, 'civilstatus' => $civilstatus,'division' => $division, 'district' => $district, 'thana' => $thana, 'street' => $street, 'postal_code' => $postal_code,'pres_division' => $pres_division, 'pres_district' => $pres_district, 'pres_thana' => $pres_thana, 'pres_postal_code' => $pres_postal_code, 'pres_street' => $pres_street]);


        if ($affectedRow == 1) {
            return redirect('admin/users')->with('success', trans("Operator Profile Updated Successfully!"));
        } else {
            return back()->with('error', trans("Profile is Already Updated!"));
        }
    }

    public function delete_users($id)
    {

        $affectedRow = User::where('id', $id)->delete();

        if ($affectedRow == 1) {


            $affectedRowRole = DB::table('role_user')
                ->where('user_id', $id)
                ->delete();

                if ($affectedRowRole == 1) {

                    return redirect('admin/users')->with('success', trans("Users Deleted successfully!"));
                }

        }
    }
}

