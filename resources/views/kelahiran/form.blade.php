<x-modal size="modal-xl" data-backdrop="static" data-keyboard="false">
    <x-slot name="title">
        Tambah Kartu Keluarga
    </x-slot>

    @method('post')
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="nama">Nama Bayi :</label>
                <input type="text" name="nama" class="form-control">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="tempat_lahir">Tempat Lahir :</label>
                <input type="text" name="tempat_lahir" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
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
                <label for="kartu_keluarga_id">No. Kartu Keluarga:</label>
                <select name="kartu_keluarga_id" id="kartu_keluarga_id" class="select2">
                    <option disabled selected>Pilih salah satu</option>
                    @foreach ($kartu_keluarga as $item)
                        <option value="{{ $item->id }}">{{ $item->no_kk }} - {{ $item->nama_kepala_keluarga }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>


    <x-slot name="footer">
        <button type="button" class="btn btn-success" onclick="submitForm(this.form)">Simpan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
    </x-slot>
</x-modal>
