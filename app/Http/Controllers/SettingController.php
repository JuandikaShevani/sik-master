<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();

        return view('setting.index', compact('setting'));
    }

    public function update(Request $request, Setting $setting)
    {
        $rules = [
            'nama_aplikasi' => 'required',
            'email'         => 'nullable',
            'deskripsi_singkat' => 'nullable',
            'no_hp'         => 'nullable|integer',
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
                'path_image'     => 'nullable|mimes:png,jpeg,jpg|max:2048',
                'path_image_bg'  => 'nullable|mimes:png,jpeg,jpg|max:5048',
                'path_image_bg2' => 'nullable|mimes:png,jpeg,jpg|max:5048',
            ];
        }

        $this->validate($request, $rules);

        $data = $request->except('path_image', 'path_image_bg', 'path_image_bg2');

        if ($request->hasFile('path_image')) {
            if (!is_null($setting->path_image)) {
                if (Storage::disk('public')->exists($setting->path_image)) {
                    Storage::disk('public')->delete($setting->path_image);
                }
            }

            $data['path_image'] = upload('setting', $request->file('path_image'), 'setting', 300, 300);
        }

        if ($request->hasFile('path_image_bg')) {
            if (!is_null($setting->path_image_bg)) {
                if (Storage::disk('public')->exists($setting->path_image_bg)) {
                    Storage::disk('public')->delete($setting->path_image_bg);
                }
            }

            $data['path_image_bg'] = upload('setting', $request->file('path_image_bg'), 'setting');
        }

        if ($request->hasFile('path_image_bg2')) {
            if (!is_null($setting->path_image_bg2)) {
                if (Storage::disk('public')->exists($setting->path_image_bg2)) {
                    Storage::disk('public')->delete($setting->path_image_bg2);
                }
            }

            $data['path_image_bg2'] = upload('setting', $request->file('path_image_bg2'), 'setting');
        }

        $setting->update($data);

        return back()->with([
            'success' => true,
            'message' => 'Pengaturan Berhasil Diubah!'
        ]);
    }
}
