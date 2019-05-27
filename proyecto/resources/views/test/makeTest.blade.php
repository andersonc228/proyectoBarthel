@extends('home')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Make Pacient Test</div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('/test/makeTest') }}">
                            @csrf
                            <div class="col-12">
                                <div class="form-group col-3">
                                    <label for="name">Eat *:</label>
                                    <select id="eat" name="eat" class="form-control">
                                        <option value="0"></option>
                                        <option value="0">Fully Independent</option>
                                        <option value="5">Need help to cut meat, bread, etc.</option>
                                        <option value="10">Dependent</option>
                                    </select>
                                </div>
                                <div class="form-group col-3">
                                    <label for="name">Dress Up *:</label>
                                    <select id="dressup" name="dressup" class="form-control">
                                        <option value="0"></option>
                                        <option value="0">Independent: able to get and to remove clothing</option>
                                        <option value="5">Need help</option>
                                        <option value="10">Dependent</option>
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label for="name">Stools(assess the previous week) *:</label>
                                    <select id="stools" name="stools" class="form-control">
                                        <option value="0"></option>
                                        <option value="0">Normal continence</option>
                                        <option value="5">Need help to administer suppositories or lavatives</option>
                                        <option value="10">Incontinence</option>
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label for="name">Use the toilet *:</label>
                                    <select id="toilet" name="toilet" class="form-control">
                                        <option value="0"></option>
                                        <option value="0">Independent to go to the toilet</option>
                                        <option value="5">Need help to go to the toilet,but he cleans himself</option>
                                        <option value="10">Dependent</option>
                                    </select>
                                </div>

                                <div class="form-group col-6">
                                    <label for="name">Wander *:</label>
                                    <select id="wander" name="wander" class="form-control">
                                        <option value="0"></option>
                                        <option value="0">Independent, It walks just 50 meters</option>
                                        <option value="5">Need help to cut meat, bread, etc.</option>
                                        <option value="10">He needs physical help or supervision to travel 50 meters</option>
                                        <option value="15">Dependent</option>
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label for="name">Traveling *:</label>
                                    <select id="traveling" name="traveling" class="form-control">
                                        <option value="0"></option>
                                        <option value="0">Independent to go of the chair to be</option>
                                        <option value="5">Minimal physical help or supervision to do it</option>
                                        <option value="10">Need much assistance, but is able to stay sitting alone</option>
                                        <option value="15">Dependent</option>
                                    </select>
                                </div>

                                <div class="form-group col-3">
                                    <label for="name">Wash *:</label>
                                    <select id="wash" name="wash" class="form-control">
                                        <option value="0"></option>
                                        <option value="0">Independent: Enter and leave the bathroom alone</option>
                                        <option value="5">Dependent</option>
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label for="name">Get Ready *:</label>
                                    <select id="hour" name="hour" class="form-control">
                                        <option value="0"></option>
                                        <option value="0">Independent to Wash face, hands, hair, shaving, makeup.</option>
                                        <option value="5">Dependent</option>
                                    </select>
                                </div>

                                <div class="form-group col-6">
                                    <label for="name">Micturition(assess the previous week) *:</label>
                                    <select id="micturition" name="micturition" class="form-control">
                                        <option value="0"></option>
                                        <option value="0">Normal continence, or is capable of taking care of the probe if it has</option>
                                        <option value="5">A daily episode of incontinence, or need help to take care of the probe</option>
                                        <option value="10">Incontinence</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <input hidden class="form-control" type="text" id="dni" name="dni" value="{{ $user->dni }}" />
                                <button class="btn btn-success" type="submit">Submint</button>
                                <button class="btn btn-danger" type="reset">reset</button>
                                <a class="btn btn-info" href="">Go Back</a>
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