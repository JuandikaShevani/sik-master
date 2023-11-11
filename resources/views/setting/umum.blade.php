<form action="{{ route('setting.update', $setting->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="nama_aplikasi">Nama Aplikasi :</label>
                <input type="nama_aplikasi" class="form-control @error('nama_aplikasi') is-invalid @enderror" id="nama_aplikasi" name="nama_aplikasi"
                value="{{ old('nama_aplikasi') ?? $setting->nama_aplikasi }}">
                @error('nama_aplikasi')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="kode_pos">Kode Pos :</label>
                <input type="text" class="form-control @error('kode_pos') is-invalid @enderror" id="kode_pos" name="kode_pos"
                 value="{{ old('kode_pos') ?? $setting->kode_pos }}">
                @error('kode_pos')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="profil">Profil :</label>
        <textarea class="form-control summernote @error('profil') is-invalid @enderror" id="profil" name="profil">{{ old('profil') ?? $setting->profil }}</textarea>
        @error('profil')
        <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="alamat">Alamat :</label>
        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat">{{ old('alamat') ?? $setting->alamat }}</textarea>
        @error('alamat')
        <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="kelurahan">Desa / Kelurahan :</label>
                <input type="text" class="form-control @error('kelurahan') is-invalid @enderror" id="kelurahan" name="kelurahan"
                 value="{{ old('kelurahan') ?? $setting->kelurahan }}">
                @error('kelurahan')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="kecamatan">Kecamatan :</label>
                <input type="kecamatan" class="form-control @error('kecamatan') is-invalid @enderror" id="kecamatan" name="kecamatan"
                value="{{ old('kecamatan') ?? $setting->kecamatan }}">
                @error('kecamatan')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="kabupaten">Kabupaten / Kota :</label>
                <input type="text" class="form-control @error('kabupaten') is-invalid @enderror" id="kabupaten" name="kabupaten"
                 value="{{ old('kabupaten') ?? $setting->kabupaten }}">
                @error('kabupaten')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="provinsi">Provinsi :</label>
                <input type="provinsi" class="form-control @error('provinsi') is-invalid @enderror" id="provinsi" name="provinsi"
                value="{{ old('provinsi') ?? $setting->provinsi }}">
                @error('provinsi')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="footer mt-2">
        <button type="reset" class="btn btn-dark">Reset</button>
        <button class="btn btn-success">Submit</button>
    </div>
</form>

@includeIf('includes.summernote')
