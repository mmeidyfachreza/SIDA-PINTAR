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
            $schoolsName = School::all();
            return view('dashboard',compact('page','schools','sdCount','smpCount','schoolsName'));
        }else{
            $schoolsName = School::find(auth()->guard("web")->user()->school_id);
            $studentCount = Student::whereHas('school',function($q){$q->where("id",auth()->guard('web')->user()->school_id);})->count();
            return view('dashboard',compact('page','studentCount','schoolsName'));
        }

    }

    public function searchStudent(Request $request)
    {
        $page = 'Dashboard';
        if (auth()->guard("admin")->check()) {
            $schools = School::withCount(['students','students as without_ijazah'=>function($q){$q->whereNull('ijazah');}])->paginate(5);
            $sdCount = Student::whereHas('school',function($q){$q->where("level","sd");})->count();
            $smpCount = Student::whereHas('school',function($q){$q->where("level","smp");})->count();
            $schoolsName = School::all();
            $student = Student::with('school')->dashboardSearch($request->all())->first();
            return view('dashboard',compact('page','schools','sdCount','smpCount','schoolsName','student'));
        }else{
            $studentCount = Student::whereHas('school',function($q){$q->where("id",auth()->guard('web')->user()->school_id);})->count();
            $schoolsName = School::find(auth()->guard("web")->user()->school_id);
            $student = Student::with('school')->dashboardSearch($request->all())->first();
            return view('dashboard',compact('page','studentCount','schoolsName','student'));
        }
    }

    public function downloadFile($type,$name)
    {
        return Storage::download("ijazah/".$name);
        // return response()->download(public_path()."/storage/".$type."/".$name);
    }

    public function downloadLetter($id)
    {
        switch ($id) {
            case 1:
                return Storage::download("letters/Format_1A.docx","Format 1A Surat Keterangan Pengganti Ijazah atau STTB (sekolah masih operasional).docx");
                break;
            case 2:
                return Storage::download("letters/Format_1C.docx","Format 1C Surat Keterangan Kesalahan Penulisan Ijazah atau STTB (sekolah masih operasional).docx");
                break;
            case 3:
                return Storage::download("letters/Format_5.docx","Format 5: Surat Pernyataan Tanggungjawab Mutlak.docx");
                break;

            default:
                return abort(404);
                break;
        }
    }
}
