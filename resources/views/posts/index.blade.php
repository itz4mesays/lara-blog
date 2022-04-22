@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-left">
        <div class="col-md-12">
            <div class="card">
                <h3 class="card-header">{{ __('All Posts') }}</h3>

                <div class="card-body">

                    <div class="table-responsive">

                        @if (count($posts) > 0)
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Created By</th>
                                <th scope="col">Title</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date Created</th>
                                <th scope="col"></th>
                              </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1
                                @endphp
                                @foreach ($posts as $post)
                                    <tr>
                                        <th scope="row"> {{ $i }}</th>
                                        <td>
                                            @if ($post->user_id == auth()->user()->id)
                                              <span class="badge badge-success">self</span>
                                            @else
                                                {{ $post->user->name }}
                                            @endif
                                        </td>
                                        <td>{{ $post->post_title }}</td>
                                        <td>Status</td>
                                        <td>{{ date('F, d Y', strtotime($post->created_at)) }}</td>
                                        <td>
                                            <div class="btn-group dropright">
                                                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('post.view', $post->id) }}">{{ __('View') }}</a>
                                                    <a class="dropdown-item" href="#">{{ __('Delete') }}</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach
                            </tbody>
                          </table>


                        @else
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <p>
                                    <strong>Heads up!</strong> You have not created any post(s) at the moment.
                                Please click <a href="{{ route('post.create') }}">here</a> to create new post.</p>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                    </div>

                    <div class="col-sm-12">
                        {{ $posts->links() }}
                      </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
