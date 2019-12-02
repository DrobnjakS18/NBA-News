@extends('layouts.frontEnd')

@section('title')
    Search
    @endsection

@section('search')
    <div class="card-group">
        @if(isset($search_found))
            <div class="card text-center">
                <div class="card-header">
                    <h3 class="card-title">Results</h3>
                </div>
            </div>
        @foreach($search_found as $found)

                <div class="search_block">
                    <div class="gsc-thumbnail-inside">
                        <div class="gs-title"><a href="{{route('single_post',['id' =>$found['id']])}}">{{$found['headline']}}</a>
                        </div>
                    </div>
                    <div class="gsc-url-top">
                    </div><table class="gsc-table-result"><tbody><tr><td class="gsc-table-cell-thumbnail gsc-thumbnail" style="">
                                <div class="gs-image-box gs-web-image-box gs-web-image-box-landscape">
                                    <a class="gs-image" href="{{route('single_post',['id' =>$found['id']])}}">
                                        <img class="gs-image" src="{{asset($found['picture'])}}" width="300" height="188"/></a></div></td><td class="gsc-table-cell-snippet-close"><div class="gs-title gsc-table-cell-thumbnail gsc-thumbnail-left"><a></a>
                                </div>
                                <div  class="ltr">{{str_limit($found['text'],240)}}</div>
                                <div class="gsc-url-bottom">
                                </div>
                                <div class="gs-richsnippet-box" style="display: none;"></div>
                                <div class="gs-per-result-labels" ><a href="{{route('single_post',['id' =>$found['id']])}}" class="btn btn-success btn-sm">View Post  </a></div></td></tr></tbody></table>
                </div>

        @endforeach
            <div class="pagination_center">
{{--                {{$search_found->appends([ 'search_value' => 'zion' , 'search' => 'Submit'])->links()}}--}}
            </div>
            @else
            <div class="spacing">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">{{$search_not_found}}</h5>
                    <p class="card-text">No resaults found for your current search</p>
                    <a href="{{asset('/')}}" class="btn btn-success btn-sm">Home Page</a>
                </div>
            </div>
            </div>
            @endif

    </div>
    @endsection
