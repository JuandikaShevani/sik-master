<table {{ $attributes->merge(['class' => 'table table-striped']) }} >
    @isset($thead)
    <thead align="center" class="bg-dark">
        {{ $thead }}
    </thead>
    @endisset

    <tbody align="center">
       {{ $slot }}
    </tbody>

    @isset($tfoot)
    <tfoot>
        {{ $tfoot }}
    </tfoot>
    @endisset
</table>
