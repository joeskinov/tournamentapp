@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <script>
                    var csrf_token = '{{ csrf_token() }}';
                </script>
                <div class="card-header">{{ __('Create new Competition') }}</div>
                <div class="card-body">
                   <div id="competition-form" ></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
