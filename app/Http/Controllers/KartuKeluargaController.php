<?php

namespace App\Http\Controllers;

use App\Models\KartuKeluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KartuKeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kartu_keluarga.index');
    }

    public function data(Request $request)
    {
        $query = KartuKeluarga::orderBy('no_kk', 'desc')->get();

        return datatables($query)
            ->addIndexColumn()
            ->editColumn('rw', function ($query) {
                return '0' . $query->rt . ' / ' . '0' . $query->rw;
            })
            ->addColumn('action', function ($query) {
                return '
                <div class="d-flex justify-content-around">
                    <a href="' . route('kartu_keluarga.detail', $query->id) . '" class="btn btn-success"><i class="fas fa-users"></i></a>
                    <button onclick="editForm(`' . route('kartu_keluarga.show', $query->id) . '`)" class="btn btn-info"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger" onclick="deleteData(`' . route('kartu_keluarga.destroy', $query->id) . '`)"><i class="fas fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['action'])
            ->escapeColumns([])
            ->make(true);
    }

    public function detail($id)
    {
        $kartu_keluarga = KartuKeluarga::findOrFail($id);
        return view('kartu_keluarga.detail', compact('kartu_keluarga'));
    }

    public function getPendudukData(KartuKeluarga $kartu_keluarga)
    {
        $pendudukData = $kartu_keluarga->detail_kartu_keluarga;

        return datatables()
            ->of($pendudukData)
            ->addIndexColumn()
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
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_kk' => 'required|unique:kartu_keluarga,no_kk',
            'nama_kepala_keluarga' => 'required',
            'alamat' => 'required',
            'rt' => 'required|integer',
            'rw' => 'required|integer',
            'kode_pos' => 'required|integer',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'provinsi' => 'required',
            'tanggal_buat' => 'required|date_format:Y-m-d'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $kartu_keluarga = KartuKeluarga::create($request->all());
        return response()->json(['data' => $kartu_keluarga, 'message' => 'Data Berhasil Ditambah']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KartuKeluarga  $kartu_keluarga
     * @return \Illuminate\Http\Response
     */
    public function show(KartuKeluarga $kartu_keluarga)
    {
        return response()->json(['data' => $kartu_keluarga]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KartuKeluarga $kartuKeluarga)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KartuKeluarga  $kartu_keluarga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KartuKeluarga $kartu_keluarga)
    {
        $validator = Validator::make($request->all(), [
            'no_kk' => 'required',
            'nama_kepala_keluarga' => 'required',
            'alamat' => 'required',
            'rt' => 'required|integer',
            'rw' => 'required|integer',
            'kode_pos' => 'required|integer',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'provinsi' => 'required',
            'tanggal_buat' => 'required|date_format:Y-m-d'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $kartu_keluarga->update($request->all());
        return response()->json(['data' => $kartu_keluarga, 'message' => 'Data Berhasil Diubah']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KartuKeluarga $kartu_keluarga)
    {
        $kartu_keluarga->delete();
        return response()->json(['data' => null, 'message' => 'Data Berhasil Dihapus']);
    }
}
