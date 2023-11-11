<x-modal size="modal-xl" data-backdrop="static" data-keyboard="false">
    <x-slot name="title">
        Tambah Penduduk
    </x-slot>

    @method('post')
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="nik">NIK :</label>
                <input type="text" name="nik" class="form-control">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="kartu_keluarga">No. Kartu Keluarga:</label>
                <select name="kartu_keluarga[]" id="kartu_keluarga" class="select2">
                    <option disabled selected>Pilih salah satu</option>
                    @foreach ($kk as $key => $item)
                        <option value="{{ $key }}">{{ $item }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap :</label>
                <input type="text" name="nama_lengkap" class="form-control">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin :</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="custom-select">
                    <option disabled selected>Pilih salah satu</option>
                    <option value="laki-laki">Laki-laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="tempat_lahir">Tempat Lahir :</label>
                <input type="text" name="tempat_lahir" class="form-control">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir :</label>
                <div class="input-group datepicker" id="tanggal_lahir" data-target-input="nearest">
                    <input type="text" name="tanggal_lahir" class="form-control datetimepicker-input"
                        data-target="#tanggal_lahir" />
                    <div class="input-group-append" data-target="#tanggal_lahir" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label for="agama">Agama :</label>
                <select name="agama" id="agama" class="custom-select">
                    <option selected="" disabled="">Pilih salah satu</option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen Protestan">Kristen Protestan</option>
                    <option value="Kristen Katolik">Kristen Katolik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Budha">Budha</option>
                    <option value="Khonghucu">Khonghucu</option>
                </select>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label for="pendidikan">Pendidikan :</label>
                <input type="text" name="pendidikan" class="form-control">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label for="jenis_pekerjaan">Jenis Pekerjaan :</label>
                <input type="text" name="jenis_pekerjaan" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="form-group">
                <label for="golongan_darah">Golongan Darah :</label>
                <select name="golongan_darah" id="golongan_darah" class="custom-select">
                    <option selected="" disabled="">Pilih salah satu</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="AB">AB</option>
                    <option value="O">O</option>
                    <option value="A+">A+</option>
                    <option value="B+">B+</option>
                    <option value="Tidak Tahu">Tidak Tahu</option>
                </select>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label for="status_perkawinan">Status Perkawinan :</label>
                <select name="status_perkawinan" id="status_perkawinan" class="custom-select">
                    <option selected="" disabled="">Pilih salah satu</option>
                    <option value="Belum Kawin">Belum Kawin</option>
                    <option value="Kawin Tercatat">Kawin Tercatat</option>
                    <option value="Kawin Tidak Tercatat">Kawin Tidak Tercatat</option>
                    <option value="Cerai Hidup">Cerai Hidup</option>
                    <option value="Cerai Mati">Cerai Mati</option>
                </select>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label for="tanggal_perkawinan">* Tanggal Perkawinan :</label>
                <div class="input-group datepicker" id="tanggal_perkawinan" data-target-input="nearest">
                    <input type="text" name="tanggal_perkawinan" class="form-control datetimepicker-input"
                        data-target="#tanggal_perkawinan" />
                    <div class="input-group-append" data-target="#tanggal_perkawinan" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label for="status_keluarga">Status Hubungan Dalam Keluarga :</label>
                <select name="status_keluarga" id="status_keluarga" class="custom-select">
                    <option selected="" disabled="">Pilih salah satu</option>
                    <option value="Kepala Keluarga">Kepala Keluarga</option>
                    <option value="Suami">Suami</option>
                    <option value="Istri">Istri</option>
                    <option value="Anak">Anak</option>
                    <option value="Menantu">Menantu</option>
                    <option value="Cucu">Cucu</option>
                    <option value="Orang Tua">Orang Tua</option>
                    <option value="Mertua">Mertua</option>
                    <option value="Famili Lain">Famili Lain</option>
                    <option value="Pembantu">Pembantu</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label for="kewarganegaraan">Kewarganegaraan :</label>
                <input type="text" name="kewarganegaraan" class="form-control">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="no_paspor">* No. Paspor :</label>
                <input type="text" name="no_paspor" class="form-control">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="no_kitap">* No. KITAP :</label>
                <input type="text" name="no_kitap" class="form-control">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="nama_ayah">Nama Ayah :</label>
                <input type="text" name="nama_ayah" class="form-control">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="nama_ibu">Nama Ibu :</label>
                <input type="text" name="nama_ibu" class="form-control">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="no_hp">* No. HP :</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">+62</span>
                    </div>
                    <input type="text" name="no_hp" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="path_image">* Foto :</label>
                <div class="form-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="path_image" name="path_image"
                            onchange="preview('.preview-path_image', this.files[0])">
                        <label class="custom-file-label" for="path_image">Choose file</label>
                    </div>
                </div>
            </div>
            <img src="" class="img-thumbnail preview-path_image" style="display: none;">
        </div>
    </div>


    <x-slot name="footer">
        <button type="button" class="btn btn-success" onclick="submitForm(this.form)">Simpan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
    </x-slot>
</x-modal>
