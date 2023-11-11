<form action="{{ route('user-profile-information.update') }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')

    <x-card>
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="text-center">
                    <img src="{{ Storage::disk('public')->url(auth()->user()->path_image ?? '') }}" alt=""
                        class="img-thumbnail preview-path_image mt-3" width="250">
                </div>
                <div class="form-group mt-3">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="path_image" name="path_image"
                            onchange="preview('.preview-path_image', this.files[0])">
                        <label for="path_image" class="custom-file-label">Choose File</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="name">Nama :</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') ?? auth()->user()->name }}">
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') ?? auth()->user()->email }}">
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="role">Role :</label>
                    <input type="text" class="form-control @error('role') is-invalid @enderror" name="role" id="role" value="{{ old('role') ?? auth()->user()->role->name }}" disabled>
                    @error('role')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <x-slot name="footer">
            <button type="reset" class="btn btn-dark">Reset</button>
            <button class="btn btn-success">Submit</button>
        </x-slot>
    </x-card>
</form>
