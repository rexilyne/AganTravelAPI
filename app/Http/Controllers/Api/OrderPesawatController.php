<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\OrderPesawat;

class OrderPesawatController extends Controller
{
    //
    public function index() {
        $orderPesawat = OrderPesawat::all();

        if(count($orderPesawat) > 0) {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $orderPesawat
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id) {
        $orderPesawat = OrderPesawat::find($id);

        if(!is_null($orderPesawat)) {
            return response([
                'message' => 'Retrieve Order Pesawat Success',
                'data' => $orderPesawat
            ], 200);
        }

        return response([
            'message' => 'Order Pesawat Not Found',
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
            'harga' => 'required|numeric',
            'idUser' => 'required|numeric',
            'jumlahPenumpang' => 'required|numeric',
            'totalHarga' => 'required|numeric'
        ]);

         if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $orderPesawat = OrderPesawat::create($storeData);
        return response([
            'message' => 'Add Order Pesawat Success',
            'data' => $orderPesawat
        ], 200);
    }

    public function destroy($id) {
        $orderPesawat = OrderPesawat::find($id);

        if(is_null($orderPesawat)) {
            return response([
                'message' => 'Order Pesawat Not Found',
                'data' => null
            ], 404);
        }

        if($orderPesawat->delete()) {
            return response([
                'message' => 'Delete Order Pesawat Success',
                'data' => $orderPesawat
            ], 200);
        }

        return response([
            'message' => 'Delete Order Pesawat Failed',
            'data' => null,
        ], 400);
    }

    public function update(Request $request, $id) {
        $orderPesawat = OrderPesawat::find($id);

        if(is_null($orderPesawat)) {
            return response([
                'message' => 'Order Pesawat Not Found',
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
            'harga' => 'required|numeric',
            'idUser' => 'required|numeric',
            'jumlahPenumpang' => 'required|numeric',
            'totalHarga' => 'required|numeric'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $orderPesawat->noPenerbangan = $updateData['noPenerbangan'];
        $orderPesawat->asal = $updateData['asal'];
        $orderPesawat->tujuan = $updateData['tujuan'];
        $orderPesawat->waktuBerangkat = $updateData['waktuBerangkat'];
        $orderPesawat->waktuTiba = $updateData['waktuTiba'];
        $orderPesawat->harga = $updateData['harga'];
        $orderPesawat->idUser = $updateData['idUser'];
        $orderPesawat->jumlahPenumpang = $updateData['jumlahPenumpang'];
        $orderPesawat->totalHarga = $updateData['totalHarga'];

        if($orderPesawat->save()) {
            return response([
                'message' => 'Update Order Pesawat Success',
                'data' => $orderPesawat
            ], 200);
        }

        return response([
            'message' => 'Update Order Pesawat Failed',
            'data' => null,
        ], 400);
    }
}
