<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\TiketBus;

class TiketBusController extends Controller
{
    //
    public function index() {
        $tiketBus = TiketBus::all();

        if(count($tiketBus) > 0) {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $tiketBus
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id) {
        $tiketBus = TiketBus::find($id);

        if(!is_null($tiketBus)) {
            return response([
                'message' => 'Retrieve Tiket Bus Success',
                'data' => $tiketBus
            ], 200);
        }

        return response([
            'message' => 'Tiket Bus Not Found',
            'data' => null
        ], 404);
    }

    public function store(Request $request) {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'noBus' => 'required',
            'asal' => 'required',
            'tujuan' => 'required',
            'waktuBerangkat' => 'required',
            'waktuTiba' => 'required',
            'harga' => 'required|numeric'
        ]);

         if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $tiketBus = TiketBus::create($storeData);
        return response([
            'message' => 'Add Tiket Bus Success',
            'data' => $tiketBus
        ], 200);
    }

    public function destroy($id) {
        $tiketBus = TiketBus::find($id);

        if(is_null($tiketBus)) {
            return response([
                'message' => 'Tiket Bus Not Found',
                'data' => null
            ], 404);
        }

        if($tiketBus->delete()) {
            return response([
                'message' => 'Delete Tiket Bus Success',
                'data' => $tiketBus
            ], 200);
        }

        return response([
            'message' => 'Delete Tiket Bus Failed',
            'data' => null,
        ], 400);
    }

    public function update(Request $request, $id) {
        $tiketBus = TiketBus::find($id);

        if(is_null($tiketBus)) {
            return response([
                'message' => 'Tiket Bus Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'noBus' => 'required',
            'asal' => 'required',
            'tujuan' => 'required',
            'waktuBerangkat' => 'required',
            'waktuTiba' => 'required',
            'harga' => 'required|numeric'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $tiketBus->noBus = $updateData['noBus'];
        $tiketBus->asal = $updateData['asal'];
        $tiketBus->tujuan = $updateData['tujuan'];
        $tiketBus->waktuBerangkat = $updateData['waktuBerangkat'];
        $tiketBus->waktuTiba = $updateData['waktuTiba'];
        $tiketBus->harga = $updateData['harga'];

        if($tiketBus->save()) {
            return response([
                'message' => 'Update Tiket Bus Success',
                'data' => $tiketBus
            ], 200);
        }

        return response([
            'message' => 'Update Tiket Bus Failed',
            'data' => null,
        ], 400);
    }
}
