@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-left">
        <div class="col-md-12">
            <div class="card">
                <h3 class="card-header"> {{ __('View Details for '. $post->post_title ) }} </h3>

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
                            {{-- <h5>{{ $post->post_title }} </h5> --}}
                            <p>
                                {!! $post->body !!}
                            </p>
                            <br/>
                            <p class="text-bold postColl" data-post="{{$post->id}}"> <em> {{ __('Created By')}}
                                <span class="badge badge-success badge-pill"> {{ $post->user->name }}</span>
                                </em> </p>
                            <p class="text-bold"> <em>{{ __('Posted On')}}: {{ date('d/m/Y', strtotime($post->created_at)) }}</em> </p>

                            <div class="pad-ver">
                                <div class="btn-group">

                                    <p class="btn btn-sm btn-default btn-hover-success duid" data-uid="{{'like_'.$post->id}}">
                                        <span class="badge badge-secondary"> {{$post->lcount ? $post->lcount->likes : 0}}  </span> <i class="fa fa-thumbs-up" title="Like this"></i>
                                    </p>

                                    <p class="btn btn-sm btn-default btn-hover-danger duid" data-uid="{{'unlike_'.$post->id}}">
                                        <span class="badge badge-info"> {{$post->lcount ? $post->lcount->unlikes : 0}} </span> <i class="fa fa-thumbs-down" title="Dislike this"></i>
                                    </p>

                                    <p class="btn btn-sm btn-default btn-hover-danger" data-comm="{{$post->id}}">
                                        <span class="badge badge-secondary"> {{$post->comments ? count($post->comments) : 0}}  </span> <i class="fa fa-comment" title="Comments"></i>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            @if (Auth::check())
                    <!-- Comment Section -->
                    <div class="commentSection">
                        <div class="" id="addComment">
                            {!! Form::open(['method' => 'POST', 'url' => route('user.post.comment', ['id' => $post->id]), 'id' => 'add-comment' ]) !!}
                            <div class="form-group">
                                {!! Form::textarea('message', null, ['class' => 'form-control', 'rows' => 2, 'id' => 'id_message', 'required' => true, 'placeholder' => 'Enter your comment here...']) !!}
                                <div class="divider"></div>
                                {!! Form::submit('Add Comment', ['class' => 'btn btn-primary btn-sm float-right', 'id' => 'submit-comment']) !!}

                                <div class="loading"></div>

                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                <!-- End Comment -->

                <br/>

                @include('posts._partials._comments', [$post])
            @endif
            

        </div>
    </div>
</div>
@endsection
