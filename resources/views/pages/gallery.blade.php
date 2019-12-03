@extends('layouts.frontEnd')
@section('title')
    Gallery
@endsection
@section('header')
    @parent
    <!--Custom-Theme-files-->
@endsection
@section('content')
    <!--grids-->
    <div class="gallery-section">
        <h3 class="tittle">In Game <i class="glyphicon glyphicon-camera"></i></h3>
        <div class="categorie-grids cs-style-1">

            @foreach($gallery as $picture)
                <div class="col-md-4 cate-grid grid">
                    <figure>
                        <img src="{{asset($picture->picture_path)}}" alt="{{$picture->alt}}" width="600" height="378">
                        <figcaption>
                            <h3>{{$picture->title}}</h3>
                            <a class="example-image-link" href="{{asset($picture->picture_path)}}" data-lightbox="example-1" data-title="Interior Design">VIEW</a>
                        </figcaption>
                    </figure>
                </div>
            @endforeach

            <script src="js/lightbox.js"></script>
            <div class="clearfix"></div>
{{--            {{$gallery->links()}}--}}
        </div>
    </div>
    <div class="clearfix"> </div>
@endsection

