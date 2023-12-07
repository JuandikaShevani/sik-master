<?php

namespace App\Http\Controllers;

use App\Exports\KartuKeluargaExport;
use App\Exports\PendudukExport;
use App\Models\KartuKeluarga;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function indexKK(Request $request)
    {
        $start = now()->subDays(30)->format('Y-m-d');
        $end = date('Y-m-d');

        if ($request->has('start') && $request->start != "" && $request->has('end') && $request->end != "") {
            $start = $request->start;
            $end = $request->end;
        }

        return view('laporan.kartu_keluarga', compact('start', 'end'));
    }

    public function dataKK($start, $end)
    {

        $query = KartuKeluarga::withCount('penduduk')
            ->when($start && $end, function ($query) use ($start, $end) {
                return $query->whereBetween('created_at', [$start, $end]);
            })
            ->orderBy('no_kk', 'asc')
            ->get();

        return datatables($query)
            ->addIndexColumn()
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
                    <a href="' . route('laporan.kartu_keluarga_pdf_detail', $query->id) . '" target="_blank" class="btn btn-danger"><i class="fas fa-file-pdf"></i></a>
                </div>
                ';
            })
            ->rawColumns(['action'])
            ->escapeColumns([])
            ->make(true);
    }

    public function cetakPDFKK($start, $end)
    {
        $query = KartuKeluarga::withCount('penduduk')
            ->whereBetween('created_at', [$start, $end])
            ->orderBy('no_kk', 'asc')
            ->get();

        $pdf = PDF::loadView('laporan.kartu_keluarga_pdf', compact('query', 'start', 'end'));
        $pdf->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan-kartu-keluarga-' . date('Y-m-d-his') . '.pdf');
    }

    public function cetakDetailPDFKK($id)
    {
        $query = KartuKeluarga::findOrFail($id);
        $penduduk = $query->penduduk;

        $pdf = PDF::loadView('laporan.kartu_keluarga_detail_pdf', compact('query', 'penduduk'));
        $pdf->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan-kartu-keluarga-' . date('Y-m-d-his') . '.pdf');
    }

    public function exportExcelKK()
    {
        return Excel::download(new KartuKeluargaExport, 'Laporan-kartu-keluarga-' . date('Y-m-d-his') . '.xlsx');
    }

    public function index(Request $request)
    {
        $start = now()->subDays(30)->format('Y-m-d');
        $end = date('Y-m-d');

        if ($request->has('start') && $request->start != "" && $request->has('end') && $request->end != "") {
            $start = $request->start;
            $end = $request->end;
        }

        return view('laporan.penduduk', compact('start', 'end'));
    }

    public function data($start, $end)
    {
        $query = Penduduk::with('kartu_keluarga')
            ->whereBetween('created_at', [$start, $end])
            ->orderBy('kartu_keluarga_id', 'asc')
            ->get();

        return datatables($query)
            ->addIndexColumn()
            ->editColumn('kartu_keluarga_id', function ($query) {
                return $query->kartu_keluarga->no_kk . ' - ' . $query->kartu_keluarga->nama_kepala_keluarga;
            })
            ->addColumn('ttl', function ($query) {
                return $query->tempat_lahir . ', ' .  tanggal_indonesia($query->tanggal_lahir);
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function cetakPDF($start, $end)
    {
        $query = Penduduk::with('kartu_keluarga')
            ->whereBetween('created_at', [$start, $end])
            ->orderBy('nik', 'asc')
            ->get();

        $pdf = PDF::loadView('laporan.penduduk_pdf', compact('query', 'start', 'end'));
        $pdf->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan-Penduduk-' . date('Y-m-d-his') . '.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new PendudukExport, 'Laporan-penduduk-' . date('Y-m-d-his') . '.xlsx');
    }
}
