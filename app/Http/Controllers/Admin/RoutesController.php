<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Routes;
use App\Models\Stations;
use App\Models\TrainLine;
use Illuminate\Support\Facades\DB;

class RoutesController extends Controller
{
    //

    public function index()
    {

        $lineData = TrainLine::select('id', 'name')->get();

        $routeData = DB::select(DB::raw("SELECT routes.id,train_lines.name as lineName, Station.name as StationName,NextStation.name as NextStationName,routes.station_order,routes.distance From routes
        INNER JOIN train_lines on train_lines.id=routes.train_line_id INNER JOIN stations as Station on Station.id = routes.station_id 
        INNER JOIN stations as NextStation on NextStation.id = routes.next_station_id"));

        

        return view('admin.routes', compact('lineData', 'routeData'));

        //return response()->json(["lineData"=>$lineData,"RouteData"=>$routeData]);
    }

    public function add_routes(Request $request)
    {

        $train_line_id = $request->train_line_id;
        $station_id = $request->station_id;
        $next_station_id = $request->next_station_id;
        $station_order = $request->station_order;
        $distance = $request->distance;


        if ($train_line_id == null) {
            return back()->with('message', "Please Select A Train Line")->with('error', trans("Please Select a Train line"));
 
        }else if ($station_id == null) {
            return back()->with('message', "Please Select Start Station")->with('error', trans("Please Select Start Station"));
 
        }else if ($next_station_id == null) {
            return back()->with('message', "Please Select Next Station")->with('error', trans("Please Select Next Station"));
  
        }else {

            $routeCount = DB::table("routes")
                ->where("station_id", "=", $station_id)
                ->where("next_station_id", "=", $next_station_id)
                ->where("train_line_id", "=", $train_line_id)
                ->count();

            if ($routeCount >= 1) {
                return back()->with('message', "This route already exixts!")->with('error', trans("This route already exixts!"))->withInput();

            } else {

                Routes::create([
                    'train_line_id' => $train_line_id,
                    'station_id' => $station_id,
                    'next_station_id' => $next_station_id,
                    'station_order' => $station_order,
                    'distance' => $distance

                ]);

                return redirect('admin/routes')->with('success', trans("New Route Added successfully!"));
            }
        }
    }

    public function delete_routes($id)
    {

        $affectedRow = Routes::where('id', $id)->delete();

        if ($affectedRow == 1) {
            return redirect('admin/routes')->with('success', trans("Routes Deleted successfully!"));
        }
    }


    public function getStations($train_line_id)
    {

        $stationData = DB::table("stations")->where('train_line_id', $train_line_id)->select('id', 'name')->get();

        return response()->json(['data' => $stationData]);
    }

}


