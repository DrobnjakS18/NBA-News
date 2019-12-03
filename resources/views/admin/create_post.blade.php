@extends('layouts.frontEnd')

@section('content')
    <h3 class="tittle">Insert post </h3>
    <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        Title
        <input type="text" name="title" id="title" />
        <br>
        Image
        <input type="file" name="picture" id="picture"/>
        Text
        <textarea id="text" name="text"></textarea>
        <br>
        Category
        <select name="catId">
            <option value="0">Choose</option>
            @foreach($category as $cat)
                <option value="{{$cat->id_cat}}">{{$cat->name}}</option>
            @endforeach
        </select>
        <br>
        <input type="submit" value="Insert picture" name="insert_pic"/>
    </form>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
