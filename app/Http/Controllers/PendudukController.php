<?php

namespace App\Http\Controllers;

use App\Models\KartuKeluarga;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class PendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kartu_keluarga = KartuKeluarga::all();

        return view('penduduk.index', compact('kartu_keluarga'));
    }

    public function data()
    {
        $query = Penduduk::with('kartu_keluarga')
            ->where('status', 'valid')
            ->orderBy('kartu_keluarga_id', 'asc')
            ->get();

        return datatables($query)
            ->addIndexColumn()
            ->addColumn('checkbox', function ($query) {
                return '<input type="checkbox" class="data-check" data-id="' . $query->id . '" id="checkbox-' . $query->id . '">';
            })
            ->editColumn('kartu_keluarga_id', function ($query) {
                return $query->kartu_keluarga->no_kk . ' - ' . $query->kartu_keluarga->nama_kepala_keluarga;
            })
            ->addColumn('ttl', function ($query) {
                return $query->tempat_lahir . ', ' .  tanggal_indonesia($query->tanggal_lahir);
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
            ->rawColumns(['action', 'checkbox'])
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
            'nik' => 'required|unique:penduduk,nik|digits:16',
            'kartu_keluarga_id' => 'required',
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

        $data = $request->except('path_image');

        if ($request->hasFile('path_image')) {
            $data['path_image'] = upload('penduduk', $request->file('path_image'), 'penduduk', 300, 300);
        } else {
            $imageBy = $request->input('jenis_kelamin');
            $data['path_image'] = $imageBy == 'laki-laki' ? 'img/man.png' : 'img/woman.png';
        }

        $tanggal_lahir = $request->input('tanggal_lahir');
        $today = now();
        $data['usia'] = Carbon::parse($tanggal_lahir)->diffInYears($today);
        $data['status'] = 'valid';

        $penduduk = Penduduk::create($data);
        return response()->json(['data' => $penduduk, 'message' => 'Data Berhasil Ditambah!']);
    }

    /**
     * Display the specified resource.
     */

    public function show(Penduduk $penduduk)
    {
        $imageName = $penduduk->path_image;
        $imgPath = public_path($imageName);

        if (file_exists($imgPath)) {
            $penduduk->path_image = asset($imageName);
        } else {
            $penduduk->path_image = Storage::disk('public')->url($imageName);
        }

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
            'nik' => ['required', 'digits:16', Rule::unique('penduduk')->ignore($penduduk->id),],
            'kartu_keluarga_id' => 'required',
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

        $data = $request->except('path_image');
        $tanggal_lahir = $request->input('tanggal_lahir');
        $tangga_sekarang = now();
        $data['usia'] = Carbon::parse($tanggal_lahir)->diffInYears($tangga_sekarang);

        if ($request->hasFile('path_image')) {
            if (Storage::disk('public')->exists($penduduk->path_image)) {
                Storage::disk('public')->delete($penduduk->path_image);
            }
            $data['path_image'] = upload('penduduk', $request->file('path_image'), 'penduduk', 300, 300);
        }

        $penduduk->update($data);
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

    public function deleteMultiple(Request $request, Penduduk $penduduk)
    {
        $ids = $request->input('ids');

        foreach ($penduduk->whereIn('id', $ids)->get() as $data) {
            if (!is_null($data->path_image) && Storage::disk('public')->exists($data->path_image)) {
                Storage::disk('public')->delete($data->path_image);
            }
        }

        $penduduk->whereIn('id', $ids)->delete();
        return response()->json(['data' => null, 'message' => 'Data Berhasil Dihapus!']);
    }
}
