<?php

namespace App\Http\Controllers;

use App\Helpers\JsonResponse;
use App\Models\DetailNota;
use App\Models\Nota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class NotaController extends Controller
{
    public function create()
    {
        return view('tambah-nota');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->input(), [
            "nama_toko" => "required",
            "alamat" => "required",
            "kasir" => "required",
            "tanggal" => "required",
            "jam" => "required",
            "tunai" => "required",
            "footer" => "required",
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return JsonResponse::error($error, $error);
        }

        $nota   = new Nota();
        $nota->nama_toko    = $request->nama_toko;
        $nota->alamat    = $request->alamat;
        $nota->kasir    = $request->kasir;
        $nota->tanggal    = $request->tanggal;
        $nota->jam    = $request->jam;
        $nota->tunai    = $request->tunai;
        $nota->footer    = $request->footer;

        if ($nota->save()) return JsonResponse::success($nota, 'Berhasil menyimpan nota.');
        $error = "Gagal menyimpan nota";
        return JsonResponse::error($error, $error);
    }

    public function edit($id)
    {
        $data['nota'] = Nota::findOrFail($id);
        return view('ubah-nota', $data);
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->input(), [
            "nama_toko" => "required",
            "alamat" => "required",
            "kasir" => "required",
            "tanggal" => "required",
            "jam" => "required",
            "tunai" => "required",
            "footer" => "required",
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return JsonResponse::error($error, $error);
        }

        $nota   = Nota::findOrFail($id);

        $nota->nama_toko    = $request->nama_toko;
        $nota->alamat    = $request->alamat;
        $nota->kasir    = $request->kasir;
        $nota->tanggal    = $request->tanggal;
        $nota->jam    = $request->jam;
        $nota->tunai    = $request->tunai;
        $nota->footer    = $request->footer;

        if ($nota->save()) return JsonResponse::success($nota, 'Berhasil menyimpan nota.');
        $error = "Gagal menyimpan nota";
        return JsonResponse::error($error, $error);
    }

    public function delete(Request $request, $id)
    {
        if(Nota::destroy($id) > 0)
        {
            $message = "Nota berhasil di hapus";
            return JsonResponse::success($message, $message);
        }
        $message = "Nota gagal di hapus";
        return JsonResponse::error($message, $message);
    }

    public function show($id)
    {
        $data['nota'] = Nota::with('item')->findOrFail($id);
        return view('detail-nota', $data);
    }

    public function addItem(Request $request, $id)
    {
        $validator = Validator::make($request->input(), [
            "id_detail" => "required",
            "barang" => "required",
            "harga" => "required|numeric",
            "kuantitas" => "required|numeric",
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return JsonResponse::error($error, $error);
        }
        if($request->id_detail == 0){
            $detailNota = new DetailNota();
        }else{
            $detailNota = DetailNota::findOrFail($request->id_detail);
        }
        $detailNota->id_nota    = $id;
        $detailNota->barang     = $request->barang;
        $detailNota->harga     = $request->harga;
        $detailNota->kuantitas     = $request->kuantitas;
        $detailNota->diskon     = $request->diskon ?? 0;
        if ($detailNota->save()) return JsonResponse::success($detailNota, 'Berhasil menambahkan item barang.');
        $error = "Gagal menambahkan item barang";
        return JsonResponse::error($error, $error);
    }

    public function destroy(Request $request)
    {
        $id = $request->id_detail;
        if(DetailNota::destroy($id) > 0)
        {
            $message = "Berhasil menghapus item barang";
            return JsonResponse::success($message, $message);
        }
        $error = "Gagal menghapus item barang";
        return JsonResponse::error($error, $error);
    }

    public function item($id)
    {
        $item   = DetailNota::where('id_nota', $id)->get();
        return JsonResponse::success($item, 'Item barang.');
    }

    public function preview(Request $request, $id)
    {
        $data['nota'] = Nota::with('item')->findOrFail($id);
        $data['type'] = $request->query('type');
        switch ($request->query('type')) {
            case 'extra-large':
                # code...
                return view('nota.ekstra-besar', $data);
                break;
            case 'large':
                # code...
                return view('nota.besar', $data);
                break;
            case 'medium':
                # code...
                return view('nota.sedang', $data);
                break;
            case 'small':
                # code...
                return view('nota.kecil', $data);
                break;
            
            default:
                return abort(404);
                break;
        }
    }
}
