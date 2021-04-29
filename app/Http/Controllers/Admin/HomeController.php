<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        $page = 'Dashboard';
        $levels = array('sd','smp');
        $data = Student::get()->groupBy('school')->toArray();
        foreach ($data as $key => $value) {
            $schools[] = $key;
        }
        return view('dashboard',compact('page','levels','schools'));
    }

    public function searchStudent(Request $request)
    {
        $page = 'Dashboard';
        $levels = array('sd','smp');
        $data = Student::get()->groupBy('school')->toArray();
        foreach ($data as $key => $value) {
            $schools[] = $key;
        }
        $student = Student::dashboardSearch($request->all())->first();
        return view('dashboard',compact('page','levels','schools','student'));
    }

    public function downloadFile($type,$name)
    {
        return response()->download(public_path()."/storage/".$type."/".$name);
    }
}
