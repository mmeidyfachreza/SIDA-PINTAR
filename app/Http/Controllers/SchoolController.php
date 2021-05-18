<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSchoolRequest;
use App\Http\Requests\UpdateSchoolRequest;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = "Sekolah";
        $schools = School::paginate(15);

        return view('admin.school.index',compact('schools','page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = "Sekolah";
        $levels = array('sd','smp');

        return view('admin.school.create',compact('page','levels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSchoolRequest $request)
    {
        DB::beginTransaction();
        try {
            $school = School::create($request->all());
            // if ($letterhead = $request->file('letterhead')) {
            //     $name = $request->name.'-'.time().'.'.$letterhead->getClientOriginalExtension();
            //     $school->letterhead = $name;
            //     $letterhead = $request->letterhead->storeAs('public/letterheads',$name);
            //     $school->save();
            // }
            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('sekolah.create')->withErrors(['message'=>$e->getMessage()]);
        }

        return redirect()->route('sekolah.index')->with('success','Berhasil menambah data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = "Detail Siswa";
        $school = School::find($id);
        return view('admin.School.show',compact('School','page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = "Sekolah";
        $school = School::find($id);
        $levels = array('sd','smp');
        return view('admin.school.edit',compact('school','page','levels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSchoolRequest $request, $id)
    {
        $page = "Sekolah";
        DB::beginTransaction();
        try {
            $school = School::findOrFail($id);
            if ($letterhead = $request->file('letterhead')) {
                Storage::delete('letterhead/'.$school->letterhead);
                $name = $request->name.'-'.time().'.'.$letterhead->getClientOriginalExtension();
                $school->letterhead = $name;
                $request->letterhead->storeAs('public/letterheads',$name);
            }
            $school->nip = $request->nip;
            $school->name = $request->name;
            $school->headmaster = $request->headmaster;
            $school->level = $request->level;

            $school->update();
            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('sekolah.edit',$id)->withErrors(['message'=>$e->getMessage]);
        }

        return redirect()->route('sekolah.index')->with('success','Berhasil merubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $school = School::find($id);
        // $schoolId = $school->school_id;
        // Storage::delete('letterhead/'.$school->letterhead);
        $school->delete();

        return redirect()->route('sekolah.index')->with('success','Berhasil menghapus data');
    }

}
