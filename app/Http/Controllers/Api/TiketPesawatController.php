<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\TiketPesawat;

class TiketPesawatController extends Controller
{
    //
    public function index() {
        $tiketPesawat = TiketPesawat::all();

        if(count($tiketPesawat) > 0) {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $tiketPesawat
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id) {
        $tiketPesawat = TiketPesawat::find($id);

        if(!is_null($tiketPesawat)) {
            return response([
                'message' => 'Retrieve Tiket Pesawat Success',
                'data' => $tiketPesawat
            ], 200);
        }

        return response([
            'message' => 'Tiket Pesawat Not Found',
            'data' => null
        ], 404);
    }

    public function store(Request $request) {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'noPenerbangan' => 'required',
            'asal' => 'required',
            'tujuan' => 'required',
            'waktuBerangkat' => 'required',
            'waktuTiba' => 'required',
            'harga' => 'required|numeric'
        ]);

         if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $tiketPesawat = TiketPesawat::create($storeData);
        return response([
            'message' => 'Add Tiket Pesawat Success',
            'data' => $tiketPesawat
        ], 200);
    }

    public function destroy($id) {
        $tiketPesawat = TiketPesawat::find($id);

        if(is_null($tiketPesawat)) {
            return response([
                'message' => 'Tiket Pesawat Not Found',
                'data' => null
            ], 404);
        }

        if($tiketPesawat->delete()) {
            return response([
                'message' => 'Delete Tiket Pesawat Success',
                'data' => $tiketPesawat
            ], 200);
        }

        return response([
            'message' => 'Delete Tiket Pesawat Failed',
            'data' => null,
        ], 400);
    }

    public function update(Request $request, $id) {
        $tiketPesawat = TiketPesawat::find($id);

        if(is_null($tiketPesawat)) {
            return response([
                'message' => 'Tiket Pesawat Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'noPenerbangan' => 'required',
            'asal' => 'required',
            'tujuan' => 'required',
            'waktuBerangkat' => 'required',
            'waktuTiba' => 'required',
            'harga' => 'required|numeric'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $tiketPesawat->noPenerbangan = $updateData['noPenerbangan'];
        $tiketPesawat->asal = $updateData['asal'];
        $tiketPesawat->tujuan = $updateData['tujuan'];
        $tiketPesawat->waktuBerangkat = $updateData['waktuBerangkat'];
        $tiketPesawat->waktuTiba = $updateData['waktuTiba'];
        $tiketPesawat->harga = $updateData['harga'];

        if($tiketPesawat->save()) {
            return response([
                'message' => 'Update Tiket Pesawat Success',
                'data' => $tiketPesawat
            ], 200);
        }

        return response([
            'message' => 'Update Tiket Pesawat Failed',
            'data' => null,
        ], 400);
    }
}
