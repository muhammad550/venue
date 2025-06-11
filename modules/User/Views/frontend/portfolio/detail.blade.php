@extends('layouts.user')

@section('head')
<link rel="stylesheet" href="{{ asset('dist/frontend/css/slick.css') }}">
<style>
    /* Profile container */
    .profile-container {
        background-color: #fff;
        border-radius: 4px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.04);
        margin-bottom: 30px;
    }

    /* Gallery slider */
    .gallery-slider {
        margin-bottom: 30px;
    }
    
    .gallery-slider .slick-slide {
        padding: 0 5px;
    }
    
    .gallery-slider-item {
        position: relative;
        height: 300px;
        border-radius: 4px;
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
        width: 40px;
        height: 40px;
        background: rgba(255,255,255,0.9);
        border-radius: 50%;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    .slick-prev:before, .slick-next:before {
        color: #222;
        font-size: 20px;
    }
    
    .slick-prev {
        left: 15px;
    }
    
    .slick-next {
        right: 15px;
    }
    
    
    
    /* Profile header */
    .profile-header {
        padding: 24px;
        border-bottom: 1px solid #e4e5e7;
        display: flex;
        flex-wrap: wrap;
    }
    
    /* Profile avatar */
    .profile-avatar {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        overflow: hidden;
        margin-right: 24px;
    }
    .profile-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    /* Profile info */
    .profile-info {
        flex: 1;
    }
    .profile-name {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 4px;
        color: #404145;
    }
    .profile-title {
        font-size: 16px;
        color: #74767e;
        margin-bottom: 12px;
    }
    
    /* Profile stats */
    .profile-stats {
        display: flex;
        margin-bottom: 16px;
        flex-wrap: wrap;
    }
    .stat-item {
        margin-right: 16px;
        display: flex;
        align-items: center;
    }
    .stat-item i {
        color: #ffb33e;
        margin-right: 4px;
    }
    .stat-value {
        font-weight: 600;
        margin-right: 4px;
    }
    .stat-label {
        color: #74767e;
    }
    
    /* Profile actions */
    .profile-actions {
        display: flex;
        margin-top: 16px;
    }
    .btn-contact {
        background-color: #1dbf73;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        font-weight: 600;
        margin-right: 12px;
    }
    .btn-contact:hover {
        background-color: #19a463;
    }
    .btn-save {
        background-color: transparent;
        color: #62646a;
        border: 1px solid #e4e5e7;
        padding: 8px 16px;
        border-radius: 4px;
    }
    .btn-save:hover {
        background-color: #f5f5f5;
    }
    
    /* Profile tabs */
    .profile-tabs {
        display: flex;
        border-bottom: 1px solid #e4e5e7;
    }
    .profile-tab {
        padding: 16px 24px;
        font-weight: 600;
        color: #74767e;
        cursor: pointer;
        border-bottom: 3px solid transparent;
    }
    .profile-tab.active {
        color: #1dbf73;
        border-bottom: 3px solid #1dbf73;
    }
    
    /* Profile content */
    .profile-content {
        padding: 24px;
    }
    
    /* About section */
    .about-section h3 {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 16px;
        color: #404145;
    }
    .about-text {
        color: #62646a;
        line-height: 1.6;
        margin-bottom: 24px;
    }
    
    /* Skills section */
    .skills-section h3 {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 16px;
        color: #404145;
    }
    .skills-list {
        display: flex;
        flex-wrap: wrap;
        margin-bottom: 24px;
    }
    .skill-tag {
        background-color: #efeff0;
        color: #62646a;
        padding: 6px 12px;
        border-radius: 20px;
        margin-right: 8px;
        margin-bottom: 8px;
        font-size: 14px;
    }
    
    /* Languages section */
    .languages-section h3 {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 16px;
        color: #404145;
    }
    .language-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
    }
    .language-name {
        color: #62646a;
    }
    .language-level {
        color: #74767e;
    }
    
    /* Education section */
    .education-section h3 {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 16px;
        color: #404145;
    }
    .education-item {
        margin-bottom: 16px;
    }
    .education-title {
        font-weight: 600;
        color: #404145;
        margin-bottom: 4px;
    }
    .education-details {
        color: #74767e;
        font-size: 14px;
    }
    
    /* Sidebar */
    .profile-sidebar {
        background-color: #fff;
        border-radius: 4px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.04);
        padding: 24px;
    }
    .sidebar-section {
        margin-bottom: 24px;
    }
    .sidebar-title {
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 16px;
        color: #404145;
    }
    .sidebar-content {
        color: #62646a;
    }
    
    /* Reviews section */
    .reviews-section {
        margin-top: 30px;
    }
    .review-item {
        border-bottom: 1px solid #e4e5e7;
        padding-bottom: 24px;
        margin-bottom: 24px;
    }
    .review-header {
        display: flex;
        margin-bottom: 12px;
    }
    .reviewer-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        overflow: hidden;
        margin-right: 16px;
    }
    .reviewer-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .reviewer-info {
        flex: 1;
    }
    .reviewer-name {
        font-weight: 600;
        color: #404145;
        margin-bottom: 4px;
    }
    .review-date {
        color: #74767e;
        font-size: 14px;
    }
    .review-rating {
        color: #ffb33e;
        margin-bottom: 8px;
    }
    .review-content {
        color: #62646a;
        line-height: 1.6;
    }
    
    /* Packages section */
    .packages-section {
        margin-top: 30px;
    }
    .packages-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }
    .package-card {
        flex: 1;
        min-width: 150px;
        background-color: #fff;
        border-radius: 4px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.04);
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .package-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .package-header {
        padding: 16px;
        background-color: #f5f5f5;
        border-bottom: 1px solid #e4e5e7;
    }
    .package-title {
        font-size: 18px;
        font-weight: 700;
        color: #404145;
        margin-bottom: 4px;
    }
    .package-price {
        font-size: 24px;
        font-weight: 700;
        color: #1dbf73;
    }
    .package-price span {
        font-size: 14px;
        font-weight: 400;
        color: #74767e;
    }
    .package-content {
        padding: 16px;
    }
    .package-description {
        color: #62646a;
        margin-bottom: 16px;
        line-height: 1.6;
    }
    .package-features {
        margin-bottom: 16px;
    }
    .package-feature {
        display: flex;
        align-items: flex-start;
        margin-bottom: 8px;
        color: #62646a;
    }
    .package-feature i {
        color: #1dbf73;
        margin-right: 8px;
        margin-top: 4px;
    }
    .package-button {
        display: block;
        width: 100%;
        padding: 10px;
        background-color: #1dbf73;
        color: white;
        border: none;
        border-radius: 4px;
        font-weight: 600;
        text-align: center;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .package-button:hover {
        background-color: #19a463;
    }
    
    /* Featured package */
    .package-card.featured {
        border: 2px solid #1dbf73;
        position: relative;
    }
    .featured-badge {
        position: absolute;
        top: 0;
        right: 0;
        background-color: #1dbf73;
        color: white;
        padding: 4px 8px;
        font-size: 12px;
        font-weight: 600;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-lg-6 text-left">
            <h2 class="mb-0">{{__('Portfolio')}}</h2>
        </div>
        
    </div>
    <div class="row">
                           
        <div class="col-lg-8">
            <!-- Profile Container -->
             
            <div class="profile-container">
                <!-- Profile Header -->
                <div class="profile-header">
                    <div class="profile-avatar">
                        <img src="{{ asset('images/dummy/avatar1.jpg') }}" alt="Fred Mouniguet">
                    </div>
                    <div class="profile-info">
                        <h1 class="profile-name">Fred Mouniguet</h1>
                        <p class="profile-title">Professional Wedding & Event Photographer</p>
                        <div class="profile-stats">
                            <div class="stat-item">
                                <i class="fa fa-star"></i>
                                <span class="stat-value">4.9</span>
                                <span class="stat-label">(183 reviews)</span>
                            </div>
                            <div class="stat-item">
                                <i class="fa fa-check-circle"></i>
                                <span class="stat-label">Verified</span>
                            </div>
                            <div class="stat-item">
                                <i class="fa fa-map-marker"></i>
                                <span class="stat-label">Paris, France</span>
                            </div>
                        </div>
                        <div class="profile-actions">
                            <button class="btn btn-contact">Contact Me</button>
                            <button class="btn btn-save"><i class="fa fa-heart-o"></i> Save</button>
                            
                        </div>
                    </div>
                </div>
                
                <!-- Gallery Slider -->
                <div class="gallery-slider">
                    @php
                        use Modules\Media\Models\MediaFile;
                        // Using property gallery images from the system
                        $galleryImages = [
                            ['url' => get_file_url(MediaFile::findMediaByName("property-gallery-1")->id), 'alt' => 'Wedding photography'],
                            ['url' => get_file_url(MediaFile::findMediaByName("property-gallery-2")->id), 'alt' => 'Portrait photography'],
                            ['url' => get_file_url(MediaFile::findMediaByName("property-gallery-3")->id), 'alt' => 'Event photography'],
                            ['url' => get_file_url(MediaFile::findMediaByName("property-gallery-4")->id), 'alt' => 'Family photography'],
                            ['url' => get_file_url(MediaFile::findMediaByName("property-gallery-5")->id), 'alt' => 'Nature photography'],
                            ['url' => get_file_url(MediaFile::findMediaByName("property-gallery-6")->id), 'alt' => 'Travel photography'],
                        ];
                    @endphp
                    
                    @foreach($galleryImages as $image)
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
                <!-- Profile Tabs -->
                
                
                <!-- Profile Content -->
                <div class="profile-content">
                    <!-- About Section -->
                    <div class="about-section">
                        <h3>About Me</h3>
                        <p class="about-text">
                            I'm a professional photographer with over 10 years of experience specializing in wedding and event photography. 
                            My passion is capturing those special moments that tell your unique story. Based in Paris, I travel worldwide 
                            to document weddings, corporate events, and special occasions with a natural, candid approach.
                        </p>
                        <p class="about-text">
                            My style combines photojournalism with fine art portraiture, ensuring I capture both the big moments and the 
                            small details that make your event special. I believe in creating a comfortable atmosphere where you can be 
                            yourself, resulting in authentic images that truly reflect your personality and the emotion of the day.
                        </p>
                    </div>
                    
                    <!-- Skills Section -->
                    <div class="skills-section">
                        <h3>My Skills</h3>
                        <div class="skills-list">
                            <span class="skill-tag">Wedding Photography</span>
                            <span class="skill-tag">Portrait Photography</span>
                            <span class="skill-tag">Event Photography</span>
                            <span class="skill-tag">Photojournalism</span>
                            <span class="skill-tag">Adobe Lightroom</span>
                            <span class="skill-tag">Adobe Photoshop</span>
                            <span class="skill-tag">Photo Retouching</span>
                            <span class="skill-tag">Drone Photography</span>
                        </div>
                    </div>
                    
                    <!-- Languages Section -->
                    <div class="languages-section">
                        <h3>Languages</h3>
                        <div class="language-item">
                            <span class="language-name">English</span>
                            <span class="language-level">Fluent</span>
                        </div>
                        <div class="language-item">
                            <span class="language-name">French</span>
                            <span class="language-level">Native</span>
                        </div>
                        <div class="language-item">
                            <span class="language-name">Spanish</span>
                            <span class="language-level">Conversational</span>
                        </div>
                    </div>
                    
                    <!-- Education Section -->
                    <div class="education-section">
                        <h3>Education</h3>
                        <div class="education-item">
                            <div class="education-title">Bachelor of Fine Arts in Photography</div>
                            <div class="education-details">Paris College of Art, 2010-2014</div>
                        </div>
                        <div class="education-item">
                            <div class="education-title">Professional Certificate in Digital Imaging</div>
                            <div class="education-details">International Center of Photography, 2015</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Packages Section -->
            <div class="packages-section">
                <div class="profile-container">
                    <h3 style="padding: 24px 24px 0 24px;">My Packages</h3>
                    <div class="profile-content">
                        <div class="packages-container">
                            <!-- Basic Package -->
                            <div class="package-card">
                                <div class="package-header">
                                    <div class="package-title">Basic</div>
                                    <div class="package-price">$499 <span>/ event</span></div>
                                </div>
                                <div class="package-content">
                                    <p class="package-description">
                                        Perfect for small events and portrait sessions. Get high-quality photos with essential editing.
                                    </p>
                                    <div class="package-features">
                                        <div class="package-feature">
                                            <i class="fa fa-check"></i>
                                            <span>4 hours of photography coverage</span>
                                        </div>
                                        <div class="package-feature">
                                            <i class="fa fa-check"></i>
                                            <span>100+ professionally edited photos</span>
                                        </div>
                                        <div class="package-feature">
                                            <i class="fa fa-check"></i>
                                            <span>Online gallery with digital downloads</span>
                                        </div>
                                        <div class="package-feature">
                                            <i class="fa fa-check"></i>
                                            <span>Basic retouching included</span>
                                        </div>
                                        <div class="package-feature">
                                            <i class="fa fa-check"></i>
                                            <span>Delivery within 2 weeks</span>
                                        </div>
                                    </div>
                                    <button class="package-button">Select Package</button>
                                </div>
                            </div>
                            
                            <!-- Standard Package -->
                            <div class="package-card featured">
                                <div class="featured-badge">Most Popular</div>
                                <div class="package-header">
                                    <div class="package-title">Standard</div>
                                    <div class="package-price">$999 <span>/ event</span></div>
                                </div>
                                <div class="package-content">
                                    <p class="package-description">
                                        Ideal for weddings and medium-sized events. Comprehensive coverage with premium editing.
                                    </p>
                                    <div class="package-features">
                                        <div class="package-feature">
                                            <i class="fa fa-check"></i>
                                            <span>8 hours of photography coverage</span>
                                        </div>
                                        <div class="package-feature">
                                            <i class="fa fa-check"></i>
                                            <span>300+ professionally edited photos</span>
                                        </div>
                                        <div class="package-feature">
                                            <i class="fa fa-check"></i>
                                            <span>Online gallery with digital downloads</span>
                                        </div>
                                        <div class="package-feature">
                                            <i class="fa fa-check"></i>
                                            <span>Advanced retouching included</span>
                                        </div>
                                        <div class="package-feature">
                                            <i class="fa fa-check"></i>
                                            <span>Engagement/pre-event session</span>
                                        </div>
                                        <div class="package-feature">
                                            <i class="fa fa-check"></i>
                                            <span>Delivery within 1 week</span>
                                        </div>
                                    </div>
                                    <button class="package-button">Select Package</button>
                                </div>
                            </div>
                            
                            <!-- Premium Package -->
                            <div class="package-card">
                                <div class="package-header">
                                    <div class="package-title">Premium</div>
                                    <div class="package-price">$1499 <span>/ event</span></div>
                                </div>
                                <div class="package-content">
                                    <p class="package-description">
                                        The ultimate package for large events and luxury weddings. Premium coverage with exceptional service.
                                    </p>
                                    <div class="package-features">
                                        <div class="package-feature">
                                            <i class="fa fa-check"></i>
                                            <span>12 hours of photography coverage</span>
                                        </div>
                                        <div class="package-feature">
                                            <i class="fa fa-check"></i>
                                            <span>500+ professionally edited photos</span>
                                        </div>
                                        <div class="package-feature">
                                            <i class="fa fa-check"></i>
                                            <span>Online gallery with digital downloads</span>
                                        </div>
                                        <div class="package-feature">
                                            <i class="fa fa-check"></i>
                                            <span>Unlimited retouching included</span>
                                        </div>
                                        <div class="package-feature">
                                            <i class="fa fa-check"></i>
                                            <span>Engagement/pre-event session</span>
                                        </div>
                                        <div class="package-feature">
                                            <i class="fa fa-check"></i>
                                            <span>Delivery within 1 week</span>
                                        </div>
                                    </div>
                                    <button class="package-button">Select Package</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Reviews Section -->
            <div class="reviews-section">
                <div class="profile-container">
                    <h3 style="padding: 24px 24px 0 24px;">Recent Reviews</h3>
                    <div class="profile-content">
                        <!-- Review Item 1 -->
                        <div class="review-item">
                            <div class="review-header">
                                <div class="reviewer-avatar">
                                    <img src="{{ asset('images/dummy/reviewer1.jpg') }}" alt="Reviewer">
                                </div>
                                <div class="reviewer-info">
                                    <div class="reviewer-name">Sophie & Thomas</div>
                                    <div class="review-date">June 15, 2023</div>
                                </div>
                            </div>
                            <div class="review-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="review-content">
                                Fred was absolutely amazing at our wedding! He captured all the special moments without being intrusive. 
                                The photos are stunning and really tell the story of our day. We couldn't be happier with his work and 
                                would recommend him to anyone looking for a wedding photographer.
                            </div>
                        </div>
                        
                        <!-- Review Item 2 -->
                        <div class="review-item">
                            <div class="review-header">
                                <div class="reviewer-avatar">
                                    <img src="{{ asset('images/dummy/reviewer2.jpg') }}" alt="Reviewer">
                                </div>
                                <div class="reviewer-info">
                                    <div class="reviewer-name">Corporate Events Ltd</div>
                                    <div class="review-date">May 3, 2023</div>
                                </div>
                            </div>
                            <div class="review-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="review-content">
                                We hired Fred for our annual corporate conference and were extremely impressed with his professionalism 
                                and the quality of his work. He managed to capture the essence of our event perfectly, from the keynote 
                                speeches to the networking sessions. The turnaround time was also impressive. Will definitely be using 
                                his services again!
                            </div>
                        </div>
                        
                        <!-- Review Item 3 -->
                        <div class="review-item">
                            <div class="review-header">
                                <div class="reviewer-avatar">
                                    <img src="{{ asset('images/dummy/reviewer3.jpg') }}" alt="Reviewer">
                                </div>
                                <div class="reviewer-info">
                                    <div class="reviewer-name">Emma & James</div>
                                    <div class="review-date">April 22, 2023</div>
                                </div>
                            </div>
                            <div class="review-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                            </div>
                            <div class="review-content">
                                Fred photographed our engagement session and we couldn't be happier with the results. He made us feel 
                                comfortable in front of the camera and suggested beautiful locations around Paris. The photos are 
                                absolutely stunning and we've received so many compliments. We're looking forward to having him 
                                photograph our wedding next year!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <!-- Sidebar -->
            <div class="profile-sidebar">
                <!-- Services Section -->
                <div class="sidebar-section">
                    <h3 class="sidebar-title">My Services</h3>
                    <div class="sidebar-content">
                        <ul class="list-unstyled">
                            <li><i class="fa fa-check text-success mr-2"></i> Wedding Photography</li>
                            <li><i class="fa fa-check text-success mr-2"></i> Engagement Sessions</li>
                            <li><i class="fa fa-check text-success mr-2"></i> Corporate Events</li>
                            <li><i class="fa fa-check text-success mr-2"></i> Portrait Sessions</li>
                            <li><i class="fa fa-check text-success mr-2"></i> Product Photography</li>
                        </ul>
                    </div>
                </div>
                
                <!-- Availability Section -->
                <div class="sidebar-section">
                    <h3 class="sidebar-title">Availability</h3>
                    <div class="sidebar-content">
                        <p>Currently booking for 2023-2024</p>
                        <p>Average response time: <strong>2 hours</strong></p>
                    </div>
                </div>
                
                <!-- Experience Section -->
                <div class="sidebar-section">
                    <h3 class="sidebar-title">Experience</h3>
                    <div class="sidebar-content">
                        <p><strong>10+ years</strong> professional experience</p>
                        <p><strong>250+</strong> weddings photographed</p>
                        <p><strong>100+</strong> corporate events</p>
                    </div>
                </div>
                
                <!-- Equipment Section -->
                <div class="sidebar-section">
                    <h3 class="sidebar-title">Equipment</h3>
                    <div class="sidebar-content">
                        <ul class="list-unstyled">
                            <li>Sony Alpha A7R IV</li>
                            <li>Canon EOS R5</li>
                            <li>Professional Lighting Kit</li>
                            <li>DJI Mavic 3 Drone</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('dist/frontend/js/slick.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize package tabs
        const packageTabs = document.querySelectorAll('.package-tab');
        
        packageTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Remove active class from all tabs
                packageTabs.forEach(t => t.classList.remove('active'));
                
                // Add active class to clicked tab
                this.classList.add('active');
                
                // Here you would normally update the package content based on the selected tab
                // For demo purposes, we're just changing the tab appearance
            });
        });
        
        // Initialize slick slider
        $('.gallery-slider').slick({
            dots: false,
            infinite: true,
            speed: 500,
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            arrows: true,
            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
        
        // Initialize popup gallery
        $('.popup-img').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            }
        });
    });
</script>
@endsection
