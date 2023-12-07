<?php

namespace App\Http\Controllers;

use App\Models\DataKematian;
use App\Models\DataSktm;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataKematianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penduduk = Penduduk::all()
            ->where('status', '!=', 'pindah');

        return view('kematian.index', compact('penduduk'));
    }

    public function data()
    {
        $query = DataKematian::orderBy('tanggal_kematian', 'desc')->get();

        return datatables($query)
            ->addIndexColumn()
            ->editColumn('tanggal_kematian', function ($query) {
                return tanggal_indonesia($query->tanggal_kematian);
            })
            ->editColumn('nik', function ($query) {
                return $query->penduduk->nik;
            })
            ->editColumn('nama_lengkap', function ($query) {
                return $query->penduduk->nama_lengkap;
            })
            ->addColumn('action', function ($query) {
                return '
                <div class="d-flex justify-content-around">
                    <button onclick="editForm(`' . route('data_kematian.show', $query->id) . '`)" class="btn btn-info"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger" onclick="deleteData(`' . route('data_kematian.destroy', $query->id) . '`)"><i class="fas fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['action', 'tanggal_lahir'])
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'penduduk_id' => 'required|unique:kematian_penduduk,penduduk_id',
            'tanggal_kematian' => 'required|date_format:Y-m-d',
            'penyebab_kematian' => 'required',
            'tempat_pemakaman' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $dataKematian = DataKematian::create($request->all());

        $penduduk = Penduduk::find($dataKematian->penduduk_id);
        if ($penduduk) {
            $sktm = DataSktm::where('penduduk_id', $penduduk->id)->first();
            if ($sktm) {
                $sktm->delete();
            }
        }
        $penduduk->status = 'meninggal';
        $penduduk->save();

        // $dataKematian = Penduduk::find($request->penduduk_id);
        // $dataKematian->status = 'meninggal';
        // $dataKematian->save();

        return response()->json(['data' => $dataKematian, 'message' => 'Data Berhasil Ditambah']);
    }

    /**
     * Display the specified resource.
     */
    public function show(DataKematian $dataKematian)
    {
        return response()->json(['data' => $dataKematian]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataKematian $dataKematian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataKematian $dataKematian)
    {
        $validator = Validator::make($request->all(), [
            'penduduk_id' => 'required',
            'tanggal_kematian' => 'required|date_format:Y-m-d',
            'penyebab_kematian' => 'required',
            'tempat_pemakaman' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $penduduklama = Penduduk::find($dataKematian->penduduk_id);
        $pendudukbaru = Penduduk::find($request->penduduk_id);

        if ($penduduklama && $pendudukbaru) {
            $penduduklama->status = 'valid';
            $penduduklama->save();

            $pendudukbaru->status = 'meninggal';
            $pendudukbaru->save();

            $sktmlama = DataSktm::where('penduduk_id', $penduduklama->id)->first();
            $sktmbaru = DataSktm::where('penduduk_id', $pendudukbaru->id)->first();

            if ($sktmlama) {
                $sktmlama->delete();
            }

            if ($sktmbaru) {
                $sktmbaru->delete();
            }
        }

        $dataKematian->update($request->all());
        return response()->json(['data' => $dataKematian, 'message' => 'Data Berhasil Diubah']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataKematian $dataKematian)
    {
        $penduduk = $dataKematian->penduduk;

        if ($penduduk) {
            $penduduk->status = 'valid';
            $penduduk->save();
        }

        $dataKematian->delete();
        return response()->json(['data' => $dataKematian, 'message' => 'Data Berhasil Dihapus']);
    }
}
