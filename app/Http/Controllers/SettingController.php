<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::first();
        return view('setting.index', compact('setting'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        $rules = [
            'path_image'    => 'nullable|mimes:png,jpg,jpeg,svg|max:2058',
            'nama_aplikasi' => 'required|max:10',
            'profil'        => 'nullable',
            'alamat'        => 'nullable',
            'kelurahan'     => 'nullable',
            'kecamatan'     => 'nullable',
            'kabupaten'     => 'nullable',
            'provinsi'      => 'nullable',
            'kode_pos'      => 'nullable|integer',
        ];

        if ($request->has('pills') && $request->pills == 'logo') {
            $rules = [
                'path_image'        => 'nullable|mimes:png,jpeg,jpg,svg|max:2048',
            ];
        }

        $this->validate($request, $rules);

        $data = $request->except('path_image');

        if ($request->hasFile('path_image')) {
            if (Storage::disk('public')->exists($setting->path_image)) {
                Storage::disk('public')->delete($setting->path_image);
            }
            $data['path_image'] = upload('setting', $request->file('path_image'), 'setting');
        }

        $setting->update($data);

        return back()->with([
            'message' => 'Setting update sucessfully',
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
