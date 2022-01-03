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


class TrainLineController extends Controller
{

    public function index()
    {

        return view('admin.train_line')->with('lineData', TrainLine::all());
    }

    public function add_train_line(Request $request)
    {

        $name = $request->name;

        $is_station_exist = DB::table("train_lines")->where('name', $name)->count();


        if ($is_station_exist == 1) {
            return redirect('admin/train_line')->with('error', trans(" This Train Line is already exist!"));
        }

        TrainLine::create([
            'name' => $name
        ]);

        return redirect('admin/train_line')->with('success', trans("New Train Line Added successfully!"));
    }

    public function view_train_line($id)
    {

        $lineData = TrainLine::select('id', 'name')
            ->where('id', '=', $id)
            ->first();

        return view('admin.view.view_train_line', compact('lineData'));
    }

    public function edit_train_line(Request $request)
    {

        $id=$request->id;
        $name = $request->name;

        $is_station_exist = DB::table("train_lines")->where('name', $name)->count();

        if ($is_station_exist == 1) {
            
            return back()->with('message', trans(" Are you sure? This Train Line is already exist!"));

        } else {

            $affectedRow = TrainLine::where('id', $id)
                ->update(['name' => $name]);

            if ($affectedRow == 1) {
                return redirect('admin/train_line')->with('success', trans("Train Line Updated successfully!"));
            }
        }


        //return redirect('admin/train_line')->with('success', trans("Train Line Updated successfully!"));

        //return response()->json(['message'=>'Edit Line Data Posted']);

    }

    public function delete_train_line($id)
    {

        
        //DB::table("train_lines")->where('name', $name)->delete();

        $affectedRow = TrainLine::where('id', $id)->delete();

        if ($affectedRow == 1) {
            return redirect('admin/train_line')->with('success', trans("Train Line Deleted successfully!"));
        }

        //return response()->json(['message' => 'Delete Line Data Posted']);
    }
}
