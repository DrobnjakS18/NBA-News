@extends('layouts.frontEnd')
@section('title')
    About
@endsection
@section('about')

    <div id="autor">
        <div id="autor_centar">
            <h3 class="tittle">About <i class="glyphicon glyphicon-user"></i></h3>
            <div id="autor_slika">
                <img src="{{asset('images/IMG-20190208-WA0000.png')}}" alt="autor"/>
            </div>
            <div id="tekst_autor">
                <p>
                    My name is Stefan Drobnjak.This is my first website in Laravel.Hope you enjoy it.
                </p>
            </div>
        </div>
    </div>
    @endsection