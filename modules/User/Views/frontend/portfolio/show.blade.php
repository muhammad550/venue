@extends('Layout::app')
@section('head')
<link rel="stylesheet" href="{{ asset('dist/frontend/css/slick.css') }}">
<style>
    /* Profile card styles */
    .photographer-card {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        margin-bottom: 30px;
        overflow: hidden;
    }
    
    /* Gallery slider styles */
    .gallery-slider {
        margin-bottom: 15px;
    }
    
    .gallery-slider-item {
        position: relative;
        height: 220px;
        overflow: hidden;
    }
    
    .gallery-slider-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .gallery-slider-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.3);
        opacity: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: opacity 0.3s;
    }
    
    .gallery-slider-item:hover .gallery-slider-overlay {
        opacity: 1;
    }
    
    .gallery-slider-icon {
        color: white;
        font-size: 24px;
    }
    
    .slick-prev, .slick-next {
        z-index: 1;
        width: 30px;
        height: 30px;
        background: rgba(255,255,255,0.9);
        border-radius: 50%;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    .slick-prev:before, .slick-next:before {
        color: #222;
        font-size: 16px;
    }
    
    .slick-prev {
        left: 10px;
    }
    
    .slick-next {
        right: 10px;
    }
    
    /* Profile info styles */
    .profile-info {
        padding: 15px;
    }
    
    .profile-header {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }
    
    .profile-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        overflow: hidden;
        margin-right: 15px;
    }
    
    .profile-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .profile-name {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 2px;
    }
    
    .profile-title {
        font-size: 14px;
        color: #666;
        margin-bottom: 5px;
    }
    
    .profile-rating {
        display: flex;
        align-items: center;
    }
    
    .rating-stars {
        color: #ffb100;
        margin-right: 5px;
    }
    
    .profile-stats {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-top: 1px solid #eee;
        margin-top: 10px;
    }
    
    .stat-item {
        text-align: center;
        flex: 1;
    }
    
    .stat-value {
        font-weight: 600;
        font-size: 16px;
    }
    
    .stat-label {
        font-size: 12px;
        color: #666;
    }
    
    .profile-actions {
        margin-top: 15px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row pt-5">
        <div class="col-lg-12">
            <div class="breadcrumb_content style2">
                <h2 class="breadcrumb_title">Service Providers</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Service Providers</li>
                </ol>
            </div>
        </div>
    </div>
    
    <div class="row">
        <!-- Photographer Card 1 -->
        <div class="col-lg-3 col-md-6">
            <div class="photographer-card">
                <!-- Gallery Slider -->
                <div class="gallery-slider">
                    @php
                        use Modules\Media\Models\MediaFile;
                        // Using property gallery images from the system
                        $galleryImages1 = [
                            ['url' => get_file_url(MediaFile::findMediaByName("property-gallery-1")->id), 'alt' => 'Wedding photography'],
                            ['url' => get_file_url(MediaFile::findMediaByName("property-gallery-2")->id), 'alt' => 'Portrait photography'],
                            ['url' => get_file_url(MediaFile::findMediaByName("property-gallery-3")->id), 'alt' => 'Event photography'],
                        ];
                    @endphp
                    
                    @foreach($galleryImages1 as $image)
                    <div>
                        <div class="gallery-slider-item">
                            <img src="{{ $image['url'] }}" alt="{{ $image['alt'] }}">
                            <a href="{{ $image['url'] }}" class="gallery-slider-overlay popup-img">
                                <i class="fa fa-search-plus gallery-slider-icon"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Profile Info -->
                <div class="profile-info">
                    <div class="profile-header">
                        <div class="profile-avatar">
                            <img src="{{ get_file_url(MediaFile::findMediaByName('avatar')->id) }}" alt="John Doe">
                        </div>
                        <div>
                            <h3 class="profile-name">John Doe</h3>
                            <p class="profile-title">Wedding Photographer</p>
                            <div class="profile-rating">
                                <div class="rating-stars">★★★★★</div>
                                <span>4.9 (42)</span>
                            </div>
                        </div>
                    </div>
                    
                    <p class="text-muted">I will photograph professional lifestyle images of your product</p>
                    
                    <div class="profile-stats">
                        <div class="stat-item">
                            <div class="stat-value">127</div>
                            <div class="stat-label">Orders</div>
                        </div>
                        <!-- <div class="stat-item">
                            <div class="stat-value">1h</div>
                            <div class="stat-label">Response</div>
                        </div> -->
                        <div class="stat-item">
                            <div class="stat-value">$10</div>
                            <div class="stat-label">Starting at</div>
                        </div>
                    </div>
                    
                    <div class="profile-actions">
                        <a href="{{ url('photographer/john-doe') }}" class="btn btn-primary btn-block">View Profile</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Photographer Card 2 -->
        <div class="col-lg-3 col-md-6">
            <div class="photographer-card">
                <!-- Gallery Slider -->
                <div class="gallery-slider">
                    @php
                        // Using different property gallery images for second photographer
                        $galleryImages2 = [
                            ['url' => get_file_url(MediaFile::findMediaByName("property-gallery-4")->id), 'alt' => 'Food photography'],
                            ['url' => get_file_url(MediaFile::findMediaByName("property-gallery-5")->id), 'alt' => 'Food photography'],
                            ['url' => get_file_url(MediaFile::findMediaByName("property-gallery-6")->id), 'alt' => 'Food photography'],
                        ];
                    @endphp
                    
                    @foreach($galleryImages2 as $image)
                    <div>
                        <div class="gallery-slider-item">
                            <img src="{{ $image['url'] }}" alt="{{ $image['alt'] }}">
                            <a href="{{ $image['url'] }}" class="gallery-slider-overlay popup-img">
                                <i class="fa fa-search-plus gallery-slider-icon"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Profile Info -->
                <div class="profile-info">
                    <div class="profile-header">
                        <div class="profile-avatar">
                            <img src="{{ get_file_url(MediaFile::findMediaByName('avatar-2')->id) }}" alt="Jane Smith">
                        </div>
                        <div>
                            <h3 class="profile-name">Jane Smith</h3>
                            <p class="profile-title">Food Photographer</p>
                            <div class="profile-rating">
                                <div class="rating-stars">★★★★★</div>
                                <span>5.0 (20)</span>
                            </div>
                        </div>
                    </div>
                    
                    <p class="text-muted">I will cook, shoot amazing food photography, recipe cooking videos</p>
                    
                    <div class="profile-stats">
                        <div class="stat-item">
                            <div class="stat-value">89</div>
                            <div class="stat-label">Orders</div>
                        </div>
                        <!-- <div class="stat-item">
                            <div class="stat-value">2h</div>
                            <div class="stat-label">Response</div>
                        </div> -->
                        <div class="stat-item">
                            <div class="stat-value">$100</div>
                            <div class="stat-label">Starting at</div>
                        </div>
                    </div>
                    
                    <div class="profile-actions">
                        <a href="{{ url('photographer/jane-smith') }}" class="btn btn-primary btn-block">View Profile</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Photographer Card 3 -->
        <div class="col-lg-3 col-md-6">
            <div class="photographer-card">
                <!-- Gallery Slider -->
                <div class="gallery-slider">
                    @php
                        // Using property images for third photographer
                        $galleryImages3 = [
                            ['url' => get_file_url(MediaFile::findMediaByName("property-1")->id), 'alt' => 'Event photography'],
                            ['url' => get_file_url(MediaFile::findMediaByName("property-2")->id), 'alt' => 'Event photography'],
                            ['url' => get_file_url(MediaFile::findMediaByName("property-3")->id), 'alt' => 'Event photography'],
                        ];
                    @endphp
                    
                    @foreach($galleryImages3 as $image)
                    <div>
                        <div class="gallery-slider-item">
                            <img src="{{ $image['url'] }}" alt="{{ $image['alt'] }}">
                            <a href="{{ $image['url'] }}" class="gallery-slider-overlay popup-img">
                                <i class="fa fa-search-plus gallery-slider-icon"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Profile Info -->
                <div class="profile-info">
                    <div class="profile-header">
                        <div class="profile-avatar">
                            <img src="{{ get_file_url(MediaFile::findMediaByName('avatar-3')->id) }}" alt="Sven">
                        </div>
                        <div>
                            <h3 class="profile-name">Sven</h3>
                            <p class="profile-title">Event Photographer</p>
                            <div class="profile-rating">
                                <div class="rating-stars">★★★★★</div>
                                <span>5.0 (9)</span>
                            </div>
                        </div>
                    </div>
                    
                    <p class="text-muted">I will photograph events, real estate and portraits in social</p>
                    
                    <div class="profile-stats">
                        <div class="stat-item">
                            <div class="stat-value">45</div>
                            <div class="stat-label">Orders</div>
                        </div>
                        <!-- <div class="stat-item">
                            <div class="stat-value">3h</div>
                            <div class="stat-label">Response</div>
                        </div> -->
                        <div class="stat-item">
                            <div class="stat-value">$75</div>
                            <div class="stat-label">Starting at</div>
                        </div>
                    </div>
                    
                    <div class="profile-actions">
                        <a href="{{ url('photographer/sven') }}" class="btn btn-primary btn-block">View Profile</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="photographer-card">
                <!-- Gallery Slider -->
                <div class="gallery-slider">
                    @php
                        // Using property images for third photographer
                        $galleryImages3 = [
                            ['url' => get_file_url(MediaFile::findMediaByName("property-1")->id), 'alt' => 'Event photography'],
                            ['url' => get_file_url(MediaFile::findMediaByName("property-2")->id), 'alt' => 'Event photography'],
                            ['url' => get_file_url(MediaFile::findMediaByName("property-3")->id), 'alt' => 'Event photography'],
                        ];
                    @endphp
                    
                    @foreach($galleryImages3 as $image)
                    <div>
                        <div class="gallery-slider-item">
                            <img src="{{ $image['url'] }}" alt="{{ $image['alt'] }}">
                            <a href="{{ $image['url'] }}" class="gallery-slider-overlay popup-img">
                                <i class="fa fa-search-plus gallery-slider-icon"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Profile Info -->
                <div class="profile-info">
                    <div class="profile-header">
                        <div class="profile-avatar">
                            <img src="{{ get_file_url(MediaFile::findMediaByName('avatar-3')->id) }}" alt="Sven">
                        </div>
                        <div>
                            <h3 class="profile-name">Sven</h3>
                            <p class="profile-title">Event Photographer</p>
                            <div class="profile-rating">
                                <div class="rating-stars">★★★★★</div>
                                <span>5.0 (9)</span>
                            </div>
                        </div>
                    </div>
                    
                    <p class="text-muted">I will photograph events, real estate and portraits in social</p>
                    
                    <div class="profile-stats">
                        <div class="stat-item">
                            <div class="stat-value">45</div>
                            <div class="stat-label">Orders</div>
                        </div>
                        <!-- <div class="stat-item">
                            <div class="stat-value">3h</div>
                            <div class="stat-label">Response</div>
                        </div> -->
                        <div class="stat-item">
                            <div class="stat-value">$200</div>
                            <div class="stat-label">Starting at</div>
                        </div>
                    </div>
                    
                    <div class="profile-actions">
                        <a href="{{ url('photographer/sven') }}" class="btn btn-primary btn-block">View Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
<script src="{{ asset('dist/frontend/js/slick.min.js') }}"></script>
<script>
    $(document).ready(function() {
        // Initialize slick slider for each photographer's gallery
        $('.gallery-slider').slick({
            dots: true,
            infinite: true,
            speed: 500,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            arrows: true
        });
        
        // Initialize popup gallery (if you have a lightbox plugin)
        // This is just a placeholder - you'll need to use your actual lightbox plugin
        if ($.fn.magnificPopup) {
            $('.popup-img').magnificPopup({
                type: 'image',
                gallery: {
                    enabled: true
                }
            });
        }
    });
</script>
@endsection
