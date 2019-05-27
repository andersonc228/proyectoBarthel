@extends('home')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Register Administrator</div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('/registers/registerAdministrator') }}">
                            @csrf
                            <div class="form-group container">
                                <label for="name">DNI *:</label>
                                <input class="form-control" type="text" id="dni" name="dni" value="{{ old('dni') }}"  required/>
                                <label for="name">Name *:</label>
                                <input class="form-control" type="text" id="name" name="name" value="{{ old('name') }}" required/>
                                <label for="name">Surname *:</label>
                                <input class="form-control" type="text" id="surname" name="surname" value="{{ old('surname') }}"required />
                                <label for="name">Email *:</label>
                                <input class="form-control" type="text" id="email" name="email" value="{{ old('email') }}" required/>
                                <label for="name">Born Date *:</label> 
                                <input class="form-control" type="date" id="bornDate" name="bornDate" value="{{ old('bornDate') }}" required/>
                                <label for="name">Phone *:</label>
                                <input class="form-control" type="number" id="phone" name="phone" value="{{ old('phone') }}" />
                            
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

