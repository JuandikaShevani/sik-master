<x-modal size="modal-xl" data-backdrop="static" data-keyboard="false">
    <x-slot name="title">
        Tambah Kartu Keluarga
    </x-slot>

    @method('post')
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="penduduk_id">Nama Penduduk :</label>
                <select name="penduduk_id" id="penduduk_id" class="select2 form-control">
                    <option disabled selected>Pilih salah satu</option>
                    @foreach ($penduduk as $key => $item)
                        <option value="{{ $key }}">{{ $item }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="tanggal_pindah">Tanggal Pindah :</label>
                <div class="input-group datepicker" id="tanggal_pindah" data-target-input="nearest">
                    <input type="text" name="tanggal_pindah" class="form-control datetimepicker-input"
                        data-target="#tanggal_pindah" />
                    <div class="input-group-append" data-target="#tanggal_pindah" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="alamat_tujuan_pindah">Alamat Pindah :</label>
        <textarea name="alamat_tujuan_pindah" id="alamat_tujuan_pindah" rows="3" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <label for="keterangan_pindah">Keterangan :</label>
        <textarea name="keterangan_pindah" id="keterangan_pindah" rows="3" class="summernote form-control"></textarea>

    </div>
    <x-slot name="footer">
        <button type="button" class="btn btn-success" onclick="submitForm(this.form)">Simpan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
    </x-slot>
</x-modal>
