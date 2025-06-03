@extends('layouts.app')
@section('head')
@endsection
@section('content')

	@php
		if(setting_item('property_enable_review')){
			$reviewData = Modules\Review\Models\Review::getTotalViewAndRateAvg($row->id, 'property');
			$review_meta = Modules\Review\Models\Review::getReviewMetaAvg($row->id, 'property');
		}
	@endphp

    <!-- Listing Single Property -->
    <section class="listing-title-area pb50">
        <div class="container">

            <div class="row mb30">
                <div class="col-xl-7">
                    <div class="single_property_title mt30-767">
                        <div class="media">
                            @if($row->vendor)
                                <a href="{{$row->vendor->profile_url}}" >  <div class="badge_icon_v3_detail mr-3"
                                                                                style="background-image: url({{
                                                                                $row->vendor->getAvatarUrl() }})"
                                                                                title="{{
                                 $row->vendor->getDisplayName() }}">
                                    </div>
                                </a>

                            @endif
                            <div class="media-body mt20">
                                <h2 class="mt-0">{{ $row->title }}</h2>
                                <ul class="mb0 agency_profile_contact">
                                    @if($row->phone)
                                        <li class="list-inline-item"><a href="tel:{{ $row->phone }}"><span class="flaticon-phone"></span> {{ $row->phone }}</a></li>
                                    @endif
                                    @if($row->location)
                                        <li class="list-inline-item"><a href="{{ $row->location->getDetailUrl() }}"><span class="flaticon-pin"></span> {{ $row->location->name }}</a></li>
                                    @endif
                                    <li class="list-inline-item sspd_review ">
                                        <ul class="mb0">
                                            @if(setting_item('property_enable_review') and $reviewData['total_review'] > 0)
                                                @for( $i = 0 ; $i < 5 ; $i++ )
                                                    @if($i < (int)$reviewData['sbc_total'])
                                                        <li class="list-inline-item"><i class="fa fa-star color-black"></i></li>
                                                    @else
                                                        <li class="list-inline-item"><i class="fa fa-star-o color-black"></i></li>
                                                    @endif
                                                @endfor
                                                <li class="list-inline-item ">(
                                                    @if($reviewData['total_review'] > 1)
                                                        {{ __(":number Reviews",["number"=>$reviewData['total_review'] ]) }}
                                                    @else
                                                        {{ __(":number Review",["number"=>$reviewData['total_review'] ]) }}
                                                    @endif
                                                    )
                                                </li>
                                            @endif
                                        </ul>
                                    </li>
                                        @if($row->price_range)
                                            <li class="list-inline-item ml20">
                                                <a class="price_range" href="#">@for($i=0; $i < $row->price_range; $i++)$@endfor</a>
                                            </li>
                                        @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="dn db-lg">
                        <div id="main2">
                            <span id="open2" class="fa fa-filter filter_open_btn single_proprety_v3"> {{ __('Show Filter') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5">
                    <div class="single_property_social_share">
                        <div class="spss style2 mt30 float-left fn-lg">
                            <ul class="mb0">
                                <li class="list-inline-item icon social-share"><a href="#"><span class="flaticon-upload"></span></a>
                                    <ul class="share-wrapper">
                                        <li>
                                            <a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u={{$row->getDetailUrl()}}&amp;title={{$translation->title}}" target="_blank" rel="noopener" original-title="{{__("Facebook")}}">
                                                <i class="fa fa-facebook fa-lg"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="twitter" href="https://twitter.com/share?url={{$row->getDetailUrl()}}&amp;title={{$translation->title}}" target="_blank" rel="noopener" original-title="{{__("Twitter")}}">
                                                <i class="fa fa-twitter fa-lg"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="list-inline-item"><a class="" href="#">{{ __("Share") }}</a></li>
                                <li class="list-inline-item icon">
                                    <a href="#" class="service-wishlist {{$row->isWishList()}}" data-id="{{$row->id}}" data-type="{{$row->type}}">
                                        <span class="fa fa-heart-o"></span>
                                    </a>
                                </li>
                                <li class="list-inline-item"><a class="" href="#">{{ $row->isWishList() ? __("Saved") :__("Save") }}</a></li>
                            </ul>
                        </div>
                        @if(setting_item('property_enable_review'))
                            <div class="price  mt25 float-right fn-lg">
                                <a href="#bc-reviews" class="btn btn-thm spr_btn">{{ __("Submit Review") }}</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @php $banner_images = $row->getGallery(); @endphp
            @if($banner_images)
            <div class="row detail_v3_images">
                <div class="col-md-7 col-lg-8">
                    <div class="row">
                        <div class="col-lg-12 pl0 pr0 pl15-767 pr15-767">
                            <div class="spls_style_two mb30-767">
                                <a class="popup-img" href="{{$banner_images[0]['large']}}"><div
                                        class="main_background_img bg_img_st" style="background-image: url({{
                                        $banner_images[0]['large']  }})"></div> </a>
                            </div>
                        </div>
                    </div>
                </div>

              @php
                array_shift($banner_images);
              @endphp

                <div class="col-md-5 col-lg-4">
                    <div class="row">
                        @foreach($banner_images as $key => $banner_image)

                            <div class="col-sm-4 col-md-6 col-lg-6 pr5 pr15-767">
                                <div class="spls_style_two mb10">
                                    <a class="popup-img" href="{{$banner_image['large']}}"><div class="gallery_img_bg
                                    bg_img_st" style="background-image: url({{$banner_image['large']}})"></div>
                                    </a>
                                    @if($key==5)
                                        @php $total_remain = count($banner_images) - ($key+1)  @endphp
                                        <div class="overlay popup-img">
                                            <h3 class="title">+{{ $total_remain }}</h3>
                                        </div>
                                        @break
                                    @endif
                                </div>

                            </div>


                                @endforeach


                    </div>
                </div>
            </div>
                @endif
        </div>
    </section>


    <section class="our-agent-single pb30-991">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="row">
                        <div class="col-lg-12 pl0 pr0 pl15-767 pr15-767">
                            <div class="listing_single_description mb60">
                                <h4 class="mb30">{{ __("Overview") }}</h4>
                                <div class="overview">
                                    {!! clean($row->content) !!}
                                </div>
                            </div>
                        </div>

                        @include('Property::frontend.layouts.details.property_features')

                        

                        @include('Property::frontend.layouts.details.property-faq')

                        @include('Property::frontend.layouts.details.property-video')

                        @if(setting_item('property_enable_review'))
                            <div id="reviews">
                                @include('Review::frontend.list-review', ['review_service_id' => $row['id'], 'review_service_type' => 'property', 'reviewData' => $reviewData])
                            </div>
                        @endif

                    </div>
                </div>

                <div class="col-lg-4 col-xl-4">
                    <div class="listing_single_sidebar">

                        @include('Property::frontend.layouts.details.property-location')

                        @if($row->enable_open_hours)
                            <div class="sidebar_opening_hour_widget pb20">
                                <h4 class="title mb15">{{ __("Hours") }}
                                    @if($row->is_open)
                                        <small class="text-thm2 float-right">{{ __("Now Open") }}</small>
                                    @else
                                        <small class="text-danger float-right">{{ __("Closed") }}</small>
                                    @endif
                                </h4>
                                <ul class="list_details mb0">
                                    @foreach($row->open_hours as $key => $val)
                                        @switch($key)
                                            @case(1)
                                            @if(!empty($val['enable']))
                                                <li>{{ __("Monday") }} <span class="float-right">{{ date('h:i a', strtotime($val['from'])) }} – {{ date('h:i a', strtotime($val['to'])) }}</span></li>
                                            @endif
                                            @break
                                            @case(2)
                                            @if(!empty($val['enable']))
                                                <li>{{ __("Tuesday") }} <span class="float-right">{{ date('h:i a', strtotime($val['from'])) }} – {{ date('h:i a', strtotime($val['to'])) }}</span></li>
                                            @endif
                                            @break
                                            @case(3)
                                            @if(!empty($val['enable']))
                                                <li>{{ __("Wednesday") }} <span class="float-right">{{ date('h:i a', strtotime($val['from'])) }} – {{ date('h:i a', strtotime($val['to'])) }}</span></li>
                                            @endif
                                            @break
                                            @case(4)
                                            @if(!empty($val['enable']))
                                                <li>{{ __("Thursday") }} <span class="float-right">{{ date('h:i a', strtotime($val['from'])) }} – {{ date('h:i a', strtotime($val['to'])) }}</span></li>
                                            @endif
                                            @break
                                            @case(5)
                                            @if(!empty($val['enable']))
                                                <li>{{ __("Friday") }} <span class="float-right">{{ date('h:i a', strtotime($val['from'])) }} – {{ date('h:i a', strtotime($val['to'])) }}</span></li>
                                            @endif
                                            @break
                                            @case(6)
                                            @if(!empty($val['enable']))
                                                <li>{{ __("Saturday") }} <span class="float-right">{{ date('h:i a', strtotime($val['from'])) }} – {{ date('h:i a', strtotime($val['to'])) }}</span></li>
                                            @endif
                                            @break
                                            @case(7)
                                            @if(!empty($val['enable']))
                                                <li>{{ __("Sunday") }} <span class="float-right">{{ date('h:i a', strtotime($val['from'])) }} – {{ date('h:i a', strtotime($val['to'])) }}</span></li>
                                            @endif
                                            @break
                                        @endswitch
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(!empty($row->categories) && count($row->categories) > 0)
                            <div class="sidebar_category_widget">
                                <h4 class="title mb30">{{ __("Categories") }}</h4>
                                <ul class="mb0">
                                    @foreach($row->categories as $key =>  $category)
                                        <li class="{{ (count($row->categories) - 1) != $key ? 'mb25' : '' }}"><a href="{{ $category->getDetailUrl() }}">@if($category->image_id)<img class="mr5" src="{{ \Modules\Media\Helpers\FileHelper::url($category->image_id) }}" alt="{{ $category->name }}">@endif {{ $category->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(!empty($row->price) or !empty($row->price_from))
                            <div class="sidebar_pricing_widget">
                                <h4 class="title mb20">
                                    @if(empty($row->price))
                                        {{ __("Price") }}
                                    @else
                                        {{ __("Price Range") }}
                                    @endif
                                </h4>
                                <ul class="mb0">
                                    <li><a href="#">{{ __("Price") }}: <span class="float-right heading-color">{{ $row->display_price_single }}</span></a></li>
                                </ul>
                            </div>
                        @endif

                        <!--@if(!empty($row->user))-->
                        <!--    <div class="sidebar_author_widget">-->
                        <!--        <h4 class="title mb25">{{ __("Author") }}</h4>-->
                        <!--        <div class="media">-->
                        <!--            <a target="_blank" href="{{$row->user->profile_url}}">-->
                        <!--                <img class="mr-3 avatar" src="{{ $row->user->getAvatarUrl() }}" alt="author.png">-->
                        <!--            </a>-->
                        <!--            <div class="media-body">-->
                        <!--                <h5 class="mt15 mb0">-->
                        <!--                    <a target="_blank" href="{{$row->user->profile_url}}">{{ $row->user->getDisplayName() }}</a>-->
                        <!--                </h5>-->
                        <!--                <p class="mb0">{{ $row->user->job }}</p>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--@endif-->

                        <div class="sidebar_contact_business_widget">
                            <h4 class="title mb25">{{ __("Contact Business") }}</h4>
                            <form action="{{ route('vendor.contact') }}" method="POST" class="agent_contact_form">
                                @csrf
                                <ul class="business_contact mb0">
                                    <li class="search_area">
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control" id="exampleInputName1" placeholder="{{ __("Name") }}">
                                        </div>
                                    </li>
                                    <li class="search_area">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control" id="exampleInputEmail" placeholder="{{ __("Email") }}">
                                        </div>
                                    </li>
                                    <li class="search_area">
                                        <div class="form-group">
                                            <input type="number" name="phone" class="form-control" id="exampleInputName2" placeholder="{{ __("Phone") }}">
                                        </div>
                                    </li>
                                    <li class="search_area">
                                        <div class="form-group">
                                            <textarea id="form_message" name="message" class="form-control" rows="5" required="required" placeholder="{{ __("Message") }}"></textarea>
                                        </div>
                                    </li>
                                    <li>
                                        <input type="hidden" name="vendor_id" value="{{ !empty($row->user) ? $row->user->id : 0 }}">
                                        <input type="hidden" name="object_id" value="{{ $row->id }}">
                                        <input type="hidden" name="object_model" value="property">
                                    </li>
                                    <li>
                                        <div class="search_option_button">
                                            <button type="submit" class="btn btn-block btn-thm h55"><span class="text">{{ __("Send Message") }}</span><i class="fa fa-spin fa-spinner"></i></button>
                                        </div>
                                    </li>
                                </ul>
                                <div class="form-mess"></div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('Property::frontend.layouts.details.property-related')

@endsection
@section('footer')
	{!! App\Helpers\MapEngine::scripts() !!}
	<script>
        jQuery(function ($) {
            new BravoMapEngine('map-canvas', {
                fitBounds: true,
                center: [{{$row->map_lat ?? "51.505"}}, {{$row->map_lng ?? "-0.09"}}],
                zoom:{{$row->map_zoom ?? "8"}},
                ready: function (engineMap) {
					@if($row->map_lat && $row->map_lng)
                    engineMap.addMarker([{{$row->map_lat}}, {{$row->map_lng}}], {
                        icon_options: {}
                    });
					@endif
                    engineMap.on('click', function (dataLatLng) {
                        engineMap.clearMarkers();
                        engineMap.addMarker(dataLatLng, {
                            icon_options: {}
                        });
                        $("input[name=map_lat]").attr("value", dataLatLng[0]);
                        $("input[name=map_lng]").attr("value", dataLatLng[1]);
                    });
                    engineMap.on('zoom_changed', function (zoom) {
                        $("input[name=map_zoom]").attr("value", zoom);
                    });
                    engineMap.searchBox($('.bc_searchbox'), function (dataLatLng) {
                        engineMap.clearMarkers();
                        engineMap.addMarker(dataLatLng, {
                            icon_options: {}
                        });
                        $("input[name=map_lat]").attr("value", dataLatLng[0]);
                        $("input[name=map_lng]").attr("value", dataLatLng[1]);
                    });
                }
            });

            if ($(".popup-img-review").length > 0) {
                $(".review_upload_photo_list").each(function () {
                    $(this).find('.popup-img-review').magnificPopup({
                        type: "image",
                        gallery: {
                            enabled: true,
                        }
                    });
                });
            }
        })
	</script>
@endsection
