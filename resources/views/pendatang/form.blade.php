<x-modal size="modal-xl" data-backdrop="static" data-keyboard="false">
    <x-slot name="title">
        Tambah Kartu Keluarga
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
                <label for="nama_pendatang">Nama Pendatang :</label>
                <input type="text" name="nama_pendatang" class="form-control">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label for="pelapor_id">Nama Pelapor :</label>
                <select name="pelapor_id" id="pelapor_id" class="select2 form-control">
                    <option disabled selected>Pilih salah satu</option>
                    @foreach ($pelapor as $key => $item)
                        <option value="{{ $key }}">{{ $item }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="tanggal_datang">Tanggal Datang :</label>
                <div class="input-group datepicker" id="tanggal_datang" data-target-input="nearest">
                    <input type="text" name="tanggal_datang" class="form-control datetimepicker-input"
                        data-target="#tanggal_datang" />
                    <div class="input-group-append" data-target="#tanggal_datang" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="asal">Tempat Asal :</label>
                <input type="text" name="asal" class="form-control">
            </div>
        </div>
    </div>


    <x-slot name="footer">
        <button type="button" class="btn btn-success" onclick="submitForm(this.form)">Simpan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
    </x-slot>
</x-modal>
