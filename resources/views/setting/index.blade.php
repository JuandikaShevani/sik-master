@extends('layouts.app')

@section('title', 'Pengaturan')
@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Pengaturan</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <x-card class="card-primary card-outline">
            <x-slot name="header">
                <div class="d-flex justify-content-between">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link @if (request('pills') == '') active @endif"
                                href="{{ route('setting.index')}}">Umum</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if (request('pills') == 'logo') active @endif"
                                href="{{ route('setting.index')}}?pills=logo">Logo</a>
                        </li>
                    </ul>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
            </x-slot>
            <div class="tab-content" id="pills-tabContent">
                {{-- Profile --}}
                <div class="tab-pane fade @if (request('pills') == '') show active @endif" id="pills-umum"
                    role="tabpanel" aria-labelledby="pills-general-tab">
                    @includeIf('setting.umum')</div>
                {{-- Password --}}
                <div class="tab-pane fade @if (request('pills') == 'logo') show active @endif" id="pills-logo"
                    role="tabpanel" aria-labelledby="pills-logo-tab">
                    @includeIf('setting.logo')</div>
            </div>
        </x-card>
    </div>
</div>
@endsection

<x-toast />
