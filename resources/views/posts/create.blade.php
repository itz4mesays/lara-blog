@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-left">
        <div class="col-md-12">
            <div class="card">
                <h3 class="card-header">{{ __('Create Post') }}</h3>

                <div class="card-body">
                    {!! Form::open(['method' => 'POST', 'url' => route('post.store'), 'id' => 'create-post' ]) !!}
                        <div class="form-group">
                            {!! Form::label('post_title', 'Title', ['class' => '']) !!}

                            {!! Form::text('post_title', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('body', 'Description', []) !!}

                            {!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => 6]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Submit', ['class' => 'btn btn-info btn-sm']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
