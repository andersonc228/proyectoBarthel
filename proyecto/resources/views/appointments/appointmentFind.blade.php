@extends('home')
@section('content')
    @isset($apointment)
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Section Apointments</div>
                        <div class="card-body">
                            <form method="POST" action="{{ url('appointments/manageAppointment') }}">
                                @csrf
                                <table class="table ">
                                    <tr class="thead-light">
                                        <th>Date</th>
                                        <th>Dni Pacient</th>
                                    </tr>
                                    <tr>
                                        <td><p>{{ $apointment->dateAppointment}}</p></td>
                                        <td><p>{{ $apointment->dniPacient}}</p></td>
                                    </tr>
                                </table>
                                <input hidden class="form-control" type="number" id="id" name="id" value="{{ $apointment->id}}" />
                                <button class="btn btn-success" type="submit" name="action" value="modify">Edit Appointment</button>
                                <button class="btn btn-danger" type="submit" name="action" value="delete">Delete Appointment</button>
                                <a class="btn btn-primary" href="homeAppointment">Return</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
@stop

@section('message')
    @if(isset($message))
        <div class="alert alert-warning">
            {{ $message }}
        </div>
    @endif
@stop