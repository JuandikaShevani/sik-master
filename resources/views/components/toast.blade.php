@push('scripts')
    @if (session()->has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('message') }}',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @elseif ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                html: '{{ implode('<br>', $errors->all()) }}',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif
@endpush
