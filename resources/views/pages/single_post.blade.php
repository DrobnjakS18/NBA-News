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
                                                                {{--COMMENT--}}
                @isset($comments)
                @foreach($comments as $com)
                <div class="media-left response-text-left " >
                    <a>
                        <img class="media-object" src="{{asset($com->profile_pic)}}" alt="{{$com->alt}}" width="80px"/>
                    </a>
                    <h5><a>{{$com->username}}</a></h5>
                </div>
                <div class="media-body response-text-right ">
                    <div id="comment_ajax_{{$com->id}}">
                        <p>{{$com->comment}}</p>
                    </div>
                    <div id="update_comment_ajax_{{$com->id}}" style="display: none;"></div>
                    <ul>
                        <li>{{date('M d,Y',strtotime($com->created_at))}}</li>
                        @isset(session('user')->UserId)
                        <li><a href="#response_tag" class="rep_com" onclick="show({{$com->id}})" data-id="{{$com->id}}">Reply</a></li>
                        <div id="rep_form_{{$com->id}}" style="display: none;">
                            <div class="media response-info">
                                <div class="media-body response-text-right">
                                    <form action="{{route('reply_comment',['id'=>$com->id])}}" method="POST">
                                        @csrf
                                        <textarea rows="4" cols="67" id="text_rep" name="text_rep"></textarea>
                                        <input type="hidden" name="user_id" value="{{session('user')->UserId}}"/>
                                        <input type="submit" id="sub_rep" value="Replay"/>
                                    </form>
                                </div>
                                    <div class="clearfix"> </div>
                            </div>
                        </div>
                        @if($com->user_id == session('user')->UserId)
                        <li>
                            <form action="{{route('comments.destroy',['id'=>$com->id])}}" method="post">
                                @method('DELETE')
                                @csrf
                                <button >Delete</button>
                            </form>
                        </li>
                        <li><a data-toggle="modal" href="#myModal">Update</a></li>
                                <div id="myModal" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content text-center">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Update Comment</h4>
                                            </div>
{{--                                            <form>--}}
{{--                                                <textarea name="update-field" rows="4" cols="67">--}}
{{--                                                {{$com->com}}--}}
{{--                                                </textarea>--}}
{{--                                                <input type="submit" class="btn btn-warning" value="Update" onclick="">--}}
{{--                                            </form>--}}

                                        </div>
                                    </div>
                                </div>
                            @endif
                            @endisset
                                                                        {{--REPLAY--}}
                        @foreach($reply as $rep)
                            @if($com->id == $rep->comment_id)
                        <div class="media response-info">
                            <div class="media-left response-text-left">
                                <a>
                                    <img class="media-object" src="{{asset($rep->profile_pic)}}" alt="{{$rep->alt}}"  width="80px"/>
                                </a>
                                <h5><a href="#">{{$rep->username}}</a></h5>
                            </div>
                            <div class="media-body response-text-right">
                                <span id="reply_ajax_{{$rep->id}}"><p>{{$rep->reply}}</p></span>
                                <span id="update_reply_ajax_{{$rep->id}}" style="display: none;"></span>
                                <ul>
                                    <li>{{date('M d,Y',strtotime($rep->created_at))}}</li>
                                    @isset(session('user')->UserId)
                                        @if($rep->user_id == session('user')->UserId)
                                        <li><a href="{{route('reply_del',['id'=>$rep->id])}}">Delete</a></li>
                                        <li><a data-toggle="modal" href="#myModalReply">Update</a></li>
                                        <div id="myModalReply" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Update Comment</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <textarea rows="4" cols="67" id="update_reply_modal" >{{$rep->reply}}</textarea>
                                                        <input type="hidden" id="rep_id" value="{{$rep->id}}"/>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_modal_reply" onclick="update_rep({{$rep->id}})">Save</button>
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
            $('#update_comment_ajax_'+id).html(ispis);
            $('#update_comment_ajax_'+id).show();
        }

        function update_rep(id) {

            $('#reply_ajax_'+id).hide();
            var text = $('#update_reply_modal').val();
            var ispis = '<p>'+text+'</p>';
            $('#update_reply_ajax_'+id).html(ispis);
            $('#update_reply_ajax_'+id).show();
        }

        function show(id) {
            $('#rep_form_'+id).show();
        }
    </script>
    @endsection
