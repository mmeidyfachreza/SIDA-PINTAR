<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        $page = 'Dashboard';
        if (auth()->guard("web")->check()) {
            $schools = School::all();
        }else{
            $schools = School::find(auth()->guard("admin")->user()->school_id);
        }
        return view('dashboard',compact('page','schools'));
    }

    public function searchStudent(Request $request)
    {
        $page = 'Dashboard';
        if (auth()->guard("web")->check()) {
            $schools = School::all();
        }else{
            $schools = School::find(auth()->guard("admin")->user()->school_id);
        }
        $student = Student::with('school')->dashboardSearch($request->all())->first();
        return view('dashboard',compact('page','schools','student','request'));
    }

    public function downloadFile($type,$name)
    {
        return response()->download(public_path()."/storage/".$type."/".$name);
    }
}
