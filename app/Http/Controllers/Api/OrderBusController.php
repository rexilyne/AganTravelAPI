<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\OrderBus;

class OrderBusController extends Controller
{
    //
    public function index() {
        $orderBus = OrderBus::all();

        if(count($orderBus) > 0) {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $orderBus
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id) {
        $orderBus = OrderBus::find($id);

        if(!is_null($orderBus)) {
            return response([
                'message' => 'Retrieve Order Bus Success',
                'data' => $orderBus
            ], 200);
        }

        return response([
            'message' => 'Order Bus Not Found',
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
            'harga' => 'required|numeric',
            'idUser' => 'required|numeric',
            'jumlahPenumpang' => 'required|numeric',
            'totalHarga' => 'required|numeric'
        ]);

         if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $orderBus = OrderBus::create($storeData);
        return response([
            'message' => 'Add Order Bus Success',
            'data' => $orderBus
        ], 200);
    }

    public function destroy($id) {
        $orderBus = OrderBus::find($id);

        if(is_null($orderBus)) {
            return response([
                'message' => 'Order Bus Not Found',
                'data' => null
            ], 404);
        }

        if($orderBus->delete()) {
            return response([
                'message' => 'Delete Order Bus Success',
                'data' => $orderBus
            ], 200);
        }

        return response([
            'message' => 'Delete Order Bus Failed',
            'data' => null,
        ], 400);
    }

    public function update(Request $request, $id) {
        $orderBus = OrderBus::find($id);

        if(is_null($orderBus)) {
            return response([
                'message' => 'Order Bus Not Found',
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
            'harga' => 'required|numeric',
            'idUser' => 'required|numeric',
            'jumlahPenumpang' => 'required|numeric',
            'totalHarga' => 'required|numeric'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $orderBus->noBus = $updateData['noBus'];
        $orderBus->asal = $updateData['asal'];
        $orderBus->tujuan = $updateData['tujuan'];
        $orderBus->waktuBerangkat = $updateData['waktuBerangkat'];
        $orderBus->waktuTiba = $updateData['waktuTiba'];
        $orderBus->harga = $updateData['harga'];
        $orderBus->idUser = $updateData['idUser'];
        $orderBus->jumlahPenumpang = $updateData['jumlahPenumpang'];
        $orderBus->totalHarga = $updateData['totalHarga'];

        if($orderBus->save()) {
            return response([
                'message' => 'Update Order Bus Success',
                'data' => $orderBus
            ], 200);
        }

        return response([
            'message' => 'Update Order Bus Failed',
            'data' => null,
        ], 400);
    }
}
