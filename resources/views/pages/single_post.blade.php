@extends('layouts.frontEnd')

@section('title')
    {{$post['headline']}}
@endsection
@section('content')

    <div class="banner-section">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session('show_error'))
            <div class="alert alert-danger">
                {{session('show_error')}}
            </div>
        @endif
            @if(session('sub_comment_success'))
                <div class="alert alert-success">
                    {{session('sub_comment_success')}}
                </div>
            @endif
            @if(session('success_reply_delete'))
                <div class="alert alert-success">
                    {{session('success_reply_delete')}}
                </div>
            @endif
        <h3 class="tittle">{{$post['headline']}}</h3>
        <div class="single">
            <img src="{{asset($post['picture'])}}" class="img-responsive" alt="" />
            <div class="b-bottom">
                <p class="sub">{{$post['text']}}</p>
                <p>{{"On ".date('M d',strtotime($post['created_at']))}}<a class="span_link" ><span class="glyphicon glyphicon-comment"></span>{{$count_comments}}</a><a class="span_link"><span class="glyphicon glyphicon-eye-open"></span>{{$count_visits}}</a></p>

            </div>
        </div>
        <div class="single-bottom">
        </div>
        <div class="response">
            <div id="response_tag"></div>
                <h4>Responses</h4>
            <div class="media response-info">
                                                                    {{-- || COMMENT--}}
                @isset($comments)
                @foreach($comments as $comment)
                <div class="media-left response-text-left">
                    <a>
                        <img class="media-object" src="{{asset($comment->user->profile_pic)}}" alt="profile_pic" width="80px"/>
                    </a>
                    <h5><a>{{$comment->user['username']}}</a></h5>
                </div>
                <div class="media-body response-text-right ">
                    <div id="comment_ajax_{{$comment->id}}">
                        <p>{{$comment->comment}}</p>
                    </div>
                    <ul>
                        <li>{{date('M d,Y',strtotime($comment->created_at))}}</li>
                        @isset(session('user')->UserId)
                        <li><button class="btn btn-primary" onclick="show({{$comment->id}})" data-id="{{$comment->id}}">Reply</button></li>
                        <div id="rep_form_{{$comment->id}}" style="display: none;">
                            <div class="media response-info">
                                <div class="media-body response-text-right">
                                    <form action="{{route('replies.store')}}" method="POST">
                                        @csrf
                                        <textarea rows="4" cols="67" id="text_rep" name="text_rep"></textarea>
                                        <input type="hidden" name="user_id" value="{{session('user')->UserId}}"/>
                                        <input type="hidden" name="comment_id" value="{{$comment->id}}"/>
                                        <input type="submit" id="sub_rep" value="Replay"/>
                                    </form>
                                </div>
                                    <div class="clearfix"> </div>
                            </div>
                        </div>

                        @if($comment->user_id == session('user')->UserId)
                        <li>
                            <form action="{{route('comments.destroy',['id'=>$comment->id])}}" method="post">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-primary" >Delete</button>
                            </form>
                        </li>
                        <li><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateCommentModal">Update</button></li>
                                <!-- Update Comment Modal -->
                                <div class="modal fade" id="updateCommentModal" tabindex="-1" role="dialog" aria-labelledby="updateCommentModal" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h5 class="modal-title" id="exampleModalLongTitle">Update Comment</h5>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('comments.update',['id' => $comment->id])}}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <label for="update-comment"></label>
                                                    <textarea id="update-comment" name="update_field" rows="4" cols="67">{{$comment->comment}}</textarea>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <input type="submit" class="btn btn-warning" value="Update">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                   @endif
                @endisset
                                                                        {{-- || REPLAY--}}
                        @foreach($replies as $reply)
                            @if($comment->id == $reply->comment_id)
                        <div class="media response-info">
                            <div class="media-left response-text-left">
                                <a>
                                    <img class="media-object" src="{{asset($reply->user->profile_pic)}}" alt="profile_picture" width="80px"/>
                                </a>
                                <h5><a href="#">{{$reply->user['username']}}</a></h5>
                            </div>
                            <div class="media-body response-text-right">
                                <span id="reply_ajax_{{$reply->id}}"><p>{{$reply->reply}}</p></span>
                                <span id="update_reply_ajax_{{$reply->id}}" style="display: none;"></span>
                                <ul>
                                    <li>{{date('M d,Y',strtotime($reply->created_at))}}</li>
                                    @isset(session('user')->UserId)
                                        @if($reply->user_id == session('user')->UserId)
                                        <li>
                                            <form action="{{route('replies.destroy',['id'=>$reply->id])}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-primary" >Delete</button>
                                            </form>
                                        </li>
                                        <li><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateReplayModal">Update</button></li>
                                            <!-- Update Reply Modal -->
                                            <div class="modal fade" id="updateReplayModal" tabindex="-1" role="dialog" aria-labelledby="updateReplayModal" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Update Reply</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('replies.update',['id' => $reply->id])}}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <label for="update-comment"></label>
                                                                <textarea id="update-comment" name="reply_field" rows="4" cols="67">{{$reply->reply}}</textarea>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <input type="submit" class="btn btn-warning" value="Update">
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    @endif
                                        @endisset
                                </ul>
                            <div class="clearfix"></div>
                        </div>
                            @endif
                        @endforeach
                    </ul>
                </div>
                        <div class="clearfix"> </div>
                    @endforeach
                    @endisset
            </div>
        @if(session('user'))
        <div class="coment-form">
            <h4>Leave your comment</h4>
            <form action="{{route('comments.store')}}" method="POST">
                <textarea name="comment_area" id="comment_area" placeholder="Your comment..."></textarea>
                <input type="hidden" name="user_id" id="user_id" value="{{session('user')->UserId}}"/>
                <input type="hidden" name="post_id" id="post_id" value="{{$post['id']}}"/>
                <input type="submit" id="sub_com" value="submit comment"/>
            </form>
        </div>
            <div id="com_success" class="alert alert-success" style="display: none;"></div>
        @else
            <div id="comment_no_auth">
                <p>SAMO ULOGOVANI KORISNICI MOGU DA KOMENTARISU</p>
            </div>
        @endif
        <div class="clearfix"></div>
    </div>
    </div>
    @include('partials.side_news')
    <div class="clearfix"> </div>


