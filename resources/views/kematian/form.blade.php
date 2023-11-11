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
                <label for="tanggal_kematian">Tanggal Kematian :</label>
                <div class="input-group datepicker" id="tanggal_kematian" data-target-input="nearest">
                    <input type="text" name="tanggal_kematian" class="form-control datetimepicker-input"
                        data-target="#tanggal_kematian" />
                    <div class="input-group-append" data-target="#tanggal_kematian" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="penyebab_kematian">Penyebab Kematian :</label>
        <textarea name="penyebab_kematian" id="penyebab_kematian" rows="3" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <label for="tempat_pemakaman">Tempat Pemakaman :</label>
        <textarea name="tempat_pemakaman" id="tempat_pemakaman" rows="3" class="form-control"></textarea>
    </div>


    <x-slot name="footer">
        <button type="button" class="btn btn-success" onclick="submitForm(this.form)">Simpan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
    </x-slot>
</x-modal>
