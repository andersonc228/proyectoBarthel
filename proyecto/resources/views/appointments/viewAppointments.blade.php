@extends('home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">View Appointment Pacient</div>
                <div class="card-body">
                    <form method="POST" action="{{ url('/appointments/viewAppointments') }}">
                        @csrf
                        <div class="form-group">
                            <label for="dni">DNI Pacient *:</label>
                            <input class="form-control" type="text" id="dni" name="dni" value="{{ old('dni') }}" required/>
                         </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit" name="action">View Appointments</button>
                            <a class="btn btn-danger" href="homeAppointment">Return</a>
                        </div>
                        <label class="alert alert-light">* Required fields</label>
                    </form>  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

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
