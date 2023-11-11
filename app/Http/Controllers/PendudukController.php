<?php

namespace App\Http\Controllers;

use App\Models\KartuKeluarga;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class PendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kk = KartuKeluarga::orderBy('no_kk', 'asc')
            ->get()
            ->pluck('no_kk', 'id');

        return view('penduduk.index', compact('kk'));
    }

    public function data()
    {
        $query = Penduduk::where('status', 'hidup')->get();

        return datatables($query)
            ->addIndexColumn()
            ->editColumn('tanggal_lahir', function ($query) {
                return tanggal_indonesia($query->tanggal_lahir);
            })
            ->addColumn('action', function ($query) {
                return '
                <div class="d-flex justify-content-around">
                    <a href="' . route('penduduk.detail', $query->id) . '" class="btn btn-success"><i class="fas fa-search"></i></a>
                    <button onclick="editForm(`' . route('penduduk.show', $query->id) . '`)" class="btn btn-info"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger" onclick="deleteData(`' . route('penduduk.destroy', $query->id) . '`)"><i class="fas fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['action', 'path_image', 'tanggal_lahir'])
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
            'nik' => 'required|unique:penduduk,nik',
            'kartu_keluarga' => 'required|array',
            'nama_lengkap' => 'required',
            'usia' => 'nullable',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date_format:Y-m-d',
            'agama' => 'required',
            'pendidikan' => 'required',
            'jenis_pekerjaan' => 'required',
            'golongan_darah' => 'required',
            'status_perkawinan' => 'required',
            'tanggal_perkawinan' => 'nullable|date_format:Y-m-d',
            'status_keluarga' => 'required',
            'kewarganegaraan' => 'required',
            'no_paspor' => 'nullable|integer',
            'no_kitap' => 'nullable|integer',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'no_hp' => 'nullable|integer',
            'path_image' => 'nullable|mimes:png,jpg,jpeg,svg|max:2048',
            'status' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->except('path_image', 'kartu_keluarga');

        if ($request->hasFile('path_image')) {
            $data['path_image'] = upload('penduduk', $request->file('path_image'), 'penduduk');
        } else {
            $data['path_image'] = 'penduduk/penduduk_20231107112014.png';
        }

        $tanggal_lahir = $request->input('tanggal_lahir');
        $today = now();
        $data['usia'] = Carbon::parse($tanggal_lahir)->diffInYears($today);

        $data['status'] = 'hidup';

        $penduduk = Penduduk::create($data);
        $penduduk->detail_kartu_keluarga()->attach($request->kartu_keluarga);

        return response()->json(['data' => $penduduk, 'message' => 'Data Berhasil Ditambah!']);
    }

    /**
     * Display the specified resource.
     */

    public function show(Penduduk $penduduk)
    {
        $penduduk->kartu_keluarga = $penduduk->detail_kartu_keluarga;
        $penduduk->path_image = Storage::disk('public')->url($penduduk->path_image);

        return response()->json(['data' => $penduduk]);
    }

    /**
     * Show the form for detail the specified resource.
     *
     * @param int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $penduduk = Penduduk::findOrFail($id);

        return view('penduduk.detail', compact('penduduk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penduduk $penduduk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penduduk $penduduk)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required',
            'kartu_keluarga' => 'required|array',
            'nama_lengkap' => 'required',
            'usia' => 'nullable',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date_format:Y-m-d',
            'agama' => 'required',
            'pendidikan' => 'required',
            'jenis_pekerjaan' => 'required',
            'golongan_darah' => 'required',
            'status_perkawinan' => 'required',
            'tanggal_perkawinan' => 'nullable|date_format:Y-m-d',
            'status_keluarga' => 'required',
            'kewarganegaraan' => 'required',
            'no_paspor' => 'nullable|integer',
            'no_kitap' => 'nullable|integer',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'no_hp' => 'nullable|integer',
            'path_image' => 'nullable|mimes:png,jpg,jpeg,svg|max:2048',
            'status' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->except('path_image', 'kartu_keluarga');
        $data['status'] = 'hidup';
        $tanggal_lahir = $request->input('tanggal_lahir');
        $today = now();
        $data['usia'] = Carbon::parse($tanggal_lahir)->diffInYears($today);

        if ($request->hasFile('path_image')) {
            if (Storage::disk('public')->exists($penduduk->path_image)) {
                Storage::disk('public')->delete($penduduk->path_image);
            }
            $data['path_image'] = upload('penduduk', $request->file('path_image'), 'penduduk');
        }

        $penduduk->update($data);
        $penduduk->detail_kartu_keluarga()->sync($request->kartu_keluarga);

        return response()->json(['data' => $penduduk, 'message' => 'Data Berhasil Diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penduduk $penduduk)
    {
        if (Storage::disk('public')->exists($penduduk->path_image)) {
            Storage::disk('public')->delete($penduduk->path_image);
        }

        $penduduk->delete();

        return response()->json(['data' => null, 'message' => 'Data Berhasil Dihapus!']);
    }
}
