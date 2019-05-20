@extends('home')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                    @if(Auth::user()->hasRole('admin'))
                        Find User
                    @endif
                    @if(Auth::user()->hasRole('doctor'))
                        Find Pacient
                    @endif
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('/findPost') }}">
                            @csrf
                            <div class="form-group">
                                <label for="id">DNI *:</label>
                                <input class="form-control" type="text" id="dni" name="dni" value="{{ $dni ?? old('dni') }}" />
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Find</button>
                                <button class="btn btn-danger" type="reset">Reset</button>
                                <a class="btn btn-dark" href="{{ url('/findView') }}">reload</a>
                            </div>
                            <label class="alert alert-light">* Required fields</label>
                        </form>
                    </div>
                </div>
            </div>     
        </div>
@stop

@section('message')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @isset($message)
        <div class="alert alert-warning">
            {{ $message }}
        </div>
    @endisset
@stop
