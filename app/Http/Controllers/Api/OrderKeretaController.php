<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\OrderKereta;

class OrderKeretaController extends Controller
{
    //
    public function index() {
        $orderKereta = OrderKereta::all();

        if(count($orderKereta) > 0) {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $orderKereta
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id) {
        $orderKereta = OrderKereta::find($id);

        if(!is_null($orderKereta)) {
            return response([
                'message' => 'Retrieve Order Kereta Success',
                'data' => $orderKereta
            ], 200);
        }

        return response([
            'message' => 'Order Kereta Not Found',
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
            'harga' => 'required|numeric',
            'idUser' => 'required|numeric',
            'jumlahPenumpang' => 'required|numeric',
            'totalHarga' => 'required|numeric'
        ]);

         if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $orderKereta = OrderKereta::create($storeData);
        return response([
            'message' => 'Add Order Kereta Success',
            'data' => $orderKereta
        ], 200);
    }

    public function destroy($id) {
        $orderKereta = OrderKereta::find($id);

        if(is_null($orderKereta)) {
            return response([
                'message' => 'Order Kereta Not Found',
                'data' => null
            ], 404);
        }

        if($orderKereta->delete()) {
            return response([
                'message' => 'Delete Order Kereta Success',
                'data' => $orderKereta
            ], 200);
        }

        return response([
            'message' => 'Delete Order Kereta Failed',
            'data' => null,
        ], 400);
    }

    public function update(Request $request, $id) {
        $orderKereta = OrderKereta::find($id);

        if(is_null($orderKereta)) {
            return response([
                'message' => 'Order Kereta Not Found',
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
            'harga' => 'required|numeric',
            'idUser' => 'required|numeric',
            'jumlahPenumpang' => 'required|numeric',
            'totalHarga' => 'required|numeric'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $orderKereta->noKereta = $updateData['noKereta'];
        $orderKereta->asal = $updateData['asal'];
        $orderKereta->tujuan = $updateData['tujuan'];
        $orderKereta->waktuBerangkat = $updateData['waktuBerangkat'];
        $orderKereta->waktuTiba = $updateData['waktuTiba'];
        $orderKereta->harga = $updateData['harga'];
        $orderKereta->idUser = $updateData['idUser'];
        $orderKereta->jumlahPenumpang = $updateData['jumlahPenumpang'];
        $orderKereta->totalHarga = $updateData['totalHarga'];

        if($orderKereta->save()) {
            return response([
                'message' => 'Update Order Kereta Success',
                'data' => $orderKereta
            ], 200);
        }

        return response([
            'message' => 'Update Order Kereta Failed',
            'data' => null,
        ], 400);
    }
}
