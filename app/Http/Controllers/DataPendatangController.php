<?php

namespace App\Http\Controllers;

use App\Models\DataPendatang;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class DataPendatangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelapor = Penduduk::all()
            ->where('status', 'valid');

        return view('pendatang.index', compact('pelapor'));
    }

    public function data()
    {
        $query = DataPendatang::orderBy('nik', 'desc')->get();

        return datatables($query)
            ->addIndexColumn()
            ->editColumn('tanggal_datang', function ($query) {
                return tanggal_indonesia($query->tanggal_datang);
            })
            ->editColumn('pelapor_id', function ($query) {
                return $query->pelapor->nama_lengkap;
            })
            ->addColumn('action', function ($query) {
                return '
                <div class="d-flex justify-content-around">
                    <button onclick="editForm(`' . route('data_pendatang.show', $query->id) . '`)" class="btn btn-info"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger" onclick="deleteData(`' . route('data_pendatang.destroy', $query->id) . '`)"><i class="fas fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['action', 'tanggal_datang'])
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
            'nik' => 'required|unique:datang_penduduk,nik|digits:16',
            'nama_pendatang' => 'required',
            'pelapor_id' => 'required',
            'tanggal_datang' => 'required|date_format:Y-m-d',
            'asal' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $dataPendatang = DataPendatang::create($request->all());
        return response()->json(['data' => $dataPendatang, 'message' => 'Data Berhasil DiTambah']);
    }

    /**
     * Display the specified resource.
     */
    public function show(DataPendatang $dataPendatang)
    {
        return response()->json(['data' => $dataPendatang]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataPendatang $dataPendatang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataPendatang $dataPendatang)
    {
        $validator = Validator::make($request->all(), [
            'nik' => ['required', 'digits:16', Rule::unique('datang_penduduk')->ignore($dataPendatang->id),],
            'nama_pendatang' => 'required',
            'pelapor_id' => 'required',
            'tanggal_datang' => 'required|date_format:Y-m-d',
            'asal' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $dataPendatang->update($request->all());
        return response()->json(['data' => $dataPendatang, 'message' => 'Data Berhasil Diubah']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataPendatang $dataPendatang)
    {
        $dataPendatang->delete();
        return response()->json(['data' => $dataPendatang, 'message' => 'Data Berhasil Dihapus']);
    }
}
