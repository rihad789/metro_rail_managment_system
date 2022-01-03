<?php

namespace App\Http\Controllers;

use App\Models\MetroCardUserAccount;
use App\Models\Recharge_Histories;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Complaints;
use App\Models\JourneyFare;
use App\Models\MetroCard;
use App\Models\RechargeHistory;
use App\Models\TrainLine;
use Carbon\Carbon;
use Dflydev\DotAccessData\Data;



class MetroCardAppController extends Controller
{
    //

    public function login(Request $request)
    {

        $login_card_no = $request->login_card_no;
        $login_pin = $request->login_pin;


        $pinHashValueCount = DB::table("metro_cards")->select("pin")
            ->where("card_no", "=", $login_card_no)->count();

        if ($pinHashValueCount == 1 && $pinHashValueCount != 0) {

            $cardValue = DB::table("metro_cards")->select("pin", "status")
                ->where("card_no", "=", $login_card_no)->first();

            $hashedPin = $cardValue->pin;
            $status = $cardValue->status;

            if ($status == 0 && $status != 1) {
                return response()->json(['status' => '0', 'message' => 'Sorry! Your Card  is disabled']);
            } else {

                if (Hash::check($login_pin, $hashedPin)) {

                    $card_user_id = DB::table("metro_cards")->select("card_user_id")
                        ->where("card_no", "=", $request->login_card_no)->first();

                    $card_id = $card_user_id->card_user_id;

                    $card_user = DB::table("metro_card_users")->select("first_name", "last_name", "phone")
                        ->where("id", "=", $card_id)->first();

                    $first_name = $card_user->first_name;
                    $last_name = $card_user->last_name;
                    $mergeName = $first_name . " " . $last_name;
                    $phone = $card_user->phone;

                    $account_no = DB::table("metro_card_user_accounts")->select("account_no")
                        ->where("card_user_id", "=", $card_id)->first();

                    $account = $account_no->account_no;

                    return response()->json(['status' => '1', 'name' => $mergeName, 'card_user_id' => $card_id, 'account_no' => $account, "phone" => $phone]);
                } else {
                    return response()->json(['status' => '0', 'message' => 'PIN does not Match']);
                }
            }
        } else {
            return response()->json(['status' => '0', 'message' => 'Sorry! Your Card Number Not Found']);
        }
    }


