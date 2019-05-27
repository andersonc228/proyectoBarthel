@extends('home')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Doctor {{$user->name ?? old('name')}}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('/pacient/modify') }}">
                            @csrf
                            <div class="form-group">
                                <label for="dni">DNI *:</label>
                                <input readonly class="form-control" type="text" id="dni" name="dni" value="{{ $user->dni }}" />
                                <label for="name">Name *:</label>
                                <input class="form-control" type="text" id="name" name="name" value="{{ $user->name }}" />
                                <label for="name">Surname *:</label>
                                <input class="form-control" type="text" id="surname" name="surname" value="{{ $user->surname }}" />
                                <label for="name">Born Date *:</label>                                      
                                <input class="form-control" type="date" id="bornDate" name="bornDate" value="{{date('Y-m-d', strtotime( $user->bornDate)) }}" />
                                <label for="name">Email *:</label>
                                <input class="form-control" type="text" id="email" name="email" value="{{ $user->email }}" />
                                <label for="name">Phone *:</label>
                                <input class="form-control" type="number" id="phone" name="phone" value="{{ $user->phone }}" />
                            </div>
                                <div class="form-group">
                                    <button class="btn btn-success" type="submit" name="action" value="update">update</button>
                                    <button class="btn btn-danger" type="submit" name="action" value="delete">delete</button>
                                </div>
                            <label class="alert alert-light">* Required fields</label>
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