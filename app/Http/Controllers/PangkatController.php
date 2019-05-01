<?php

namespace App\Http\Controllers;

use App\Pangkat;
use Illuminate\Http\Request;

class PangkatController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = "Pangkat";
        $tableData = Pangkat::get();

        return view('pangkat', compact('title','tableData'));
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
            'pangkat'     => 'required|string|unique:tb_pangkat'
        ];

        $validatedData = $request->validate($rules);

        try {

            $data = app(Pangkat::class)->create($validatedData);
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
     * @param  \App\Pangkat  $pangkat
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = Pangkat::where('id',$id)->first();

        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pangkat  $pangkat
     * @return \Illuminate\Http\Response
     */
    public function edit(Pangkat $pangkat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pangkat  $pangkat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        
        $rulesUpdate =
        [
            'pangkat'     => 'required|string'
        ];

        $reqvalid = $request->validate($rulesUpdate);
        
        $data = Pangkat::find($id);
        $data->pangkat = $reqvalid['pangkat'];
        $data->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pangkat  $pangkat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Pangkat::where('id', '=', $id)->delete();
        return redirect()->back();
    }
}
