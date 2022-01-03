<?php

namespace App\Http\Controllers\Operator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\MetroCard;
use App\Models\MetroCardUser;
use Illuminate\Support\Facades\DB;
use App\Models\Complaints;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    //

    public function index()
    {
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

     
        return view('operator.dashboard',compact('cardTotal','cardToday','cardMonth','cardYear','userTotal','userToday',
        'userdMonth','userYear','repliedComplaint','pendingComplaint','totalComplaint'));


    }

    public function complaint()
    {
        //$complaintData = DB::select(DB::raw("SELECT * FROM complaints"));

        $complaintData=Complaints::select('id','name','phone','type','status')->get();

        return view('operator.complaint', compact('complaintData'));

    }

    public function metrocard()
    {

        return view('operator.metrocard')->with('metro_card_data', MetroCardUser::all());
        //return view('operator.metrocard');

    }
}
