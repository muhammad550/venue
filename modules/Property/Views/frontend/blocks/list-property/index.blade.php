<section id="feature-property" class="feature-property  border-bottom">

    <div class="container {{(!empty($display_type) && $display_type == 1) ? '' : 'ovh'}}">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-title text-center mb40">
                    @if($title)
                    <h2>{{$title}}</h2>
                    @endif
                    @if($desc)
                    <p>{{$desc}}</p>
                    @endif
                </div>
            </div>
            <div class="col-lg-12">
                <div class="feature_property_slider {{(!empty($display_type) && $display_type == 1) ? 'feature_property_home3_slider' : 'popular_listing_slider1'}} ">
                    @foreach($rows as $row)
                        <div class="item">
                            @include('Property::frontend.layouts.search.loop.loop-gird')
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
