@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h4 class="card-header">{{ __('Notification') }}</h4>

                <div class="card-body">
                    @if (Auth::guest())
                        {{ __('Your registration is successful. Please proceed to ') }} <a href="{{ url('/login') }}">login</a>
                    @else
                    {{ __('Go back home. Click ') }} <a href="{{ url('/') }}">here</a>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
