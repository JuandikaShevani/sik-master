<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Pengujian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengujianController extends Controller
{
    public function index()
    {
        return view('pengujian.index');
    }

    public function data()
    {
        $query = Penduduk::orderBy('nama_lengkap', 'asc')->get();

        return datatables($query)
            ->addIndexColumn()
            ->editColumn('tanggal_lahir', function ($query) {
                return tanggal_indonesia($query->tanggal_lahir);
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function hasilData()
    {
        $query = Pengujian::orderBy('created_at', 'desc')->get();

        return datatables($query)
            ->addIndexColumn()
            ->editColumn('nik', function ($query) {
                return $query->nik ?? '-';
            })
            ->editColumn('nama_lengkap', function ($query) {
                return $query->nama_lengkap ?? '-';
            })
            ->editColumn('status', function ($query) {
                return '<span class="badge badge-' . $query->badgeColor() . '">' . $query->status . '</span>';
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function getData()
    {
        $penduduk = Penduduk::all();

        $data = [];
        foreach ($penduduk as $item) {
            $data[] = [
                'nik' => $item->nik,
                'nama_lengkap' => $item->nama_lengkap,
            ];
        }

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $results = $request->input('results');

        foreach ($results as $result) {
            Pengujian::create([
                'nik' => $result['nik'],
                'nama_lengkap' => $result['nama_lengkap'],
                'status' => $request->input('status'),
                'search_time' => $request->input('searchTime')
            ]);
        }
        return response()->json(['message' => 'Data Berhasil Tersimpan']);
    }

    public function reset()
    {
        DB::table('pengujian')->truncate();

        return response()->json(['message' => 'Data Berhasil Direset']);
    }
}
