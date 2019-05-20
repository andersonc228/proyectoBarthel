@extends('home')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Register Doctor</div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('/registers/registerDoctor') }}">
                            @csrf
                            <div class="form-group container">
                                <label for="name">DNI *:</label>
                                <input class="form-control" type="text" id="dni" name="dni" value="{{ old('dni') }}" />
                                <label for="name">Name *:</label>
                                <input class="form-control" type="text" id="name" name="name" value="{{ old('name') }}" />
                                <label for="name">Surname *:</label>
                                <input class="form-control" type="text" id="surname" name="surname" value="{{ old('surname') }}" />
                                <label for="name">Email *:</label>
                                <input class="form-control" type="text" id="email" name="email" value="{{ old('email') }}" />
                                <label for="name">Profession *:</label>
                                <input class="form-control" type="text" id="profession" name="profession" value="{{ old('profession') }}" />
                                <label for="name">Born Date *:</label>
                                <input class="form-control" type="date" id="bornDate" name="bornDate" value="{{ old('bornDate') }}" />
                            </div>
                            <div class="form-group container">
                                <button class="btn btn-success" type="submit">create</button>
                                <button class="btn btn-danger" type="reset">reset</button>
                            </div>
                            <label class="alert alert-light container">* Required fields</label>
                        </form>
                    </div>
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

