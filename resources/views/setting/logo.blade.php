<form action="{{ route('setting.update', $setting->id) }}?pills=logo" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')

    <x-card>
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <strong class="d-block text-center">Gambar Logo</strong>
                <div class="text-center">
                    @if (!is_null($setting->path_image) && Storage::disk('public')->exists($setting->path_image))
                        <img src="{{ Storage::disk('public')->url($setting->path_image)}}" alt="" class="img-thumbnail preview-path_image" width="200">
                    @else
                        <img src="{{ asset('AdminLTE/dist/img/AdminLTELogo.png')}}" alt="" class="img-thumbnail preview-path_image" width="200">
                    @endif
                </div>
                <div class="form-group mt-3">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="path_image" name="path_image"
                            onchange="preview('.preview-path_image', this.files[0])">
                        <label class="custom-file-label" for="path_image">Choose file</label>
                    </div>
                </div>
            </div>
            <div class="col-lg-2"></div>
            <div class="col-lg-4">
                <strong class="d-block text-center">Gambar Background</strong>
                <div class="text-center">
                    @if (!is_null($setting->path_image_bg) && Storage::disk('public')->exists($setting->path_image_bg))
                        <img src="{{ Storage::disk('public')->url($setting->path_image_bg)}}" alt="" class="img-thumbnail preview-path_image_bg" width="200">
                    @else
                        <img src="{{ asset('AdminLTE/dist/img/AdminLTELogo.png')}}" alt="" class="img-thumbnail preview-path_image_bg" width="200">
                    @endif
                </div>
                <div class="form-group mt-3">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="path_image_bg" name="path_image_bg"
                            onchange="preview('.preview-path_image_bg', this.files[0])">
                        <label class="custom-file-label" for="path_image_bg">Choose file</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <strong class="d-block text-center">Gambar Background Opsional</strong>
                <div class="text-center">
                    @if (!is_null($setting->path_image_bg2) && Storage::disk('public')->exists($setting->path_image_bg2))
                    <img src="{{ Storage::disk('public')->url($setting->path_image_bg2)}}" alt="" class="img-thumbnail preview-path_image_bg2" width="200">
                @else
                    <img src="{{ asset('AdminLTE/dist/img/AdminLTELogo.png')}}" alt="" class="img-thumbnail preview-path_image_bg2" width="200">
                @endif
                </div>
                <div class="form-group mt-3">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="path_image_bg2" name="path_image_bg2"
                            onchange="preview('.preview-path_image_bg2', this.files[0])">
                        <label class="custom-file-label" for="path_image_bg2">Choose file</label>
                    </div>
                </div>
            </div>
        </div>
        <x-slot name="footer">
            <button type="reset" class="btn btn-dark">Reset</button>
            <button class="btn btn-success">Simpan</button>
        </x-slot>
    </x-card>
</form>
