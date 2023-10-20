<?php

namespace App\Http\Controllers\Api;

use App\Models\Guest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\GuestResource;
use Illuminate\Support\Facades\Validator;

class GuestController extends Controller
{
    //shoew data
    public function index()
    {
        $guests = Guest::latest()->paginate(5);

        return new GuestResource(true, 'data tamu ditampilkan', $guests);
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

            return new GuestResource(true, 'data berhasil di tambah', $guest);
    }

    public function show(Guest $guest)
    {
        
        return new GuestResource(true, 'Data ditemukan', $guest);
    }

    public function update(Request $request, Guest $guest)
    {
         $validator = Validator::make($request->all(), [
            'nama'              => 'required',
            'telepon'           => 'required',
            'email'             => 'required',
            'alamat'            => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $guest->update([
        'nama'           => $request->nama,
        'telepon'        => $request->telepon,
        'email'          => $request->email,
        'alamat'         => $request->alamat,
    ]);

            return new GuestResource(true, 'data berhasil di ubah', $guest);
    }
    
    public function destroy(Guest $guest)
    {
        $guest->delete();

        return new GuestResource(true, 'Data berhasil di hapus', null);
    }


}
