<?php

namespace App\Http\Controllers\Admin;

use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Stations;
use App\Models\TrainLine;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class StationController extends Controller
{

    public function index()
    {

        $lineData = TrainLine::select('id', 'name')->get();


        $stationData = DB::select( DB::raw("select stations.id,stations.name,train_lines.name as linename 
                           from stations INNER JOIN train_lines on stations.train_line_id=train_lines.id")); 

        return view('admin.station', compact('lineData', 'stationData'));

        //return response()->json(['message'=>$stationData]);

    }

    public function add_station(Request $request)
    {

        $name = $request->name;
        $train_line_id = $request->train_line_id;


        if ($train_line_id == null) {
            return back()->with('message', "Please Select A Train Line")->with('error', trans("Please Select a Train line"));
            //return response()->json(['message'=>'Data Posted']);
        } else {

            $is_station_exist = DB::table("stations")->where('name', $name)->where('train_line_id',$train_line_id)->count();

            if ($is_station_exist == 1) {
                return redirect('admin/stations')->with('error', trans(" This station is already exist!"));
            }

            Stations::create([
                'name' => $name,
                'train_line_id' => $train_line_id

            ]);
            

            return redirect('admin/stations')->with('success', trans("New Station Added successfully!"));
        }

        //return response()->json(['message'=>'Data Posted']);

    }

    public function view_station($id)  
    {

        $stationData = DB::select( DB::raw("select stations.id,stations.name,train_lines.name as linename 
                           from stations INNER JOIN train_lines on stations.train_line_id=train_lines.id AND stations.id= $id")); 

        return view('admin.view.view_station', compact('stationData'));

        //return response()->json(['stationData'=>$stationData]);
    }

    public function edit_station(Request $request)
    {

        $id = $request->id;
        $name = $request->name;

        $is_station_exist = DB::table("stations")->where('name', $name)->count();

        if ($is_station_exist == 1) {
            return back()->with('message', trans(" Are you sure? This Station is already exist!"));
        } else {

            $affectedRow = Stations::where('id', $id)
                ->update(['name' => $name]);

            if ($affectedRow == 1) {
                return redirect('admin/stations')->with('success', trans("Train Line Updated successfully!"));
            }
        }


        //return redirect('admin/train_line')->with('success', trans("Train Line Updated successfully!"));

        //return response()->json(['message'=>'Edit Line Data Posted']);

    }

    public function delete_station($id)
    {

        //DB::table("train_lines")->where('name', $name)->delete();

        $affectedRow = Stations::where('id', $id)->delete();

        if ($affectedRow == 1) {
            return redirect('admin/stations')->with('success', trans("Stations Deleted successfully!"));
        }

        //return response()->json(['message' => 'Delete Line Data Posted']);
    }
}

