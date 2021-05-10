<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = "Akun Sekolah";
        $users = User::with('school')->paginate();

        return view('admin.user.index',compact('users','page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = "Akun Sekolah";
        if (auth()->guard("admin")->check()) {
            $schools = School::all();
        }else{
            $schools = School::find(auth()->guard("web")->user()->school_id);
        }

        return view('admin.user.create',compact('page','schools'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = User::create($request->all());
            if ($photo = $request->file('photo')) {
                $name = $request->name.'-'.time().'.'.$photo->getClientOriginalExtension();
                $user->photo = $name;
                $photo = $request->photo->storeAs('public/photos/users',$name);
            }
            $user->save();
            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('akun-sekolah.create')->withErrors(['message'=>$e->getMessage()]);
        }

        return redirect()->route('akun-sekolah.index')->with('success','Berhasil menambah data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = "Detail Akun Sekolah";
        $user = User::find($id);
        return view('admin.user.show',compact('user','page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = "Siswa";
        if (auth()->guard("admin")->check()) {
            $schools = School::all();
        }else{
            $schools = School::find(auth()->guard("web")->user()->school_id);
        }
        $user = User::find($id);
        return view('admin.user.edit',compact('user','page','schools'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $page = "Siswa";
        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            if ($photo = $request->file('photo')) {
                Storage::delete('photo/'.$user->photo);
                $name = $request->name.'-'.time().'.'.$photo->getClientOriginalExtension();
                $user->photo = $name;
                $request->photo->storeAs('public/photos',$name);
            }
            $user->npsn = $request->npsn;
            $user->name = $request->name;
            $user->phone_number = $request->phone_number;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }

            $user->update();
            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('akun-sekolah.edit',$id)->withErrors(['message'=>$e->getMessage]);
        }

        return redirect()->route('akun-sekolah.index')->with('success','Berhasil merubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        Storage::delete('photos/user/'.$user->photo);
        $user->delete();
        return redirect()->route('akun-sekolah.index')->with('success','Berhasil menghapus data');
    }
}
