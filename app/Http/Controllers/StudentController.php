<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\School;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
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
                $ijazah = $request->ijazah->storeAs('ijazah',$name);
                $student->save();
            }
            if ($photo = $request->file('photo')) {
                $name = $request->name.'-'.time().'.'.$photo->getClientOriginalExtension();
                $student->photo = $name;
                $photo = $request->photo->storeAs('public/photos',$name);
                $student->save();
            }
            DB::commit();
            // all good
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
                Storage::delete('ijazah/'.$student->ijazah);
                $name = $request->name.'-'.time().'.'.$ijazah->getClientOriginalExtension();
                $student->ijazah = $name;
                $request->ijazah->storeAs('ijazah',$name);
            }
            if ($photo = $request->file('photo')) {
                Storage::delete('photo/'.$student->photo);
                $name = $request->name.'-'.time().'.'.$photo->getClientOriginalExtension();
                $student->photo = $name;
                $request->photo->storeAs('public/photos',$name);
            }
            $student->nis = $request->nis;
            $student->name = $request->name;
            // $student->address = $request->address;
            $student->birth_place = $request->birth_place;
            $student->birth_date = $request->birth_date;
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
            dd("asdad");
            return redirect()->route('siswa.edit',$id)->withErrors(['message'=>$e->getMessage]);
        }

        if (auth()->guard('admin')->check()) {
            dd("ini admin");
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
        $student = Student::find($id);
        $schoolId = $student->school_id;
        Storage::delete('ijazah/'.$student->ijazah);
        Storage::delete('photos/'.$student->photo);
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
        return view('letter.statement_letter',compact('student'));
    }
}