    public function add_new_complaint(Request $request)
    {

        $complaint_registered = Complaints::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'type' => $request->complain_type,
            'status' => false
        ]);

        $complain_id = $complaint_registered->id;

        $is_complain_saved = DB::table("complaints")->where('id', $complain_id)->count();


        if ($is_complain_saved >= 1) {
            return response()->json(['status' => '1']);
        } else {
            return response()->json(['status' => '0']);
        }
    }


    public function retrieve_train_line()
    {

        $trainLine = DB::table("train_lines")->select("id", "name")->get();
        return response()->json(['trainLineData' => $trainLine]);
    }


    public function retrieve_station(Request $request)
    {

        $stationData = DB::table("stations")->select("id", "name")->where("train_line_id", $request->id)->get();
        return response()->json(['stationData' => $stationData]);
    }



    public function retrieve_recharge_history(Request $request)
    {
        $user_id = $request->user_id;

        $historyCount = DB::table("recharge_histories")
            ->where("recharged_by", "=", $user_id)
            ->count();



        if ($historyCount == 0) {
            return response()->json(["status" => "0"]);
        } else {
            $history = DB::table("recharge_histories")
                ->select("payment_from", "amount", "method", "transaction_id", "created_at")
                ->where("recharged_by", "=", $user_id)
                ->get();
            return response()->json(["status" => "1", "history" => $history]);
        }
    }

    public function retrieve_travel_history(Request $request)
    {
        $card_no = $request->card_no;

        $historyCount = DB::table("journey_fares")
            ->where("card_no", "=", $card_no)
            ->count();


        if ($historyCount == 0) {
            return response()->json(["status" => "0"]);
        } else {

            $history = DB::select(DB::raw("SELECT train_lines.name as lineName, Station.name as StationName,NextStation.name as NextStationName,journey_fares.distance,journey_fares.charged_fare,journey_fares.status,journey_fares.created_at,journey_fares.updated_at
            From journey_fares INNER JOIN train_lines on train_lines.id=journey_fares.line_id INNER JOIN stations as Station on Station.id = journey_fares.start_station 
            INNER JOIN stations as NextStation on NextStation.id = journey_fares.destination_station where journey_fares.card_no='$card_no'"));

            return response()->json(["status" => "1", "history" => $history]);
        }
    }


    public function retrieve_balance(Request $request)
    {

        $balance = DB::table("metro_card_user_accounts")->select("balance")
            ->where("account_no", "=", $request->account_no)->first();

        return response()->json(['status' => '1', 'balance' => $balance->balance]);
    }

    public function recharge_balance(Request $request)
    {

        $recharge_amount = $request->recharge_amount;
        $recharge_method = $request->recharge_method;
        $paymentNumber = $request->paymentNumber;
        $transaction_id = $request->transaction_id;
        $recharged_by = $request->recharged_by;
        $account_no = $request->account_no;


        $affectedRow = RechargeHistory::create([
            'amount' => $recharge_amount,
            'method' => $recharge_method,
            'payment_from' => $paymentNumber,
            'transaction_id' => $transaction_id,
            'recharged_by' => $recharged_by,

        ]);


        $balance = DB::table("metro_card_user_accounts")->select("balance")
            ->where("account_no", "=", $account_no)->first();

        $recharge_amount = $recharge_amount + $balance->balance;

        $affectedRow1 = MetroCardUserAccount::where('account_no', $account_no)->update(['balance' => $recharge_amount]);

        if ($affectedRow1 == 1 && $affectedRow1 != 0) {
            return response()->json(['status' => '1']);
        }
    }

    public function retrieve_routes(Request $request)
    {

        //
        $station_id = $request->station_id;
        $next_station_id = $request->next_station_id;
        $train_line_id = $request->train_line_id;


        $distanceData = "0";

        //Getting Next Station order
        $startStationOrder = DB::table("routes")
            ->select("station_order")
            ->where("train_line_id", "=", $train_line_id)
            ->where("station_id", "=", $station_id)
            ->first();

        $destinationStationOrder = DB::table("routes")
            ->select("station_order")
            ->where("train_line_id", "=", $train_line_id)
            ->where("station_id", "=", $next_station_id)
            ->first();

        //Getting Sirt Station name
        $firstStationName = DB::table("stations")
            ->select("name")
            ->where("id", "=", $station_id)
            ->first();

        $routeData = $firstStationName->name;

        //$status = "";

        $Station_Order = $startStationOrder->station_order;
        $Destination_Station_Order = $destinationStationOrder->station_order;

        if ($Station_Order < $Destination_Station_Order) {
            $status = "You are travelling right way and From Station " . $Station_Order . " To " . $Destination_Station_Order;

            $temp_station_id = $station_id;


            while ($temp_station_id != $next_station_id) {

                $New_Next_Station_Id = DB::table("routes")
                    ->select("next_station_id", "distance")
                    ->where("train_line_id", "=", $train_line_id)
                    ->where("station_id", "=", $temp_station_id)
                    ->first();


                $temp_station_id = $New_Next_Station_Id->next_station_id;


                $nextStationName = DB::table("stations")
                    ->select("name")
                    ->where("id", "=", $temp_station_id)
                    ->first();

                $routeData = $routeData . "=>" . $nextStationName->name;
                $distanceData = $distanceData + $New_Next_Station_Id->distance;
            }
        } else {

            //$status = "You are travelling Opposite way and From Station " . $Station_Order . " To " . $Destination_Station_Order;

            $temp_station_id = $station_id;


            while ($temp_station_id != $next_station_id) {

                $New_Next_Station_Id = DB::table("routes")
                    ->select("station_id", "distance")
                    ->where("train_line_id", "=", $train_line_id)
                    ->where("next_station_id", "=", $temp_station_id)
                    ->first();

                $temp_station_id = $New_Next_Station_Id->station_id;

                $nextStationName = DB::table("stations")
                    ->select("name")
                    ->where("id", "=", $temp_station_id)
                    ->first();

                $routeData = $routeData . "=>" . $nextStationName->name;
                $distanceData = $distanceData + $New_Next_Station_Id->distance;
            }
        }

        $fares_ratio = DB::table("fares")->first();
        $fare = $fares_ratio->fare;
        $fare = $fare * $distanceData;


        $distanceData = number_format($distanceData, 2, ".", "");
        $fare = number_format($fare, 2, ".", "");



        //return response()->json(['Status' => $status,"Station ID:"=>$data,"Route"=>$routeData,"Distance"=>$distanceData,"Fare"=>$fare]);

        return response()->json(["Route" => $routeData, "Distance" => $distanceData, "Fare" => $fare]);
    }

    public function change_card_pin(Request $request)
    {

        $card_no = $request->card_no;
        $old_pin = $request->old_pin;
        $new_pin = $request->new_pin;

        $oldPinHash = DB::table("metro_cards")->select("pin")
            ->where("card_no", "=", $card_no)->first();

        if (Hash::check($old_pin, $oldPinHash->pin)) {
            $affectedRow = MetroCard::where('card_no', $card_no)->update(['pin' => Hash::make($new_pin)]);

            if ($affectedRow == 1) {

                return response()->json(['status' => '1', 'message' => 'PIN chnaged Successfully']);
            }
        } else {

            return response()->json(['status' => '0', 'message' => 'Old pin does not match']);
        }
    }

    public function forgot_password_getPhone(Request $request)
    {

        $card_no = $request->card_no;

        $metro_cards = DB::table("metro_cards")->select("card_user_id")
            ->where("card_no", "=", $card_no)->first();

        if ($metro_cards == null) {
            return response()->json(["status" => "0", "message" => "Card no found"]);
        } else {
            $metro_card_users = DB::table("metro_card_users")->select("phone")
                ->where("id", "=", $metro_cards->card_user_id)->first();


            return response()->json(["status" => "1", "phone" => $metro_card_users->phone]);
        }
    }


    public function update_card_pin(Request $request)
    {

        $card_no = $request->card_no;
        $new_pin = $request->new_pin;


        $affectedRow = MetroCard::where('card_no', $card_no)->update(['pin' => Hash::make($new_pin)]);

        if ($affectedRow == 1) {

            return response()->json(['status' => '1', 'message' => 'PIN chnaged Successfully']);
        } else {
            return response()->json(['status' => '0', 'message' => 'Sorry! Unable to change PIN']);
        }
    }

    public function journey_Fare(Request $request)
    {

        $line_id = $request->line_id;
        $station_id = $request->station_id;
        $card_no = $request->card_no;

        $timestamp = Carbon::now()->toDateString();

        $countJourney = DB::table("journey_fares")
            ->where("card_no", "=", $card_no)
            ->where("created_at", "like", "$timestamp%")
            ->where("status", "=", 0)
            ->count();


        if ($countJourney == 1) {
            $journeyFare = DB::table("journey_fares")->select("start_station")
                ->where("card_no", "=", $card_no)
                ->where("status", "=", 0)
                ->where("created_at", "like", "$timestamp%")
                ->first();

            $distanceData = $this->getDistance($journeyFare->start_station, $station_id, $line_id);

            $fares_ratio = DB::table("fares")->first();
            $fare = $fares_ratio->fare;
            $fare = $fare * $distanceData;


            $cardData = DB::table("metro_cards")->select("card_user_id")
                ->where("card_no", "=", $card_no)
                ->first();

            $cardAccountData = DB::table("metro_card_user_accounts")->select("account_no", "balance")
                ->where("card_user_id", "=", $cardData->card_user_id)
                ->first();

            $cardBalance = $cardAccountData->balance;
            $account_no = $cardAccountData->account_no;

            if ($fare < $cardBalance) {

                $timestamp2 = Carbon::now()->toDateTimeString();

                $affectedRow = DB::table("journey_fares")
                    ->where("card_no", "=", $card_no)
                    ->where("status", "=", 0)
                    ->where("created_at", "like", "$timestamp%")
                    ->update(["status" => 1, "destination_station" => $station_id, "distance" => $distanceData, "charged_fare" => $fare, "updated_at" => $timestamp2]);

                if ($affectedRow == 1) {

                    $finalBalance = $cardBalance - $fare;
                    $affectedRow2 = DB::table("metro_card_user_accounts")
                        ->where("account_no", "=", $account_no)
                        ->update(["balance" => $finalBalance]);

                    if ($affectedRow2) {
                        return response()->json(["Status" => "1", "Message" => "Exit Gates open."]);
                    }
                }
            } else {
                return response()->json(["Status" => "0", "Message" => "Insufficient Balance"]);
            }
        } else {
            $save_journey = JourneyFare::create([
                'line_id' => $line_id,
                'start_station' => $station_id,
                'card_no' => $card_no
            ]);

            return response()->json(["Status" => "1", "Message" => "Entry Gates open"]);
        }
    }

    public function getDistance($station_id, $next_station_id, $train_line_id)
    {

        //

        $distanceData = "0";

        //Getting Next Station order
        $startStationOrder = DB::table("routes")
            ->select("station_order")
            ->where("train_line_id", "=", $train_line_id)
            ->where("station_id", "=", $station_id)
            ->first();

        $destinationStationOrder = DB::table("routes")
            ->select("station_order")
            ->where("train_line_id", "=", $train_line_id)
            ->where("station_id", "=", $next_station_id)
            ->first();

        //Getting Sirt Station name
        $firstStationName = DB::table("stations")
            ->select("name")
            ->where("id", "=", $station_id)
            ->first();


        $Station_Order = $startStationOrder->station_order;
        $Destination_Station_Order = $destinationStationOrder->station_order;

        if ($Station_Order < $Destination_Station_Order) {
            $status = "You are travelling right way and From Station " . $Station_Order . " To " . $Destination_Station_Order;

            $temp_station_id = $station_id;


            while ($temp_station_id != $next_station_id) {

                $New_Next_Station_Id = DB::table("routes")
                    ->select("next_station_id", "distance")
                    ->where("train_line_id", "=", $train_line_id)
                    ->where("station_id", "=", $temp_station_id)
                    ->first();


                $temp_station_id = $New_Next_Station_Id->next_station_id;


                $nextStationName = DB::table("stations")
                    ->select("name")
                    ->where("id", "=", $temp_station_id)
                    ->first();

                $distanceData = $distanceData + $New_Next_Station_Id->distance;
            }
        } else {

            //$status = "You are travelling Opposite way and From Station " . $Station_Order . " To " . $Destination_Station_Order;

            $temp_station_id = $station_id;


            while ($temp_station_id != $next_station_id) {

                $New_Next_Station_Id = DB::table("routes")
                    ->select("station_id", "distance")
                    ->where("train_line_id", "=", $train_line_id)
                    ->where("next_station_id", "=", $temp_station_id)
                    ->first();

                $temp_station_id = $New_Next_Station_Id->station_id;

                $nextStationName = DB::table("stations")
                    ->select("name")
                    ->where("id", "=", $temp_station_id)
                    ->first();

                $distanceData = $distanceData + $New_Next_Station_Id->distance;
            }
        }

        return $distanceData;
    }
}
