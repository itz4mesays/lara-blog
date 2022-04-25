@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-left">
        <div class="col-md-12">
            <div class="card">
                <h3 class="card-header">{{ __('Edit Post for '.$post->post_title) }}</h3>

                <div class="card-body">
                    {!! Form::open(['method' => 'POST', 'url' => route('user.post.update', $post->id), 'id' => 'edit-post', 'enctype' => 'multipart/form-data']) !!}
                        @method('PUT')
                        <div class="form-group">
                            {!! Form::label('post_title', 'Title', ['class' => '']) !!}
                            {!! Form::text('post_title', $post->post_title, ['class' => 'form-control', 'required' => false, 'placeholder' => 'Enter the Post Title']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('body', 'Description', []) !!}
                            {!! Form::textarea('body', $post->body, ['class' => 'form-control', 'rows' => 6, 'required' => false, 'placeholder' => 'Enter the Content of the Post']) !!}
                        </div>

                        <br/>
                        <div class="form-group">
                            {!! Form::label('file', 'Upload A New File') !!}
                            {!! Form::file('file_name', []) !!}
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
