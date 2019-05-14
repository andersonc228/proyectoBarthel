@extends('home')

@section('content')
<div class="card">
    <div class="card-header text-center">
       Create doctor
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('/registers/registerMedic') }}">
            {{ method_field('POST') }}
            {{ csrf_field() }}
            <div class="form-group container">
                <label for="name">Nif *:</label>
                <input class="form-control" type="text" id="nif" name="nif" value="{{ old('name') }}" />
                <label for="name">Name *:</label>
                <input class="form-control" type="text" id="name" name="name" value="{{ old('name') }}" />
                <label for="name">Surname *:</label>
                <input class="form-control" type="text" id="surname" name="surname" value="{{ old('name') }}" />
                <label for="name">Email *:</label>
                <input class="form-control" type="text" id="email" name="email" value="{{ old('name') }}" />
                <label for="name">Place *:</label>
                <input class="form-control" type="text" id="place" name="place" value="{{ old('name') }}" />
                <label for="name">Born Date *:</label>
                <input class="form-control" type="date" id="department" name="bornDate" value="{{ old('bornDate') }}" />
                
            </div>

            <div class="form-group container">
                <button class="btn btn-success" type="submit">create</button>
                <button class="btn btn-danger" type="reset">reset</button>
            </div>

            <label class="alert alert-light container">* Required fields</label>
        </form>
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

