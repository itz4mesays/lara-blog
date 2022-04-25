@extends('layouts.main')

@section('title', 'All Posts')

@section('content')
<div class="container">
    <div class="row justify-content-left">
        <div class="col-md-12">
            <div class="card">
                <h3 class="card-header">{{ __('Manage Posts') }}</h3>

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
                                        <td>
                                            @if ($post->status == 0)
                                                <span class="badge badge-secondary">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>{{ date('F, d Y', strtotime($post->created_at)) }}</td>
                                        <td>
                                            <div class="btn-group dropright">
                                                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('user.post.view', $post->id) }}"><i data-feather="arrow-right-circle"></i> {{ __('View') }}</a>
                                                    <a class="dropdown-item" href="{{ route('user.post.edit', $post->id) }}"><i data-feather="edit"></i> {{ __('Edit') }}</a>
                                                    
                                                    {!! Form::open(['method' => 'POST', 'url' => route('user.post.delete', $post->id), 'id' => 'delete-post']) !!}
                                                        @method('DELETE') 
                                                        {{ Form::button('
                                                            <i class="fa fa-trash"></i>Delete', [
                                                                'type' => 'submit', 
                                                                'class' => 'dropdown-item',
                                                                'onclick' => "return confirm('Are you sure you want to delete this item?')"
                                                            ] )  }}
                                                    {!! Form::close() !!}
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
                                Please click <a href="{{ route('user.post.create') }}">here</a> to create new post.</p>
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