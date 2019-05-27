@extends('home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My Appointment</div>
                <div class="card-body">
                    <form method="POST" action="{{ url('pacient/pacientViewAppointment') }}">
                        @csrf
                        <div class="form-group">
                            <button class="btn btn-success" type="submit" name="action" value="">View Appointments</button>
                        </div>
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