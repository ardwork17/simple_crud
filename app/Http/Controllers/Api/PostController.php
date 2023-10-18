<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //show data
    public function index()
    {
        $posts = Post::latest()->paginate(5);

        return new PostResource(true, "List Data Post", $posts);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'              => 'required',
            'email'             => 'required',
            'telepon'           => 'required',
            'jenis_kelamin'     => 'required',
            'status'            => 'required',
            'provinsi'          => 'required',
            'kota'              => 'required',
            'kecamatan'         => 'required',
            'kelurahan'         => 'required',
            'alamat'            => 'required',
        ]);

         //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        $post = Post::create([
            'nama'              => $request->nama,
            'email'             => $request->email,
            'telepon'           => $request->telepon,
            'jenis_kelamin'     => $request->jenis_kelamin,
            'status'            => $request->status,
            'provinsi'          => $request->provinsi,
            'kota'              => $request->kota,
            'kecamatan'         => $request->kecamatan,
            'kelurahan'         => $request->kelurahan,
            'alamat'            => $request->alamat,
        ]);

        return new PostResource(true, 'Data berhasil di Tambahkan', $post);
    }

    public function show(Post $post)
    {
        return new PostResource(true, 'Data Post Ditemukan', $post);
    }
    

    public function update(Request $request, Post $post)
    {
         $validator = Validator::make($request->all(), [
            'nama'              => 'required',
            'email'             => 'required',
            'telepon'           => 'required',
            'jenis_kelamin'     => 'required',
            'status'            => 'required',
            'provinsi'          => 'required',
            'kota'              => 'required',
            'kecamatan'         => 'required',
            'kelurahan'         => 'required',
            'alamat'            => 'required',
        ]);

          //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

          $post->update([
            'nama'              => $request->nama,
            'email'             => $request->email,
            'telepon'           => $request->telepon,
            'jenis_kelamin'     => $request->jenis_kelamin,
            'status'            => $request->status,
            'provinsi'          => $request->provinsi,
            'kota'              => $request->kota,
            'kecamatan'         => $request->kecamatan,
            'kelurahan'         => $request->kelurahan,
            'alamat'            => $request->alamat,
        ]);

        return new PostResource(true, 'Data berhasil di ubah', $post);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return new PostResource(true, 'Data berhasil di Hapus', null);
    }
}
