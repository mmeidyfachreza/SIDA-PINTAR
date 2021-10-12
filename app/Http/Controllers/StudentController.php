<?php

namespace App\Http\Controllers;

use App\Exports\StudentImportFormat;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Imports\StudentsImport;
use App\Imports\StudentsUpdateImport;
use App\Models\School;
use App\Models\Student;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;

class StudentController extends Controller
{

    //im using google drive storage path
    protected $ijazah_path = "/1RG5UcF7L80kfZ0Re13Sl9iDue9z1CClb";
    protected $photo_path = "/1Tgc1MrjUAh5rqGoqGSdhACfWhkJWno7l";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = "Siswa";
        $students = Student::with('school')->where('school_id',auth()->guard('web')->user()->school_id)->paginate();

        return view('admin.student.index',compact('students','page'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSd()
    {
        $page = "Siswa SD";
        $students = Student::with('school')->whereHas('school',function($q){$q->where("level","sd");})->paginate();

        return view('admin.student.index',compact('students','page'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSmp()
    {
        $page = "Siswa SMP";
        $students = Student::with('school')->whereHas('school',function($q){$q->where("level","smp");})->paginate();

        return view('admin.student.index',compact('students','page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = "Siswa";
        $genders = array('L','P');
        $levels = array('sd','smp');
        $religions = array('Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu');
        if (auth()->guard("admin")->check()) {
            $schools = School::all();
        }else{
            $schools = School::find(auth()->guard("web")->user()->school_id);
        }

        return view('admin.student.create',compact('page','genders','religions','levels','schools'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        DB::beginTransaction();
        try {
            $student = Student::create($request->all());
            if ($ijazah = $request->file('ijazah')) {
                $name = $request->name.'-'.time().'.'.$ijazah->getClientOriginalExtension();
                $student->ijazah = $name;
                Storage::put($this->ijazah_path."/".$name,FILE::get($request->file('ijazah')));
                $student->save();
            }
            if ($photo = $request->file('photo')) {
                $name = $request->name.'-'.time().'.'.$photo->getClientOriginalExtension();
                $student->photo = $name;
                Storage::put($this->photo_path."/".$name,FILE::get($request->file('photo')));
                $student->save();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('siswa.create')->withErrors(['message'=>$e->getMessage()]);
        }

        if (auth()->guard('admin')->check()) {
            if (School::where("id",$request->school_id)->where("level","sd")) {
                return redirect()->route('student.sd')->with('success','Berhasil menambah data');
            }elseif(School::where("id",$request->school_id)->where("level","smp")){
                return redirect()->route('student.smp')->with('success','Berhasil menambah data');
            }
        }

        return redirect()->route('siswa.index')->with('success','Berhasil menambah data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = "Detail Siswa";
        $student = Student::find($id);
        return view('admin.student.show',compact('student','page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = "Siswa";
        $genders = array('L','P');
        $levels = array('sd','smp');
        $religions = array('Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu');
        if (auth()->guard("admin")->check()) {
            $schools = School::all();
        }else{
            $schools = School::find(auth()->guard("web")->user()->school_id);
        }
        $student = Student::find($id);
        return view('admin.student.edit',compact('student','page','genders','levels','religions','schools'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, $id)
    {
        $page = "Siswa";
        DB::beginTransaction();
        try {
            $student = Student::findOrFail($id);
            if ($ijazah = $request->file('ijazah')) {
                $oldIjazah = $this->getFilePath($student->ijazah,$this->ijazah_path);
                Storage::delete($oldIjazah['path']);
                $name = $request->name.'-'.time().'.'.$ijazah->getClientOriginalExtension();
                $student->ijazah = $name;
                Storage::put($this->ijazah_path."/".$name,FILE::get($request->file('ijazah')));
            }
            if ($photo = $request->file('photo')) {
                $oldPhoto = $this->getFilePath($student->photo,$this->photo_path);
                Storage::delete($oldPhoto['path']);
                $name = $request->name.'-'.time().'.'.$photo->getClientOriginalExtension();
                $student->photo = $name;
                Storage::put($this->photo_path."/".$name,FILE::get($request->file('photo')));
            }
            $student->nisn = $request->nisn;
            $student->name = $request->name;
            // $student->address = $request->address;
            $student->birth_place = $request->birth_place;
            $student->birth_date = \Carbon\Carbon::createFromFormat('d/m/Y', $request->birth_date)->format('d-m-Y');
            $student->religion = $request->religion;
            $student->gender = $request->gender;
            $student->father_name = $request->father_name;
            // $student->father_phone = $request->father_phone;
            // $student->mother_name = $request->mother_name;
            // $student->mother_phone = $request->mother_phone;
            $student->guardian_name = $request->guardian_name;
            // $student->guardian_phone = $request->guardian_phone;
            // $student->entry_year = $request->entry_year;
            $student->graduated_year = $request->graduated_year;
            $student->ijazah_number = $request->ijazah_number;

            $student->update();
            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('siswa.edit',$id)->withErrors(['message'=>$e->getMessage()]);
        }

        if (auth()->guard('admin')->check()) {
            if (School::where("id",$request->school_id)->where("level","sd")) {
                return redirect()->route('student.sd')->with('success','Berhasil merubah data');
            }elseif(School::where("id",$request->school_id)->where("level","smp")){
                return redirect()->route('student.smp')->with('success','Berhasil merubah data');
            }
        }

        return redirect()->route('siswa.index')->with('success','Berhasil merubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $schoolId = $student->school_id;

        $ijazah = $this->getFilePath($student->ijazah,$this->ijazah_path);
        $photo = $this->getFilePath($student->photo,$this->photo_path);

        Storage::delete($ijazah['path']);
        Storage::delete($photo['path']);
        $student->delete();
        if (auth()->guard('admin')->check()) {
            if (School::where("id",$schoolId)->where("level","sd")) {
                return redirect()->route('student.sd')->with('success','Berhasil menghapus data');
            }elseif(School::where("id",$schoolId)->where("level","smp")){
                return redirect()->route('student.smp')->with('success','Berhasil menghapus data');
            }
        }
        return redirect()->route('siswa.index')->with('success','Berhasil menghapus data');
    }

    public function statementLetter($id)
    {
        $student = Student::with('school')->find($id);
        // return view('letter.statement_letter',compact('student'));
        $pdf = PDF::loadView('letter.statement_letter', compact('student'));
        return $pdf->download('invoice.pdf');
    }

    public function studentImport(Request $request)
    {

        if (auth()->guard('admin')->check()) {
            Excel::import(new StudentsImport(), $request->file('studentImport'));
        } else {
            Excel::import(new StudentsImport(auth()->guard('web')->user()->school_id), $request->file('studentImport'));
        }

        if ($request->page=="Siswa SD") {
            return redirect()->route('student.sd')->with('success','Berhasil import data');
        }elseif($request->page=="Siswa SMP"){
            return redirect()->route('student.smp')->with('success','Berhasil import data');
        }else{
            return redirect()->route('siswa.index')->with('success','Berhasil import data');
        }
    }

    public function studentUpdateImport(Request $request)
    {
        if (auth()->guard('admin')->check()) {
            Excel::import(new StudentsUpdateImport(), $request->file('studentUpdateImport'));
        } else {
            Excel::import(new StudentsUpdateImport(auth()->guard('web')->user()->school_id), $request->file('studentUpdateImport'));
        }

        if ($request->page=="Siswa SD") {
            return redirect()->route('student.sd')->with('success','Berhasil import data');
        }elseif($request->page=="Siswa SMP"){
            return redirect()->route('student.smp')->with('success','Berhasil import data');
        }else{
            return redirect()->route('siswa.index')->with('success','Berhasil import data');
        }
    }

    public function studentExportFormat()
    {
        if (auth()->guard('admin')->check()) {
            return Excel::download(new StudentImportFormat(), 'Format Import Data Siswa.xlsx');
        }else{
            return Excel::download(new StudentImportFormat(auth()->guard('web')->user()->school_id), 'Format Import Data Siswa '.auth()->guard('web')->user()->school->name.'.xlsx');
        }

    }

    public function searchStudent(Request $request)
    {
        if (auth()->guard("admin")->check()) {
            $page = 'Siswa '.strtoupper($request->level);
            $students = Student::with('school')->filterBy($request->all())->whereHas("school",function($q) use ($request){$q->where("level",$request->level);})->paginate();
        }else{
            $page = 'Siswa';
            $school = School::find(auth()->guard("web")->user()->school_id);
            $students = Student::with('school')->search($request->value,$school->id)->paginate();
        }
        return view('admin.student.index',compact('page','students','request'));
    }

    public function ijazahDownload($id)
    {
        $filename = Student::findOrFail($id)->ijazah;

        $file = $this->getFilePath($filename,$this->ijazah_path);

        $rawData = Storage::get($file['path']);

        return response($rawData, 200)
            ->header('ContentType', $file['mimetype'])
            ->header('Content-Disposition', "attachment; filename=$filename");
    }

    public function getFilePath($filename,$dir)
    {
        $recursive = false; // Get subdirectories also?
        $contents = collect(Storage::listContents($dir, $recursive));

        $file = $contents
            ->where('type', '=', 'file')
            ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
            ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
            ->first(); // there can be duplicate file names!

        return $file;
    }
}
