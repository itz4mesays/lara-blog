@extends('layouts.main')

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