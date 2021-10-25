<?php

namespace App\Http\Controllers;

use App\Models\IncomingLetter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class IncomingLetterController extends Controller
{

    protected $inLetterPath = "/13-4AAee2CYUt2bX7ML2L7nnkFPFJy6pE";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inLetters = IncomingLetter::paginate();
        return view('admin.incoming_letter.index',compact('inLetters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.incoming_letter.create');
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
            $inLetter = IncomingLetter::create($request->all());
            if ($letter = $request->file('file')) {
                $name = rand().'-'.time().'.'.$letter->getClientOriginalExtension();
                $inLetter->file = $name;
                Storage::put($this->inLetterPath."/".$name,FILE::get($request->file('file')));
                $inLetter->save();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('surat-masuk.create')->withErrors(['message'=>$e->getMessage()]);
        }

        return redirect()->route('surat-masuk.index')->with('success','Berhasil menambah data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IncomingLetter  $incomingLetter
     * @return \Illuminate\Http\Response
     */
    public function show(IncomingLetter $incomingLetter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IncomingLetter  $incomingLetter
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inLetter = IncomingLetter::findOrFail($id);
        return view('admin.incoming_letter.edit',compact('inLetter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IncomingLetter  $incomingLetter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $inLetter = IncomingLetter::findOrFail($id);
        DB::beginTransaction();
        try {
            if ($letter = $request->file('file')) {
                $oldInLetter = $this->getFilePath($inLetter->file,$this->inLetterPath);
                Storage::delete($oldInLetter['path']);
                $name = rand().'-'.time().'.'.$letter->getClientOriginalExtension();
                $inLetter->file = $name;
                Storage::put($this->inLetterPath."/".$name,FILE::get($request->file('file')));
            }
            $inLetter->ref_number = $request->ref_number;
            $inLetter->date = $request->date;
            $inLetter->purpose = $request->purpose;
            $inLetter->content = $request->content;
            $inLetter->description = $request->description;
            $inLetter->update();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('surat-masuk.edit',$inLetter->id)->withErrors(['message'=>$e->getMessage()]);
        }

        return redirect()->route('surat-masuk.index')->with('success','Berhasil menambah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IncomingLetter  $incomingLetter
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inLetter = IncomingLetter::findOrFail($id);

        $letter = $this->getFilePath($inLetter->file,$this->inLetterPath);

        Storage::delete($letter['path']);
        $inLetter->delete();

        return redirect()->route('surat-masuk.index')->with('success','Berhasil menghapus data');
    }

    public function letterDownload($id)
    {
        $filename = IncomingLetter::findOrFail($id)->file;

        $file = $this->getFilePath($filename,$this->inLetterPath);

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
