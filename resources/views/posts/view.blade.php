@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-left">
        <div class="col-md-12">
            <div class="card">
                <h3 class="card-header">{{ __('View Details for '. $post->post_title ) }}</h3>

                <div class="card-body">

                    <div>
                        <img src="/storage/postUploads/{{ $post->file_name }}" class="img-fluid img-center" style="height: 200px;" />
                    </div>

                    <div class="d-flex p-5">
                        <div>
                            @if ($post->status == 0)
                                <span class="badge badge-success badge-pill">{{ __('Active') }}</span>
                            @else
                                <span class="badge badge-danger badge-pill">{{ __('Inactive') }}</span>
                            @endif
                            
                        </div>
                        <div class="pl-4">
                            <h5>{{ $post->post_title }} </h5>
                            <p>
                                {{ $post->body }}
                            </p>

                            <p class="text-bold"> <em> {{ __('Created By')}}
                                @if ($post->user_id == auth()->user()->id)
                                    <span class="badge badge-success badge-pill">{{ __('self') }}</span>
                                @else
                                <span class="badge badge-success badge-pill"> {{ $post->user->name }}</span>
                                @endif
                                </em> </p>
                            <p class="text-bold"> <em>{{ __('Written on')}}: {{ date('F d, Y', strtotime($post->created_at)) }}</em> </p>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection