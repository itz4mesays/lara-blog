@php
    use App\Helpers\Utils;
@endphp

<!-- List of Comments -->
@if (count($post->comments) > 0)
<div class="container bootdey">
    <div class="col-md-12 bootstrap snippets">
        <div class="panel">
            <div class="panel-body">
                <!-- Newsfeed Content -->
                <!--===================================================-->
                <div class="emptyDiv"></div>
                @foreach ($post->comments as $comment)
                    <div class="media-block">
                        <a class="media-left" href="#"><img class="img-circle img-sm" alt="Profile Picture" src="https://bootdey.com/img/Content/avatar/avatar1.png"></a>
                        <div class="media-body">
                            
                            <div class="mar-btm">
                                &ensp;<a href="#" class="btn-link text-semibold media-heading box-inline">{{ $comment->author->name }}</a>
                                <p class="text-muted text-sm"> &ensp;<i class="fa fa-calendar-alt fa-lg"></i> - Date Posted - {{ date('d/m/Y', strtotime($comment->created_at)) }}</p>
                            </div>
                            
                            <p>{!! $comment->message !!}</p>
                            
                            <div class="pad-ver">
                                <div class="btn-group">
                                    <p class="btn btn-sm btn-default btn-hover-success"><i class="fa fa-thumbs-up"></i></p>
                                    <p class="btn btn-sm btn-default btn-hover-danger"><i class="fa fa-thumbs-down"></i></p>
                                    <p class="addReply" href="#">Reply</p>
                                    <input type="hidden" name="commentid" value="{{$comment->id}}" class="commentid">
                                </div>
                            </div>

                            <div class="replyForm"></div>

                            @if (Utils::getSubComments($comment->id))
                                @foreach (Utils::getSubComments($comment->id) as $sub)
                                    <div class="media-block media-reply">
                                        <a class="media-left" href="#"><img class="img-circle img-sm" alt="Profile Picture" src="https://bootdey.com/img/Content/avatar/avatar2.png"></a>
                                        <div class="media-body">
                                            <div class="mar-btm">
                                                &ensp;<a href="#" class="btn-link text-semibold media-heading box-inline">{{$sub->author->name}}</a>
                                                <p class="text-muted text-sm">&ensp;<i class="fa fa-calendar-alt fa-lg"></i> - {{ date('d/m/Y', strtotime($sub->created_at)) }}</p>
                                                </div>
                                                <p>{{$sub->message}}</p>
                                                <hr>
                                            </div>
                                    </div>
                                @endforeach
                            @endif
                            

                        </div>
                    </div>
                @endforeach
                
                <!-- End Newsfeed Content -->

            </div>
        </div>
    </div>
</div>
@endif