<?php

namespace App\Http\Controllers;

// panggil model
use App\Models\Skripsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class SkripsiController extends Controller
{
    public function index()
    {
        $skripsi = Skripsi::all();
        return response()->json($skripsi);
    }

    public function show($id)
    {
        $skripsi = Skripsi::find($id);
        return response()->json($skripsi);
    }

    public function create(Request $request)
    {

        $this->validate($request, [
            'nama' => 'required|string',
            'nim' => 'required|string',
            'fakultas' => 'required|string',
            'jurusan' => 'required|string',
            'judul_skripsi' => 'required|string',
            'kontak' => 'required|string'
        ]);

        $data = $request->all();
        $skripsi = Skripsi::create($data);
        
        return response()->json($skripsi);
    }

    public function update(Request $request, $id)
    {
        // panggil model untuk mencari id
        $skripsi = Skripsi::find($id);

        // dapat id, kemudian ambil semua data
        $data = $request->all();

        // kemudian isi data
        $skripsi->fill($data);

        // save data
        $skripsi->save();

        return response()->json($skripsi);
    }

    public function delete($id)
    {
        $skripsi = Skripsi::find($id);

        if(!$skripsi)
        {
            return response()->json(['message' => 'Skripsi not found!'], 404);
        }

        $skripsi->delete();
        return response()->json(['message' => 'Data telah dihapus']);
    }

}
