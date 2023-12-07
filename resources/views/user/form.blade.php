<x-modal data-backdrop="static" data-keyboard="false">
    <x-slot name="title">
        Tambah User
    </x-slot>

    @method('post')
    <div class="form-group">
        <label for="name">Nama :</label>
        <input type="text" name="name" id="name" class="form-control">
    </div>
    <div class="form-group">
        <label for="email">Email :</label>
        <input type="email" name="email" class="form-control">
    </div>
    <div class="form-group">
        <label for="password">Password :</label>
        <div class="input-group">
            <input type="password" name="password" id="password" class="form-control">
            <div class="input-group-append">
                <span toggle="#password" class="eye-toggle input-group-text">
                    <i class="fas fa-eye open-eye"></i>
                    <i class="fas fa-eye-slash closed-eye" style="display: none;"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="role_id">Role :</label>
        <select name="role_id" id="role_id" class="select form-control">
            <option disabled selected>Pilih salah satu</option>
            @foreach ($role as $key => $item)
                <option value="{{ $key }}">{{ $item }}</option>
            @endforeach
        </select>
    </div>

    <x-slot name="footer">
        <button type="button" class="btn btn-success" onclick="submitForm(this.form)">Simpan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
    </x-slot>
</x-modal>
