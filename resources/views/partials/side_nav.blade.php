 <div class="full">
<div class="col-md-3 top-nav">
    <div class="logo">
        <a href="/"><h1>NBA NEWS</h1>
            <p>National Basketball Association</p>
        </a>

    </div>
    <div class="top-menu">
        <span class="menu"> </span>

        <ul class="cl-effect-16">
            @foreach($meni as $link)
            <li><a href="{{asset($link->nav)}}" data-hover="HOME">{{$link->name}}</a></li>
            @endforeach
        </ul>
        <!-- script-for-nav -->
        <script>
            $( "span.menu" ).click(function() {
                $( ".top-menu ul" ).slideToggle(300, function() {
                    // Animation complete.
                });
            });
        </script>
        <!-- script-for-nav -->
        <ul class="side-icons">
            <li><a class="fb" href="https://www.facebook.com"></a></li>
            <li><a class="twitt" href="https://twitter.com"></a></li>
            <li><a class="goog" href="https://www.google.com"></a></li>
            <li><a class="drib" href="https://dribbble.com"></a></li>
        </ul>
    </div>
</div>
    <div class="col-md-9 main">
