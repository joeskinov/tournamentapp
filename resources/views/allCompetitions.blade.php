@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach($competitions as $comp)
        <div class="col-md-4  py-4">
            <div class="card">
                <div class="card-header"> <h4 class="card-title">{{ $comp->competition_name }}</h4></div>
                <div class="card-body">
                    <h6 class="card-subtitle text-muted">{{ count($comp->rounds) }} Rounds</h6>
                    <p class="card-text p-y-1">this is a decription</p>
                    <a href="/competition/{{$comp->id}}" class="card-link">GO TO</a>
                    <a href="#" class="card-link">Delete</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection