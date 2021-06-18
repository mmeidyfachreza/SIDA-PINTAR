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

        if (auth()->guard("admin")->check()) {
            $schools = School::withCount(['students','students as without_ijazah'=>function($q){$q->whereNull('ijazah');}])->paginate(5);
            $sdCount = Student::whereHas('school',function($q){$q->where("level","sd");})->count();
            $smpCount = Student::whereHas('school',function($q){$q->where("level","smp");})->count();

            return view('dashboard',compact('page','schools','sdCount','smpCount'));
        }else{
            $schools = School::find(auth()->guard("web")->user()->school_id);
            $studentCount = Student::whereHas('school',function($q){$q->where("id",auth()->guard('web')->user()->school_id);})->count();
            return view('dashboard',compact('page','schools','studentCount'));
        }

    }

    public function searchStudent(Request $request)
    {
        $page = 'Dashboard';
        if (auth()->guard("admin")->check()) {
            $schools = School::all();
        }else{
            $schools = School::find(auth()->guard("web")->user()->school_id);
        }
        $student = Student::with('school')->dashboardSearch($request->all())->first();
        return view('dashboard',compact('page','schools','student','request'));
    }

    public function downloadFile($type,$name)
    {
        return Storage::download("ijazah/".$name);
        // return response()->download(public_path()."/storage/".$type."/".$name);
    }
}
