<?php

namespace App\Http\Controllers;

use App\Models\DataPindah;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataPindahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penduduk = Penduduk::where('status', 'hidup')
            ->orWhere('status', 'pindah')
            ->orderBy('nama_lengkap', 'asc')
            ->get()
            ->pluck('nama_lengkap', 'id');

        return view('pindah.index', compact('penduduk'));
    }

    public function data()
    {
        $query = DataPindah::orderBy('tanggal_pindah', 'desc')->get();

        return datatables($query)
            ->addIndexColumn()
            ->editColumn('tanggal_pindah', function ($query) {
                return tanggal_indonesia($query->tanggal_pindah);
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
                    <button onclick="editForm(`' . route('data_pindah.show', $query->id) . '`)" class="btn btn-info"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger" onclick="deleteData(`' . route('data_pindah.destroy', $query->id) . '`)"><i class="fas fa-trash"></i></button>
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
            'penduduk_id' => 'required|unique:pindah_penduduk,penduduk_id',
            'tanggal_pindah' => 'required|date_format:Y-m-d',
            'alamat_tujuan_pindah' => 'required',
            'keterangan_pindah' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $dataPindah = DataPindah::create($request->all());

        $dataPindah = Penduduk::find($request->penduduk_id);
        $dataPindah->status = 'pindah';
        $dataPindah->save();

        return response()->json(['data' => $dataPindah, 'message' => 'Data Berhasil Ditambah!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(DataPindah $dataPindah)
    {
        return response()->json(['data' => $dataPindah]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataPindah $dataPindah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataPindah $dataPindah)
    {
        $validator = Validator::make($request->all(), [
            'penduduk_id' => 'required',
            'tanggal_pindah' => 'required|date_format:Y-m-d',
            'alamat_tujuan_pindah' => 'required',
            'keterangan_pindah' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $penduduklama = Penduduk::find($dataPindah->penduduk_id);
        $pendudukbaru = Penduduk::find($request->penduduk_id);

        if ($penduduklama && $pendudukbaru) {
            $penduduklama->status = 'hidup';
            $penduduklama->save();

            $pendudukbaru->status = 'meninggal';
            $pendudukbaru->save();
        }

        $dataPindah->update($request->all());
        return response()->json(['data' => $dataPindah, 'message' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataPindah $dataPindah)
    {
        $penduduk = $dataPindah->penduduk;

        if ($penduduk) {
            $penduduk->status = 'hidup';
            $penduduk->save();
        }

        $dataPindah->delete();
        return response()->json(['data' => $dataPindah, 'message' => 'Data Berhasil Dihapus!']);
    }
}
