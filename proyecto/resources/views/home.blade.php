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
                @if(null!=Auth::user())
                <div class="card-header">Welcome {{ Auth::user()->name }}</div>
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
                @endif
            </div>
        </div>
    </div>
    @show
</div>
@endsection

