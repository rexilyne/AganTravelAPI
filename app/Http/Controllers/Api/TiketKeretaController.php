<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\TiketKereta;

class TiketKeretaController extends Controller
{
    //
    public function index() {
        $tiketKereta = TiketKereta::all();

        if(count($tiketKereta) > 0) {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $tiketKereta
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id) {
        $tiketKereta = TiketKereta::find($id);

        if(!is_null($tiketKereta)) {
            return response([
                'message' => 'Retrieve Tiket Kereta Success',
                'data' => $tiketKereta
            ], 200);
        }

        return response([
            'message' => 'Tiket Kereta Not Found',
            'data' => null
        ], 404);
    }

    public function store(Request $request) {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'noKereta' => 'required',
            'asal' => 'required',
            'tujuan' => 'required',
            'waktuBerangkat' => 'required',
            'waktuTiba' => 'required',
            'harga' => 'required|numeric'
        ]);

         if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $tiketKereta = TiketKereta::create($storeData);
        return response([
            'message' => 'Add Tiket Kereta Success',
            'data' => $tiketKereta
        ], 200);
    }

    public function destroy($id) {
        $tiketKereta = TiketKereta::find($id);

        if(is_null($tiketKereta)) {
            return response([
                'message' => 'Tiket Kereta Not Found',
                'data' => null
            ], 404);
        }

        if($tiketKereta->delete()) {
            return response([
                'message' => 'Delete Tiket Kereta Success',
                'data' => $tiketKereta
            ], 200);
        }

        return response([
            'message' => 'Delete Tiket Kereta Failed',
            'data' => null,
        ], 400);
    }

    public function update(Request $request, $id) {
        $tiketKereta = TiketKereta::find($id);

        if(is_null($tiketKereta)) {
            return response([
                'message' => 'Tiket Kereta Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'noKereta' => 'required',
            'asal' => 'required',
            'tujuan' => 'required',
            'waktuBerangkat' => 'required',
            'waktuTiba' => 'required',
            'harga' => 'required|numeric'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $tiketKereta->noKereta = $updateData['noKereta'];
        $tiketKereta->asal = $updateData['asal'];
        $tiketKereta->tujuan = $updateData['tujuan'];
        $tiketKereta->waktuBerangkat = $updateData['waktuBerangkat'];
        $tiketKereta->waktuTiba = $updateData['waktuTiba'];
        $tiketKereta->harga = $updateData['harga'];

        if($tiketKereta->save()) {
            return response([
                'message' => 'Update Tiket Kereta Success',
                'data' => $tiketKereta
            ], 200);
        }

        return response([
            'message' => 'Update Tiket Kereta Failed',
            'data' => null,
        ], 400);
    }
}
