<x-modal size="modal-xl" data-backdrop="static" data-keyboard="false">
    <x-slot name="title">
        Tambah Kartu Keluarga
    </x-slot>

    @method('post')
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="no_kk">No Kartu Keluarga :</label>
                <input type="text" name="no_kk" class="form-control">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="nama_kepala_keluarga">Nama Kepala Keluarga :</label>
                <input type="text" name="nama_kepala_keluarga" class="form-control">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="alamat">Alamat :</label>
        <textarea name="alamat" id="alamat" rows="3" class="form-control"></textarea>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <div class="form-group">
                <label for="rt">RT :</label>
                <input type="text" name="rt" class="form-control">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label for="rw">RW :</label>
                <input type="text" name="rw" class="form-control">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label for="kode_pos">Kode Pos :</label>
                <input type="text" name="kode_pos" class="form-control">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label for="tanggal_buat">Dikeluarkan Tanggal :</label>
                <div class="input-group datepicker" id="tanggal_buat" data-target-input="nearest">
                    <input type="text" name="tanggal_buat" class="form-control datetimepicker-input"
                        data-target="#tanggal_buat" />
                    <div class="input-group-append" data-target="#tanggal_buat" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="kelurahan">Desa/Kelurahan :</label>
                <input type="text" name="kelurahan" class="form-control">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="kecamatan">Kecamatan :</label>
                <input type="text" name="kecamatan" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="kabupaten">Kabupaten/Kota :</label>
                <input type="text" name="kabupaten" class="form-control">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="provinsi">Provinsi :</label>
                <input type="text" name="provinsi" class="form-control">
            </div>
        </div>
    </div>


    <x-slot name="footer">
        <button type="button" class="btn btn-success" onclick="submitForm(this.form)">Simpan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
    </x-slot>
</x-modal>
