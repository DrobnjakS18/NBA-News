@extends('layouts.frontEnd')

{{--@section('header')--}}
    {{--@parent--}}
    {{--<meta property="og:url"                content="{{route('single_post',['id' => $post->id])}}" />--}}
    {{--<meta property="og:type"               content="article" />--}}
    {{--<meta property="og:title"              content="{{$post->headline}}" />--}}
    {{--<meta property="og:description"        content="{{$post->small_text}}" />--}}
    {{--<meta property="og:image"              content="{{$post->picture}}" />--}}

    {{--@endsection--}}

@section('title')
    {{$post->headline}}

@endsection
@section('header')
        @parent
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    @endsection
@section('single_post')

    <!--banner-section-->
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
        @if(session('delete_error'))
            <div class="alert alert-danger">
                {{session('delete_error')}}
            </div>
        @endif
            @if(session('sub_comment_success'))
                <div class="alert alert-success">
                    {{session('sub_comment_success')}}
                </div>
            @endif
            @if(session('sub_comment_error'))
                <div class="alert alert-danger">
                    {{session('sub_comment_error')}}
                </div>
            @endif
        <h3 class="tittle">{{$post->headline}}</h3>
        <div class="single">
            <img src="{{asset($post->picture)}}" class="img-responsive" alt="" />
            <div class="b-bottom">
                <p class="sub">{{$post->text}}</p>
                <p>{{"On ".date('M d',strtotime($post->date_published))}}<a class="span_link" ><span class="glyphicon glyphicon-comment"></span>{{$count_comments}}</a><a class="span_link"><span class="glyphicon glyphicon-eye-open"></span>{{$count_visits}}</a></p>

            </div>
        </div>
        <div class="single-bottom">
            {{--<div class="single-middle">--}}
                {{--<ul class="social-share">--}}
                    {{--<li><span>SHARE</span></li>--}}
                    {{--<li><a href="#"><i> </i></a></li>--}}
                    {{--<li><a href="#"><i class="tin"> </i></a></li>--}}
                    {{--<li><a href="#"><i class="message"> </i></a></li>--}}
                {{--</ul>--}}
                {{--<a href="#"><i class="arrow"> </i></a>--}}
                {{--<div class="clearfix"> </div>--}}
            {{--</div>--}}

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
                    <h5><a>  {{$com->username}}</a></h5>
                </div>
                <div class="media-body response-text-right ">
                    <div id="comment_ajax_{{$com->com_id}}">
                        <p>{{$com->com}}</p>
                    </div>
                    <div id="update_comment_ajax_{{$com->com_id}}" style="display: none;">

                    </div>
                    <ul>
                        <li>{{date('M d,Y',strtotime($com->date_comment))}}</li>
                        @isset(session('user')->UserId)
                        <li><a href="#response_tag" class="rep_com" onclick="show({{$com->com_id}})" data-id="{{$com->com_id}}">Reply</a></li>
                        <div id="rep_form_{{$com->com_id}}" style="display: none;">
                            <div class="media response-info">
                                <div class="media-body response-text-right">
                                    <form action="{{route('reply_comment',['id'=>$com->com_id])}}" method="POST">
                                        @csrf
                                        <textarea rows="4" cols="67" id="text_rep" name="text_rep"></textarea>
                                        <input type="hidden" name="user_id" value="{{session('user')->UserId}}"/>
                                        <input type="submit" id="sub_rep" value="Replay"/>
                                    </form>
                                </div>
                                    <div class="clearfix"> </div>
                            </div>

                        </div>

                        @if($com->id_u == session('user')->UserId)
                        <li><a href="{{route('del_comment',['id'=>$com->com_id])}}">Delete</a></li>
                        <li><a data-toggle="modal" href="#myModal">Update</a></li>
                                <div id="myModal" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Update Comment</h4>
                                            </div>
                                            <div class="modal-body">
                                                <textarea rows="4" cols="67" id="update_comment_modal" >{{$com->com}}</textarea>
                                                <input type="hidden" id="com_id" value="{{$com->com_id}}"/>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_modal_update" onclick="update_com({{$com->com_id}})">Save</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endif
                            @endisset

                                                                        {{--REPLAY--}}

                        @foreach($reply as $rep)
                            @if($com->com_id == $rep->id_c)
                        <div class="media response-info">
                            <div class="media-left response-text-left">
                                <a>
                                    <img class="media-object" src="{{asset($rep->profile_pic)}}" alt="{{$rep->alt}}"  width="80px"/>
                                </a>
                                <h5><a href="#">{{$rep->username}}</a></h5>
                            </div>
                            <div class="media-body response-text-right">
                                <span id="reply_ajax_{{$rep->rep_id}}"><p>{{$rep->reply}}</p></span>
                                <span id="update_reply_ajax_{{$rep->rep_id}}" style="display: none;"></span>
                                <ul>
                                    <li>{{date('M d,Y',strtotime($rep->date_comment))}}</li>
                                    @isset(session('user')->UserId)

                                              @if($rep->id_user == session('user')->UserId)
                                        <li><a href="{{route('reply_del',['id'=>$rep->rep_id])}}">Delete</a></li>
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
                                                        <input type="hidden" id="rep_id" value="{{$rep->rep_id}}"/>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_modal_reply" onclick="update_rep({{$rep->rep_id}})">Save</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @endif
                                        @endisset
                                </ul>
                            </span>
                            <div class="clearfix"> </div>
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
            <form action="{{route('sub_comment',['id' => $post->id])}}" method="POST">
                <textarea name="comment_area" id="comment_area" placeholder="Your comment..."></textarea>
                <input type="hidden" name="user_id" id="user_id" value="{{session('user')->UserId}}"/>
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






    <!--//banner-->
    <!--//banner-section-->
    <div class="banner-right-text">
        <h3 class="tittle">News  <i class="glyphicon glyphicon-facetime-video"></i></h3>
        <!--/general-news-->
        <div class="general-news">
            <div class="general-inner">
                <div class="general-text">
                    <div class="video-container">

                        <iframe width="853" height="480" src="{{$random_video->url}}" frameborder="0" allowfullscreen=""></iframe>
                    </div>

                    <h5 class="highlight_title">{{$random_video->title}}</h5>
                </div>
                <div class="edit-pics">
                    <h4 class="tittle" style="margin-top: 25px;">Most Viewed  <i class="glyphicon glyphicon-eye-open"></i></h4>

                @foreach($most as $late)
                        <div class="editor-pics">
                            <div class="col-md-3 item-pic">
                                <a href="{{route('single_post',['id'=>$late->id])}}"><img src="{{asset($late->small_picture)}}" class="img-responsive" ></a>
                            </div>
                            <div class="col-md-9 item-details">
                                <h5 class="inner two"><a href="{{route('single_post',['id'=>$late->id])}}">{{$late->headline}}r</a></h5>
                                <div class="td-post-date two"><i class="glyphicon glyphicon-time"></i>{{date('M d,Y',strtotime($late->date_published))}} <a href="#"><i class="glyphicon glyphicon-eye-open"></i>{{$late->BrojPregreda}}</a></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                    @endforeach

                </div>
                <div class="media">
                    <h3 class="tittle media">Post game conference <i class="glyphicon glyphicon-cog"></i></h3>
                    <div class="general-text two">
                        @foreach($post_game as $post)
                            <a href="{{route('single_post',['id'=>$post->id])}}"><img src="{{asset($post->picture)}}" class="img-responsive" alt=""></a>
                            <h5 class="top"><a href="{{asset('/post/'.$post->id)}}">{{$post->headline}}</a></h5>
                            <p>{{str_limit($post->text,240)}}</p>
                            <p>{{"On ".date('M d',strtotime($post->date_published))}}<a class="span_link" href="{{route('single_post',['id'=>$post->id])}}"><span class="glyphicon glyphicon-circle-arrow-right"></span></a></p>
                        @endforeach
                    </div>
                </div>
                {{--<div class="general-text two">--}}
                    {{--<a href="#"><img src="{{asset('images/gen2.jpg')}}" class="img-responsive" alt=""></a>--}}
                    {{--<h5 class="top"><a href="#">Consetetur sadipscing elit</a></h5>--}}
                    {{--<p>Consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt labore dolore magna aliquyam eratsed diam justo duo dolores rebum.</p>--}}
                    {{--<p>On Jun 27 <a class="span_link" href="#"><span class="glyphicon glyphicon-comment"></span>0 </a><a class="span_link" href="#"><span class="glyphicon glyphicon-eye-open"></span>56 </a><a class="span_link" href="#"><span class="glyphicon glyphicon-circle-arrow-right"></span></a></p>--}}
                {{--</div>--}}
            </div>
        </div>
        <!--//general-news-->
        <!--/news-->
        <!--/news-->
    </div>
    <div class="clearfix"> </div>
@endsection

@section('script')
    @parent
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
