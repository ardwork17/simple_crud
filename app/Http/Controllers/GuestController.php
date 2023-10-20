<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GuestController extends Controller
{
    //show data
    public function index()
    {
        $guest = Guest::latest()->get();

        return view('guest', compact('guest'));
    }

     public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'              => 'required',
            'no_ktp'              => 'required',
            'telepon'           => 'required',
            'email'             => 'required',
            'alamat'            => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

          $guest = Guest::create([
        'nama'           => $request->nama,
        'no_ktp'           => $request->no_ktp,
        'telepon'        => $request->telepon,
        'email'          => $request->email,
        'alamat'         => $request->alamat,
    ]);

        return response()->json([
            'success'   => true,
            'message'   => 'Data berhasil di tambah',
            'data'      => $guest
        ]);
    }

     public function show(Guest $guest)
    {
        
       return response()->json([
            'success'   => true,
            'message'   => 'detail Data guest',
            'data'      => $guest
        ]);
    }

     public function update(Request $request, Guest $guest)
    {
         $validator = Validator::make($request->all(), [
            'nama'              => 'required',
            'no_ktp'              => 'required',
            'telepon'           => 'required',
            'email'             => 'required',
            'alamat'            => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $guest->update([
        'nama'           => $request->nama,
        'no_ktp'           => $request->no_ktp,
        'telepon'        => $request->telepon,
        'email'          => $request->email,
        'alamat'         => $request->alamat,
    ]);

            return response()->json([
            'success'   => true,
            'message'   => 'Update Data guest Berhasil',
            'data'      => $guest
        ]);
    }

      public function destroy($id)
    {
        Guest::where('id', $id)->delete();

        return response()->json([
            'success'   => true,
            'message'   => 'Delete Data guest Berhasil',
        ]);
    }

}
