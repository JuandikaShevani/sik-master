<x-modal data-backdrop="static" data-keyboard="false">
    <x-slot name="title">
        Tambah Kartu Keluarga
    </x-slot>

    @method('post')
    <div class="form-group">
        <label for="penduduk_id">Nama Penduduk :</label>
        <select name="penduduk_id" id="penduduk_id" class="select2 form-control">
            <option disabled selected>Pilih salah satu</option>
            @foreach ($penduduk as $item)
                <option value="{{ $item->id }}">{{ $item->nik }} - {{ $item->nama_lengkap }}</option>
            @endforeach
        </select>
    </div>

    <x-slot name="footer">
        <button type="button" class="btn btn-success" onclick="submitForm(this.form)">Simpan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
    </x-slot>
</x-modal>
