@extends('layouts.main')

@section('title', 'All ')
@section('content')

    <section class="slice py-7">
        <div class="container">

            @if (count($posts) > 0)
                @foreach ($posts as $p)
                    <div class="card mb-5 hover-translate-y-n10">

                        <div>
                            <img src="/storage/postUploads/{{ $p->file_name }}" class="img-fluid img-center" style="height: 200px;" />
                        </div>

                        <div class="d-flex p-5">

                            <div>
                                @if ($p->status == 0)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </div>
                            <div class="pl-4">
                                <h5>{{$p->post_title}}</h5>
                                <p>
                                    {!! $p->body !!}
                                </p>

                                <br/>

                                <p class="text-bold"> <em> {{ __('Posted By: ')}}
                                    <span class="badge badge-secondary badge-pill"> {{ $p->user->name }}</span>
                                    </em> </p>
                                <p class="text-bold"> <em>{{ __('Written on')}}: {{ date('F d, Y', strtotime($p->created_at)) }}</em> </p>

                                <div class="pad-ver">
                                    <div class="btn-group">
                                        <p class="btn btn-sm btn-default btn-hover-success duid" data-uid="{{'like_'.$p->id}}">
                                            <span class="badge badge-secondary"> {{$p->lcount ? $p->lcount->likes : 0}}  </span> <i class="fa fa-thumbs-up"></i>
                                        </p>

                                        <p class="btn btn-sm btn-default btn-hover-danger duid" data-uid="{{'unlike_'.$p->id}}">
                                            <span class="badge badge-info"> {{$p->lcount ? $p->lcount->unlikes : 0}} </span> <i class="fa fa-thumbs-down"></i>
                                        </p>

                                        <p class="btn btn-sm btn-default btn-hover-danger commentCount" data-comm="{{$p->id}}">
                                            <span class="badge badge-secondary"> {{$p->comments ? count($p->comments) : 0}}  </span> <i class="fa fa-comment" title="Comments"></i>
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                @endforeach

                {{$posts->links()}}
            @else
                <p>There are no posts in the blog at the moment...</p>
            @endif

        </div>
    </section>
@endsection
