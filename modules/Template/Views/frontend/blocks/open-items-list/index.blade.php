@if($list_item)
    <section class="property-city bgc-f4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="main-title text-center">
                        @if(!empty($title))
                            <h2>{{$title}}</h2>
                        @endif
                        @if(!empty($sub_title))
                            <p>{{$sub_title}}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="feature_place_home3_slider">
                        @foreach($list_item as $k=>$item)
                            <div class="item">
                                <div class="properti_city home3">
                                    <a href="{{$item['url']??'#'}}" target="_blank">
                                        <div class="thumb">
                                            <img class="img-fluid w100" src="{{get_file_url($item['background'] ?? "","full")}}" alt="{{$item['name']}}">
                                        </div>
                                        <div class="overlay">
                                            <div class="details">
                                                <h4>{{$item['name']}}</h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
