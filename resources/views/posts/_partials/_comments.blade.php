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
                                <a href="#" class="btn-link text-semibold media-heading box-inline">{{ $comment->author->name }}</a>
                                <p class="text-muted text-sm"><i class="fa fa-clock fa-lg"></i> - Date Posted - {{ date('F d, Y', strtotime($comment->created_at)) }}</p>
                            </div>
                            
                            <p>{!! $comment->message !!}</p>
                            
                            <div class="pad-ver">
                                <div class="btn-group">
                                    <p class="btn btn-sm btn-default btn-hover-success replyBtn" data-comment="{{$comment->id}}"><i class="fa fa-thumbs-up"></i></p>
                                    <p class="btn btn-sm btn-default btn-hover-danger replyBtn" data-comment="{{$comment->id}}"><i class="fa fa-thumbs-down"></i></p>
                                    <p class="addReply" href="#">Reply</p>
                                </div>
                            </div>

                            <div class="replyForm"></div>

                        </div>
                    </div>
                @endforeach
                
                <!-- End Newsfeed Content -->

            </div>
        </div>
    </div>
</div>
@endif