@extends('layouts.app')

@section('title', 'Profil')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Profil</li>
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
            <div class="callout callout-success">
                <h5><i class="fas fa-bullhorn"></i> Note :</h5>
                This page has been enhanced for profile.
                Manage your account for a more completely profile.
            </div>
        </div>

        <div class="col-lg-12">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link @if (request('pills') != 'password') active @endif"
                        href="{{ route('profile.show') }}">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (request('pills') == 'password') active @endif"
                        href="{{ route('profile.show') }}?pills=password">Password</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade @if (request('pills') != 'password') show active @endif" id="pills-profil"
                    role="tabpanel" aria-labelledby="pills-profil-tab">
                    @includeIf('profile.update-profile-information-form')
                </div>
                <div class="tab-pane fade @if (request('pills') == 'password') show active @endif" id="pills-password"
                    role="tabpanel" aria-labelledby="pills-password-tab">
                    @includeIf('profile.update-password-form')
                </div>
            </div>
        </div>
    </div>

    <x-toast />
@endsection
