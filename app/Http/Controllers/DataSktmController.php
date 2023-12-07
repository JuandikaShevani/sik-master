<?php

namespace App\Http\Controllers;

use App\Models\DataSktm;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataSktmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penduduk = Penduduk::all()
            ->where('status', 'valid');

        return view('sktm.index', compact('penduduk'));
    }

    public function data()
    {
        $query = DataSktm::orderBy('created_at', 'desc')->get();

        return datatables($query)
            ->addIndexColumn()
            ->editColumn('nik', function ($query) {
                return $query->penduduk->nik;
            })
            ->editColumn('nama_lengkap', function ($query) {
                return $query->penduduk->nama_lengkap;
            })
            ->editColumn('jenis_kelamin', function ($query) {
                return $query->penduduk->jenis_kelamin;
            })
            ->editColumn('jenis_pekerjaan', function ($query) {
                return $query->penduduk->jenis_pekerjaan;
            })
            ->addColumn('action', function ($query) {
                return '
                <div class="d-flex justify-content-around">
                    <button onclick="editForm(`' . route('data_sktm.show', $query->id) . '`)" class="btn btn-info"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger" onclick="deleteData(`' . route('data_sktm.destroy', $query->id) . '`)"><i class="fas fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['action'])
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
            'penduduk_id' => 'required|unique:sktm_penduduk,penduduk_id'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $dataSktm = DataSktm::create($request->all());
        return response()->json(['data' => $dataSktm, 'message' => 'Data Berhasil Ditambah!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(DataSktm $dataSktm)
    {
        return response()->json(['data' => $dataSktm]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataSktm $dataSktm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataSktm $dataSktm)
    {
        $validator = Validator::make($request->all(), [
            'penduduk_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $dataSktm->update($request->all());
        return response()->json(['data' => $dataSktm, 'message' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataSktm $dataSktm)
    {
        $dataSktm->delete();
        return response()->json(['data' => $dataSktm, 'message' => 'Data Berhasil Dihapus!']);
    }
}
