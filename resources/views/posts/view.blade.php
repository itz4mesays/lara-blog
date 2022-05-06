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
                            
                            <div class="pad-ver">
                                <div class="btn-group">

                                    <p class="btn btn-sm btn-default btn-hover-success duid" data-uid="{{'like_'.$post->id}}">       
                                        <span class="badge badge-secondary"> {{$post->lcount ? $post->lcount->likes : 0}}  </span> <i class="fa fa-thumbs-up"></i> 
                                    </p>

                                    <p class="btn btn-sm btn-default btn-hover-danger duid" data-uid="{{'unlike_'.$post->id}}">
                                        <span class="badge badge-info"> {{$post->lcount ? $post->lcount->unlikes : 0}} </span> <i class="fa fa-thumbs-down"></i>
                                    </p>
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>

            </div>

            {{-- <div class="container bootdey">
                <div class="col-md-12 bootstrap snippets">
                <div class="panel">
                    <div class="panel-body">
                    <!-- Newsfeed Content -->
                    <!--===================================================-->
                    <div class="media-block">
                    <a class="media-left" href="#"><img class="img-circle img-sm" alt="Profile Picture" src="https://bootdey.com/img/Content/avatar/avatar1.png"></a>
                    <div class="media-body">
                        <div class="mar-btm">
                        <a href="#" class="btn-link text-semibold media-heading box-inline">Lisa D.</a>
                        <p class="text-muted text-sm"><i class="fa fa-mobile fa-lg"></i> - From Mobile - 11 min ago</p>
                        </div>
                        <p>consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                        <div class="pad-ver">
                        <div class="btn-group">
                            <a class="btn btn-sm btn-default btn-hover-success" href="#"><i class="fa fa-thumbs-up"></i></a>
                            <a class="btn btn-sm btn-default btn-hover-danger" href="#"><i class="fa fa-thumbs-down"></i></a>
                        </div>
                        <a class="btn btn-sm btn-default btn-hover-primary" href="#">Comment</a>
                        </div>
                        <hr>

                        <!-- Comments -->
                        <div>
                        <div class="media-block">
                            <a class="media-left" href="#"><img class="img-circle img-sm" alt="Profile Picture" src="https://bootdey.com/img/Content/avatar/avatar2.png"></a>
                            <div class="media-body">
                            <div class="mar-btm">
                                <a href="#" class="btn-link text-semibold media-heading box-inline">Bobby Marz</a>
                                <p class="text-muted text-sm"><i class="fa fa-mobile fa-lg"></i> - From Mobile - 7 min ago</p>
                            </div>
                            <p>Sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                            <div class="pad-ver">
                                <div class="btn-group">
                                <a class="btn btn-sm btn-default btn-hover-success active" href="#"><i class="fa fa-thumbs-up"></i> You Like it</a>
                                <a class="btn btn-sm btn-default btn-hover-danger" href="#"><i class="fa fa-thumbs-down"></i></a>
                                </div>
                                <a class="btn btn-sm btn-default btn-hover-primary" href="#">Comment</a>
                            </div>
                            <hr>
                            </div>
                        </div>

                        <div class="media-block">
                            <a class="media-left" href="#"><img class="img-circle img-sm" alt="Profile Picture" src="https://bootdey.com/img/Content/avatar/avatar3.png">
                            </a>
                            <div class="media-body">
                            <div class="mar-btm">
                                <a href="#" class="btn-link text-semibold media-heading box-inline">Lucy Moon</a>
                                <p class="text-muted text-sm"><i class="fa fa-globe fa-lg"></i> - From Web - 2 min ago</p>
                            </div>
                            <p>Duis autem vel eum iriure dolor in hendrerit in vulputate ?</p>
                            <div class="pad-ver">
                                <div class="btn-group">
                                <a class="btn btn-sm btn-default btn-hover-success" href="#"><i class="fa fa-thumbs-up"></i></a>
                                <a class="btn btn-sm btn-default btn-hover-danger" href="#"><i class="fa fa-thumbs-down"></i></a>
                                </div>
                                <a class="btn btn-sm btn-default btn-hover-primary" href="#">Comment</a>
                            </div>
                            <hr>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                    <!--===================================================-->
                    <!-- End Newsfeed Content -->

                </div>
                </div>
                </div>
                </div> --}}

        </div>
    </div>
</div>
@endsection