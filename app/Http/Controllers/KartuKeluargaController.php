<?php

namespace App\Http\Controllers;

use App\Models\KartuKeluarga;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class KartuKeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kartu_keluarga.index');
    }

    public function data()
    {
        $query = KartuKeluarga::withCount('penduduk')
            ->orderBy('no_kk', 'asc')->get();

        return datatables($query)
            ->addIndexColumn()
            ->addColumn('checkbox', function ($query) {
                return '<input type="checkbox" class="data-check" data-id="' . $query->id . '" id="checkbox-' . $query->id . '">';
            })
            ->addColumn('jumlah_anggota_kk', function ($query) {
                return $query->penduduk_count;
            })
            ->editColumn('tanggal_buat', function ($query) {
                return tanggal_indonesia($query->tanggal_buat);
            })
            ->editColumn('alamat', function ($query) {
                return implode(' ', [
                    $query->alamat,
                    'RT',
                    '0' . $query->rt,
                    '/',
                    'RW',
                    '0' . $query->rw,
                ]);
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
            ->rawColumns(['action', 'checkbox'])
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
        $pendudukData = $kartu_keluarga->penduduk;

        return datatables($pendudukData)
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
            'no_kk' => 'required|unique:kartu_keluarga,no_kk|digits:16',
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
            'no_kk' => ['required', 'digits:16', Rule::unique('kartu_keluarga')->ignore($kartu_keluarga->id),],
            'nama_kepala_keluarga' => 'required',
            'alamat' => 'required',
            'rt' => 'required|integer',
            'rw' => 'required|integer',
            'kode_pos' => 'required|digits:5',
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

    public function deleteMultiple(Request $request, KartuKeluarga $kartu_keluarga)
    {
        $ids = $request->input('ids');
        $kartu_keluarga->whereIn('id', $ids)->delete();

        return response()->json(['success' => true, 'message' => 'Data Berhasil Dihapus!']);
    }

    // public function getDistricts()
    // {
    //     $districts = District::all();
    //     return response()->json($districts);
    // }

    // public function getRegencies()
    // {
    //     $regencies = Regency::all();
    //     return response()->json($regencies);
    // }

    // public function getProvinces()
    // {
    //     $provinces = Province::all();
    //     return response()->json($provinces);
    // }

    // public function getProvince(Request $request)
    // {
    //     $regency = Regency::find($request->regency_id);
    //     $province = $regency->province;

    //     return response()->json(['province' => $province]);
    // }

    // public function getRegencyProvince(Request $request)
    // {
    //     $district = District::find($request->district_id);
    //     $regency = $district->regency;
    //     $province = $regency->province;

    //     return response()->json([
    //         'regency' => $regency,
    //         'province' => $province,
    //     ]);
    //     // return response()->json(['regency' => $regency, 'province' => $province]);
    // }
}
