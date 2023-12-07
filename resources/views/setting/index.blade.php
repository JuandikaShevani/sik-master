@extends('layouts.app')

@section('title', 'Pengaturan')
@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Pengaturan</li>
@endsection

@push('css')
    <style>
       .nav-pills .nav-item .nav-link.active {
            background-color: #28a745;
            color: #fff;
        }
    </style>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-12">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link @if (request('pills') == '') active @endif" href="{{ route('setting.index') }}">Umum</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (request('pills') == 'logo') active @endif" href="{{ route('setting.index') }}?pills=logo">Gambar</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade @if (request('pills') == '') show active @endif" id="pills-umum" role="tabpanel" aria-labelledby="pills-umum-tab">
                @includeIf('setting.umum')
            </div>
            <div class="tab-pane fade @if (request('pills') == 'logo') show active @endif" id="pills-logo" role="tabpanel" aria-labelledby="pills-logo-tab">
                @includeIf('setting.logo')
            </div>
        </div>
    </div>
</div>

<x-toast />
@endsection

