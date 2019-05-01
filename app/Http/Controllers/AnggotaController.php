<?php

namespace App\Http\Controllers;

use App\Anggota;
use App\Pangkat;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = "Anggota";
        $tableData = Anggota::join('tb_pangkat','tb_anggota.pangkat_id','tb_pangkat.id')->orderBy('tb_anggota.id', 'asc')->get();
        $dataPangkat = Pangkat::get();

        return view('anggota', compact('title','tableData','dataPangkat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules =
        [
            'nama'     => 'required|string|unique:tb_anggota',
            'pangkat_id'     => 'required|numeric'
        ];

        $validatedData = $request->validate($rules);

        try {

            $data = app(Anggota::class)->create($validatedData);
            return redirect()->back();

        } catch (\Exception $exception) {
            return $exception;
            logger()->error($exception);
            return redirect()->back()->with('error', 'pesan error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = Anggota::where('id',$id)->first();

        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function edit(Anggota $anggota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        
        $rulesUpdate =
        [
            'nama'     => 'required|string',
            'pangkat_id' => 'required|numeric'
        ];

        $reqvalid = $request->validate($rulesUpdate);
        
        $data = Anggota::find($id);
        $data->nama = $reqvalid['nama'];
        $data->pangkat_id = $reqvalid['pangkat_id'];
        $data->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Anggota::where('id', '=', $id)->delete();
        return redirect()->back();
    }
}
