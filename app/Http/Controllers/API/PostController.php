<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getData = Post::with("categories")->orderBy("created_at", "DESC")->paginate();
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
        Post::create([
            "nama" => $request->nama,
            "kelas" => $request->kelas,
            "alamat" => $request->alamat,
            "jurusan_id" => $request->jurusan_id
        ]);

        return response()->json([
            "status" => true,
            "results" => "nama '$request->nama', berhasil ditambahkan"
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
        $getID = Post::find($id);

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
            $getData = Post::findOrFail($id);
            $getData->update([
                "nama" => $request->nama,
                "kelas" => $request->kelas,
                "alamat" => $request->alamat,
                "jurusan_id" => $request->jurusan_id
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
        $deletData = Post::find($id);
        $deletData->delete();

        return response()->json([
            "status" => true,
            "message" => "data berhasil dihapus",
            "results" => $deletData
        ]);
    }
}
