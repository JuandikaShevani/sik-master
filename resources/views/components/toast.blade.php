@push('script')
@if (session()->has('success'))
<script>
     toastr.success('{{ session('message')}}')
</script>
@elseif (session()->has('edit'))
<script>
    toastr.info('{{ session('message')}}')
</script>
@elseif (session()->has('error'))
<script>
    toastr.error('{{ session('message')}}')
</script>
@endif
@endpush
