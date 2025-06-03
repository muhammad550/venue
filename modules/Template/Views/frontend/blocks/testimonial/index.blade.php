@if ($list_item)
<!-- Our Testimonials -->
@if(!empty($layout) && $layout == 'style_2')
    <section id="our-testimonials" class="our-testimonials ovh pb70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-title text-center">
                        @if(!empty($title))
                            <h2>{{ $title }}</h2>
                        @endif
                        @if(!empty($sub_title))
                            <p>{{ $sub_title }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="testimonial_slider_home3 testimonial_grid_slider">
                        @foreach ($list_item as $item)
                            <?php $avatar_url = get_file_url($item['avatar'], 'full'); ?>
                            <div class="item">
                                <div class="testimonial_post_home3">
                                    <div class="details">
                                        <ul class="client_review">
                                            @for ($i=1; $i<=$item['number_star']; $i++ )
                                                <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                            @endfor
                                        </ul>
                                        <p>“ {!! clean($item['desc']) !!} “</p>
                                    </div>
                                    <div class="thumb">
                                        <img src="{{$avatar_url}}" alt="{{$item['name']}}">
                                        <h4 class="title">{{$item['name']}} <br><small>{{@$item['career']}}</small></h4>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@else
    <section id="our-testimonials" class="our-testimonials">
        <div class="container ovh max1800">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-title text-center">
                        @if(!empty($title))
                            <h2>{{ $title }}</h2>
                        @endif
                        @if(!empty($sub_title))
                            <p>{{ $sub_title }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="testimonial_slider_home1 testimonial_grid_slider">
                        @foreach ($list_item as $item)
                            <?php $avatar_url = get_file_url($item['avatar'], 'full'); ?>
                            <div class="item">
                                <div class="testimonial_post text-center">
                                    <div class="thumb">
                                        <img src="{{$avatar_url}}" alt="1.png">
                                        <h4 class="title">{{$item['name']}}</h4>
                                        <div class="client-postn">{{@$item['career']}}</div>
                                    </div>
                                    <div class="details">
                                        <div class="icon"><span>“</span></div>
                                        <p>“ {!! clean($item['desc']) !!} “</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

@endif