@endsection

@section('scripts')
    <script type="text/javascript">
        $('#btn_modal_update').click(function () {
            var com_id = $('#com_id').val();
            var text = $('#update_comment_modal').val();

            $.ajax({
                type:'PUT',
                url:'/comment/'+com_id,
                data:{
                    text: text
                },
                dataType: 'json',
                success:function (data) {
                    alert(data.msg);
                },
                error:function (xhr,Status,ErrMsg) {

                    var status = xhr.status;

                    switch(status){
                        case 422:
                            alert('The given data was invalid.');
                            break;
                        case 500:
                            alert('Server error,please come back later');
                            break;
                        default:
                        alert('Application is not working, please come back later');
                    }
                }
            });
        });

        $('#btn_modal_reply').click(function () {
            var rep_id = $('#rep_id').val();
            var text = $('#update_reply_modal').val();

            $.ajax({
                type:'PUT',
                url:'/reply/'+rep_id,
                data:{
                    text: text
                },
                dataType: 'json',
                success:function (data) {
                    alert(data.msg);
                },
                error:function (xhr,Status,ErrMsg) {

                    var status = xhr.status;

                    switch(status){
                        case 422:
                            alert('The given data was invalid.');
                            break;
                        case 500:
                            alert('Server error,please come back later');
                            break;
                        default:
                            alert('Application is rep_comnot working, please come back later');
                    }
                }
            });
        });

        function update_com(id) {
            $('#comment_ajax_'+id).hide();
            var text = $('#update_comment_modal').val();
            var ispis = '<p>'+text+'</p>';
            $('#update_comment_ajax_'+id).show().html(ispis);
        }

        function update_rep(id) {

            $('#reply_ajax_'+id).hide();
            var text = $('#update_reply_modal').val();
            var ispis = '<p>'+text+'</p>';
            $('#update_reply_ajax_'+id).show().html(ispis);
        }

        function show(id) {
            $('#rep_form_'+id).show();
        }
    </script>
    @endsection
