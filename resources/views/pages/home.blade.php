@extends('layouts.frontEnd')
@section('title')
    Home
    @endsection
@section('home')

    <!--banner-section-->
    <div class="banner-section">
        @if(session('login_success'))
            <div class="alert alert-success">
                {{session('login_success')}}
            </div>
        @endif
        <h3 class="tittle">Latest news <i class="glyphicon glyphicon-bookmark "></i></h3>
        <div class="banner">
            <div  class="callbacks_container">
                <ul class="rslides" id="slider4">
                    @foreach($latest as $post)
                    <li>
                        <a href="{{route('single_post',['id'=>$post['id']])}}"><img src="{{asset($post['picture'])}}" class="img-responsive" alt="{{$post['alt']}}" /></a>
                        <h5 class="top"><a href="{{route('single_post',['id' => $post['id'],'user_id'=>isset(session('user')->UserId)?session('user')->UserId:null])}}">{{$post['headline']}}</a></h5>
                        <p>{{str_limit($post['text'],240)}}</p>
                            <p>{{"On ".date('M d',strtotime($post['date_published']))}}<a class="span_link" href="{{route('single_post',['id'=>$post['id']])}}"><span class="glyphicon glyphicon-circle-arrow-right"></span></a></p>
                    </li>
                    @endforeach
                </ul>
            </div>
            <!--banner-->
            <script src="js/responsiveslides.min.js"></script>
            <script>
                // You can also use "$(window).load(function() {"
                $(function () {
                    // Slideshow 4
                    $("#slider4").responsiveSlides({
                        auto: true,
                        pager:true,
                        nav:true,
                        speed: 500,
                        namespace: "callbacks",
                        before: function () {
                            $('.events').append("<li>before event fired.</li>");
                        },
                        after: function () {
                            $('.events').append("<li>after event fired.</li>");
                        }
                    });

                });
            </script>
            <div class="clearfix"> </div>
            <div class="b-bottom">

                           </div>
        </div>
        <!--//banner-->
        <!--/top-news-->
        <div class="top-news">
            <div class="top-inner">
                @foreach($pagination as $post)
                <div class="col-md-6 top-text">
                    <a href="{{route('single_post',['id'=>$post['id']])}}"><img src="{{asset($post['picture'])}}" class="img-responsive" alt="{{$post['alt']}}"></a>
                    <h5 class="top"><a href="{{route('single_post',['id' => $post['id'],'user_id'=>isset(session('user')->UserId)?session('user')->UserId:null])}}">{{$post['headline']}}</a></h5>
                    <p>{{str_limit($post['text'],240)}}</p>
                    <p>{{"On ".date('M d',strtotime($post['date_published']))}}<a class="span_link" href="{{route('single_post',['id'=>$post['id']])}}"><span class="glyphicon glyphicon-circle-arrow-right"></span></a></p>
                </div>
                @endforeach
            </div>
            <div class="clearfix"> </div>
        </div>
            <div class="pagination_center">
                {{$pagination->links()}}
            </div>

    </div>

    <!--//banner-section-->
    <div class="banner-right-text">
        <h3 class="tittle">Highlights  <i class="glyphicon glyphicon-facetime-video"></i></h3>
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
                    <h4 class="tittle" style="margin-top: 65px;">Most Viewed  <i class="glyphicon glyphicon-eye-open"></i></h4>
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
                        <a href="{{route('single_post',['id'=>$post['id']])}}"><img src="{{asset($post['picture'])}}" class="img-responsive" alt=""></a>
                        <h5 class="top"><a href="{{asset('/post/'.$post['id'])}}">{{$post['headline']}}</a></h5>
                        <p>{{str_limit($post['text'],240)}}</p>
                        <p>{{"On ".date('M d',strtotime($post['date_published']))}}<a class="span_link" href="{{route('single_post',['id'=>$post['id']])}}"><span class="glyphicon glyphicon-circle-arrow-right"></span></a></p>
                        @endforeach
                    </div>
                </div>
                <div class="pagination_center">
{{--                {{$post_game->links()}}--}}
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"> </div>
@endsection
