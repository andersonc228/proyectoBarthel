@extends('home')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Pacient</div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('/pacient/modify') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nif *:</label>
                                <input class="form-control" type="text" id="nif" name="nif" value="{{ old('name') }}" />
                                <label for="name">Name *:</label>
                                <input class="form-control" type="text" id="name" name="name" value="{{ old('name') }}" />
                                <label for="name">Surname *:</label>
                                <input class="form-control" type="text" id="surname" name="surname" value="{{ old('name') }}" />
                                <label for="name">Born Date *:</label>
                                <input class="form-control" type="date" id="borndate" name="borndate" value="{{ old('name') }}" />
                                <label for="name">Email *:</label>
                                <input class="form-control" type="text" id="email" name="email" value="{{ old('name') }}" />
                                <label for="name">Address *:</label>
                                <input class="form-control" type="text" id="address" name="address" value="{{ old('name') }}" />
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit" name="action" value="update">update</button>
                                <button class="btn btn-danger" type="submit" name="action" value="delete">delete</button>
                                <button class="btn btn-warning" type="reset">reset</button>
                            </div>

                            <label class="alert alert-light">* Required fields</label>
                            <input type="hidden" id="id" name="id" value="{{ $objProduct->id ?? old('id') }}">
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