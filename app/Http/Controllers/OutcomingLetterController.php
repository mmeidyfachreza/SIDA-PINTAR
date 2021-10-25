<?php

namespace App\Http\Controllers;

use App\Models\OutcomingLetter;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PDF;

class OutcomingLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outLetters = OutcomingLetter::paginate();
        return view('admin.outcoming_letter.index',compact('outLetters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.outcoming_letter.create');
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
            OutcomingLetter::create($request->all());

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('surat-keluar.create')->withErrors(['message'=>$e->getMessage()]);
        }

        return redirect()->route('surat-keluar.index')->with('success','Berhasil menambah data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OutcomingLetter  $outcomingLetter
     * @return \Illuminate\Http\Response
     */
    public function show(OutcomingLetter $outcomingLetter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OutcomingLetter  $outcomingLetter
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $outLetter = OutcomingLetter::findOrFail($id);
        return view('admin.outcoming_letter.edit',compact('outLetter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OutcomingLetter  $outcomingLetter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $outLetter = OutcomingLetter::findOrFail($id);
        DB::beginTransaction();
        try {
            $outLetter->update($request->all());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('surat-keluar.edit',$outLetter->id)->withErrors(['message'=>$e->getMessage()]);
        }

        return redirect()->route('surat-keluar.index')->with('success','Berhasil menambah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OutcomingLetter  $outcomingLetter
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $outLetter = OutcomingLetter::findOrFail($id);
        $outLetter->delete();

        return redirect()->route('surat-keluar.index')->with('success','Berhasil menghapus data');
    }

    public function print(Request $request)
    {
        $outcomingLetter = OutcomingLetter::findOrFail($request->id);
        $date = Carbon::createFromFormat('d/m/Y', $outcomingLetter->date)->translatedFormat('d F Y');

        return view('letter.letter_format_dev',compact('outcomingLetter','date'));
    }

}
