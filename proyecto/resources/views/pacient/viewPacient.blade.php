@extends('home')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Pacient {{$user->name ?? old('name')}}</div>
                    <form method="POST" action="{{ url('/findDataPacient') }}">
                        @csrf
                        <div class="card-body">
                            <input hidden class="form-control" type="text" id="dni" name="dni" value="{{ $user->dni }}" />
                            <p class="card-text col-md-6">Name: {{$user->name ?? old('name')}}</p>
                            <p class="card-text col-md-6">Surname: {{$user->surname ?? old('surname')}}</p>
                            <p class="card-text col-md-5">Email: {{$user->email ?? old('email')}}</p>
                            <p class="card-text col-md-5">Born Date: {{date('Y-m-d',strtotime($user->bornDate)) ?? old('bornDate')}}</p>
                            <p class="card-text col-md-5">Phone: {{$user->phone ?? old('bornDate')}}</p>
                            <div class="form-group">
                                <div class="form-group">
                                    <button class="btn btn-success" type="submit" name="action" value="makeTest">Make Test</button>
                                    <button class="btn btn-success" type="submit" name="action" value="update">Update</button>
                                    <button class="btn btn-success" type="submit" name="action" value="viewResults">View Results</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection