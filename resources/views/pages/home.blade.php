@extends('layouts.frontEnd')
@section('title')
    Home
    @endsection
@section('home')
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
            <div class="clearfix"> </div>
            <div class="b-bottom"></div>
        </div>
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
    @include('partials.side_news')
        <div class="clearfix"> </div>
@endsection

@section('scripts')
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
    @endsection
