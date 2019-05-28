@extends('layouts.app')

@section('main')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-8">
        @yield('message')
    </div>
        @section('content')
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Welcome {{ Auth::user()->name }}</div>
                @if(Auth::user()->hasRole('admin'))
                <div class="row row-home">
                    <div class="col-md-4 doctor-registrer btns"><a href="{{ route('registerDoctor') }}">REGISTER DOCTOR</a></div>
                    <div class="col-md-4 pacient-registrer btns"><a href="{{ route('registerPacient') }}">REGISTER PACIENT</a></div>
                    <div class="col-md-4 admin-registrer btns"><a href="{{ route('registerAdministrator') }}">REGISTER ADMINISTRATOR</a></div>
                </div>
                <div class="row row-home">
                    <div class="col-md-6 doctor-registrer btns">FIND USER</div>
                    <div class="col-md-6 pacient-registrer btns">UPDATE PASSWORD</div>
                </div>
                @endif
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(Auth::user()->hasRole('admin'))
                    @else
                        <div>Welcome </div>
                    @endif
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
    @show
</div>
@endsection

