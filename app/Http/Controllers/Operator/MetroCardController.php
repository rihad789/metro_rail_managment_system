<?php

namespace App\Http\Controllers\Operator;

use App\Models\MetroCardUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Complaints;
use App\Models\MetroCard;
use App\Models\MetroCardUserAccount;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MetroCardController extends Controller
{

    //Register New Metro Card User
    public function register_metro_card_user(Request $request)
    {
        //


        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $gender = $request->gender;
        $email = $request->email;
        $phone = $request->phone;
        $nid = $request->nid;
        $division = $request->division;
        $district = $request->district;
        $thana = $request->thana;
        $street = $request->street;
        $postalcode = $request->postalcode;


        $is_card_user_exist = DB::table("metro_card_users")->where('nid', $nid)->count();

        if ($is_card_user_exist >= 1) {
            return redirect('operator/metrocard')->with('error', trans("Are you sure? This NID is registered!"));
        }

        $user = MetroCardUser::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'email' => $request->email,
            'phone' => $request->phone,
            'nid' => $request->nid,
            'division' => $request->division,
            'district' => $request->district,
            'thana' => $request->thana,
            'street' => $request->street,
            'postalcode' => $request->postalcode,
        ]);

        $new_card_user_id = $user->id;
        $account_no = mt_rand($postalcode, $nid);

        $card_user = MetroCardUserAccount::create([
            'card_user_id' => $new_card_user_id,
            'account_no' => $account_no,
            'balance' => '0',

        ]);

        return redirect('operator/metrocard')->with('success', trans("New Metro Card Registered Successfully!"));

        // return response()->json(['message'=>'Successfully Posted']);
    }


    //View Metro Card User info
    public function view_metro_card_user($id)
    {
        //

        $card_info_data = DB::table("metro_cards")
            ->select("id", "card_no", "status", "updated_at")
            ->where("metro_cards.card_user_id", "=", $id)
            ->get();

        $card_user_accountData = DB::table("metro_card_user_accounts")
            ->select("id", "account_no", "balance")
            ->where("metro_card_user_accounts.card_user_id", "=", $id)
            ->first();

        // SELECT * from card_infos where card_infos.card_user_id=4

        $card_userData = DB::table("metro_card_users")->where('id', $id)->first();

        return view('operator.view.view_metro_card', compact('card_userData', 'card_user_accountData', 'card_info_data'));

        //return response()->json(['message'=>$card_info_data,'Card User Account Data'=>$card_user_accountData,'Card user Data'=>$card_userData]);

    }

    //Issue New Metro Card
    public function issue_new_card(Request $request)
    {
        //

        $account_no = $request->account_no;
        $id = $request->id;
        $pin = $request->pin;

        $number = mt_rand($pin, $account_no);

        $card_user_id = DB::table("metro_card_user_accounts")
            ->select("card_user_id")
            ->where("account_no", "=", $request->account_no)
            ->first();

        $user = MetroCard::create([
            'card_no' => $number,
            'card_user_id' => $card_user_id->card_user_id,
            'pin' => Hash::make($request->pin),
            'status' => 1

        ]);

        //print_r($card_user_id);


        return redirect('operator/metrocard/view/' . $id)->with('success', trans("New Metro Travel Card Issued successfully!"));

        //return response()->json(['message'=>'Successfully Posted']);
    }

    //view Metro Card
    public function view_metro_card(Request $request)
    {
        //

        $id = $request->id;
        $userid = $request->userid;

        $card_info_data = DB::table("metro_cards")
            ->select("id", "card_no", "status")
            ->where("metro_cards.id", "=", $id)
            ->first();

        //return response()->json(['card_info'=>$id.$user]);

        return view('operator.view.view_metro_card_info', compact('card_info_data', 'userid'));

        //return response()->json(['message'=>'Successfully Retrieved'.$id.$userid]);
    }


        //view Metro Card
        public function update_metro_card(Request $request)
        {
            //
    
            $id=$request->id;
            $userid=$request->userid;
            $card_no=$request->card_no;
            $status=$request->status;
    
            //$timestamp=Carbon::now()->toDateTimeString();

            $affectedRow=MetroCard::where('id',$id)->update(['status'=>$status]);

            if($affectedRow==1)
            {
                return redirect('operator/metrocard/view/' . $userid)->with('success', trans("Metro Card Status Updated successfully!"));
            }
        }


        public function view_complaint($id)
        {

            //$complaintData=MetroCard::where('id',$id)->select(['id'=>$id]);

            $complaint=Complaints::select('id','name', 'phone', 'type','status')
                           ->where('id', '=', $id)
                           ->first();


            //return response()->json(['message'=>$complaintData]);
            
            return view('operator.view.view_complaint', compact('complaint'));

        }


        public function update_complaint_status(Request $request)
        {
            $id=$request->id;
            $complain_status=$request->complain_status;
    

            $affectedRow=Complaints::where('id',$id)->update(['status'=>$complain_status]);

            if($affectedRow==1)
            {
                return redirect('operator/complaint')->with('success', trans("Complaint Status Updated successfully!"));
            }

            //return response()->json(['message'=>"Data Posted"]);

        }

    
}
