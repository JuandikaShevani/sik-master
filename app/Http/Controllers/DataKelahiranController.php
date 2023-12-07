<?php

namespace App\Http\Controllers;

use App\Models\DataKelahiran;
use App\Models\KartuKeluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataKelahiranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kartu_keluarga = KartuKeluarga::all();

        return view('kelahiran.index', compact('kartu_keluarga'));
    }

    public function data()
    {
        $query = DataKelahiran::orderBy('nama', 'desc')->get();

        return datatables($query)
            ->addIndexColumn()
            ->editColumn('tanggal_lahir', function ($query) {
                return tanggal_indonesia($query->tanggal_lahir);
            })
            ->editColumn('kartu_keluarga_id', function ($query) {
                return $query->kartu_keluarga->no_kk . ' - ' . $query->kartu_keluarga->nama_kepala_keluarga;
            })
            ->addColumn('action', function ($query) {
                return '
                <div class="d-flex justify-content-around">
                    <button onclick="editForm(`' . route('data_kelahiran.show', $query->id) . '`)" class="btn btn-info"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger" onclick="deleteData(`' . route('data_kelahiran.destroy', $query->id) . '`)"><i class="fas fa-trash"></i></button>
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
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'date_format:Y-m-d',
            'jenis_kelamin' => 'required',
            'kartu_keluarga_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $dataKelahiran = DataKelahiran::create($request->all());
        return response()->json(['data' => $dataKelahiran, 'message' => 'Data Berhasil Ditambah']);
    }

    /**
     * Display the specified resource.
     */
    public function show(DataKelahiran $dataKelahiran)
    {
        return response()->json(['data' => $dataKelahiran]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataKelahiran $dataKelahiran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataKelahiran $dataKelahiran)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'date_format:Y-m-d',
            'jenis_kelamin' => 'required',
            'kartu_keluarga_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $dataKelahiran->update($request->all());
        return response()->json(['data' => $dataKelahiran, 'message' => 'Data Berhasil Diubah']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataKelahiran $dataKelahiran)
    {
        $dataKelahiran->delete();
        return response()->json(['data' => null, 'message' => 'Data Berhasil Dihapus']);
    }
}
