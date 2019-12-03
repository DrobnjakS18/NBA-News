@extends('layouts.frontEnd')
@section('title')
    Contact
@endsection
@section('content')
    <div class="contact">
        <h3 class="tittle">Find Us <i class="glyphicon glyphicon-map-marker"></i></h3>
        <div class="contact-left">
            <iframe src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Purwokerto,+Central+Java,+Indonesia&amp;aq=0&amp;oq=purwo&amp;sll=37.0625,-95.677068&amp;sspn=50.291089,104.238281&amp;ie=UTF8&amp;hq=&amp;hnear=Purwokerto,+Banyumas,+Central+Java,+Indonesia&amp;ll=-7.431391,109.24783&amp;spn=0.031022,0.050898&amp;t=m&amp;z=14&amp;output=embed"></iframe>

        </div>
        <div class="contact-right">
            <p class="phn">+9100 2481 5842</p>
            <p class="phn-bottom">4578 Marmora
                <span>Road, Glasgow D04 89GR</span></p>
            <p class="lom">Nullam ac urna velit. Pellentesque in arcu tortor.
                Pellentesque nec est et elit varius pulvinar eget vitae sapien.
                Aenean vehicula accumsan gravida.</p>
        </div>
        <div class="clearfix"> </div>
        <div class="contact-left1">
            <h3>Contact Us With <span>Any questions</span></h3>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('email_success'))
                <div class="alert alert-success">
                    {{session('email_success')}}
                </div>
                @endif

            @if(session('email_error'))
                <div class="alert alert-danger">
                    {{session('email_error')}}
                </div>
            @endif
            <div class="in-left">
                <form action="{{asset('/contact')}}" method="POST">
                    @csrf
                    <p class="your-para">Your Name :</p>
                    <input type="text" name="name">
                    <p class="your-para">Your Mail :</p>
                    <input type="text" name="mail">
                    <p class="your-para">Subject:</p>
                    <input type="text" name="subject">

            </div>
            <div class="in-right">

                    <textarea cols="77" rows="6" name="message"></textarea>
                    <input type="submit" value="Submit" name="sub_mail">
                </form>
            </div>

            <div class="clearfix"> </div>
        </div>
        <div class="contact-right1">
            <h3><span>Social Websites</span></h3>
            <h4>Nullam ac urna velit pellentesque in <label>arcu tortor
                    Pellentesque nec</label></h4>
            <p>Nullam ac urna velit. Pellentesque in arcu tortor.
                Pellentesque nec est et elit varius pulvinar eget vitae sapien.
                Aenean vehicula accumsan gravida. Cum sociis natoque penatibus
                et magnis dis parturient montes, nascetur ridiculus mus. Phasellus
                et lectus in urna consequat consectetur ut eget risus.</p>
            <ul class=" side-icons con">
                <li><a class="fb" href="#"></a></li>
                <li><a class="twitt" href="#"></a></li>
                <li><a class="goog" href="#"></a></li>
                <li><a class="drib" href="#"></a></li>
            </ul>
        </div>
        <div class="clearfix"> </div>
        <!-- //contact -->
    </div>
    <div class="clearfix"> </div>
@endsection
