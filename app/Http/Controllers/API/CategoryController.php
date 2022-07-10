<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getData = Category::orderBy("created_at", "DESC")->paginate(10);
        return response()->json([
            "status" => true,
            "results" => $getData
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Category::create([
            "jurusan" => $request->jurusan,
            "nim" => $request->nim,
        ]);

        return response()->json([
            "status" => true,
            "results" => "nama '$request->jurusan', berhasil ditambahkan"
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $getID = Category::find($id);

        return response()->json([
            "status" => true,
            "results" => $getID
        ]);
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
        try {
            $getData = Category::findOrFail($id);
            $getData->update([
                "jurusan" => $request->jurusan,
                "nim" => $request->nim,
            ]);

        return response()->json([
            "status" => true,
            "message" => "data berhasil diupdate",
            "results" => $getData
        ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletData = Category::find($id);
        $deletData->delete();

        return response()->json([
            "status" => true,
            "message" => "data berhasil dihapus",
            "results" => $deletData
        ]);
    }
}