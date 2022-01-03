<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Fares;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Complaints;


class DashboardController extends Controller
{
    //

    public function index()
    {
        $lineCount=DB::table("train_lines")->count();
        $stationCount=DB::table("stations")->count();
        $routesCount=DB::table("routes")->count();
        $userCount=DB::table("users")->count();
        $fareData = DB::table("fares")->where("id", "=", 1)->first();

        
        $timestamp = Carbon::now()->toDateString();
        $year=Carbon::parse($timestamp)->year;
        $month=Carbon::parse($timestamp)->month;

        if($month.strlen(1)) {  $month="0".$month; }

        $dateTime=$year."-".$month;

        //Retrieving Total Registered Card user Count for all time.
        $userTotal=DB::table("metro_card_users")->count();

        //Retrieving Registered Card user Count for this year
        $userYear=DB::table("metro_card_users")->where("created_at", "like", "$year%")->count();

        //Retrieving Registered Card user Count for this Month
        $userdMonth=DB::table("metro_card_users")->where("created_at", "like", "$dateTime%")->count();

        //Retrieving Registered Card user Count for today
        $userToday=DB::table("metro_card_users")->where("created_at", "like", "$timestamp%")->count();

        //Retrieving Total Issued Card Count for all time.
        $cardTotal=DB::table("metro_cards")->count();

        //Retrieving Issued Card Count for this year
        $cardYear=DB::table("metro_cards")->where("created_at", "like", "$year%")->count();

        //Retrieving Issued Card Count for this Month
        $cardMonth=DB::table("metro_cards")->where("created_at", "like", "$dateTime%")->count();

        //Retrieving Issued Card Count for today
        $cardToday=DB::table("metro_cards")->where("created_at", "like", "$timestamp%")->count();

         
        //Rretrieving Complaint Count
        $repliedComplaint=Complaints::where('status', '=', true)->count();

        $pendingComplaint=Complaints::where('status', '=', false)->count();

        $totalComplaint=Complaints::count();

        //Selecting Complaint Count



        $lineCount=DB::table("train_lines")->count();
        $stationCount=DB::table("stations")->count();
        $routesCount=DB::table("routes")->count();

        $userEmail = Auth::user()->email;

        $userCount=DB::table("users")->count();
        $fareData = DB::table("fares")->where("id", "=", 1)->first();
        
        return view('admin.dashboard',compact('cardTotal','cardToday','cardMonth','cardYear','userTotal','userToday',
        'userdMonth','userYear','repliedComplaint','pendingComplaint','totalComplaint','lineCount','stationCount','routesCount','userCount','fareData'));

        //return view('admin.dashboard');
    }


    public function fare()
    {

        $fareDataCount = DB::table("fares")
            ->where("id", "=", 1)
            ->count();

        if ($fareDataCount == 1) {

            $fareData = DB::table("fares")
                ->where("id", "=", 1)
                ->first();
        } else {

            $user = Fares::create([
                'id' => 1,
                'fare' => 0,
            ]);

            $fareData = DB::table("fares")
                ->where("id", "=", 1)
                ->first();
        }

        //return response()->json(['farDara'=>$fareData]);

        return view('admin.fare', compact('fareData'));
    }

    public function update_fare(Request $request)
    {

        $id = $request->id;
        $fare = $request->fare;

        $affectedRow = Fares::where('id', $id)
            ->update(['fare' => $fare]);

        if ($affectedRow == 1) {
            return redirect('admin/fare')->with('success', trans("Fares Updated successfully!"));
        }
    }
}
