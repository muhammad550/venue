@extends('layouts.user')

@section('head')
<link rel="stylesheet" href="{{ asset('dist/frontend/css/slick.css') }}">
<link href="{{ asset('libs/summernote/summernote-bs4.min.css') }}" rel="stylesheet">
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
    
    /* Add form styling */
    .form-group {
        margin-bottom: 20px;
    }
    .form-control {
        border: 1px solid #e4e5e7;
        border-radius: 4px;
        padding: 10px;
        width: 100%;
    }
    .form-label {
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
    }
    .btn-save-portfolio {
        background-color: #1dbf73;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        font-weight: 600;
        cursor: pointer;
    }
    .btn-save-portfolio:hover {
        background-color: #19a463;
    }
    .image-upload {
        position: relative;
        margin-bottom: 15px;
    }
    .image-preview {
        width: 150px;
        height: 150px;
        border-radius: 4px;
        overflow: hidden;
        margin-bottom: 10px;
    }
    .image-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-lg-6 text-left">
            <h2 class="mb-0">{{__('Edit Portfolio')}}</h2>
        </div>
        <div class="col-lg-6 text-right">
            <a href="{{ route('vendor.portfolio') }}" class="btn btn-contact"><i class="fa fa-eye"></i> View Portfolio</a>
        </div>
    </div>
    
    <form action="{{ route('vendor.update_portfolio') }}" method="post" id="portfolio-form" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-8">
                <!-- Profile Container -->
                <div class="profile-container px-3">
                    <!-- <h3 class="mb-4">Basic Information</h3> -->
                    
                    <!-- Profile Avatar -->
                    
                    
                    <div class="form-group pt-3">
                        <label class="form-label">Professional Title</label>
                        <input type="text" class="form-control" name="professional_title" value="{{ $portfolio->professional_title ?? 'Professional Wedding & Event Photographer' }}">
                    </div>
                    
                    
                    
                                <div class="form-group">
                        <label class="form-label">Location</label>
                        <input type="text" class="form-control" name="location" value="{{ $portfolio->location ?? 'Paris, France' }}">
                    </div>
                    
                    
                    <h3 class="mt-5 mb-4">Gallery</h3>
                    <div class="panel">
                            <div class="panel-body">
                                {!! \Modules\Media\Helpers\FileHelper::fieldGalleryUpload('gallery','') !!}
                            </div>
                    </div>
                    
                   


                    <div class="form-group">
                        <label class="control-label">{{__("About Me")}}</label>
                        <div class="">
                            <textarea name="content" class="d-none has-ckeditor" cols="30" rows="10">{{$portfolio->content ?? ''}}</textarea>
                        </div>
                    </div>
                    
                    <!-- Skills Section -->
                    <h3 class="mt-5 mb-4">Skills</h3>
                    <div class="form-group">
                        <label class="form-label">Skills (comma separated)</label>
                        <input type="text" class="form-control" name="skills" value="{{ $portfolio->skills ?? 'Wedding Photography, Portrait Photography, Event Photography...' }}">
                    </div>

                     <h3 class="mt-5 mb-4">Languages</h3>
                    <div class="form-group">
                        <label class="form-label">Languages (comma separated)</label>
                        <input type="text" class="form-control" name="language_name" value="{{ $portfolio->language_name ?? 'English, French, Spanish' }}">
                    </div>
                    
                   
                
                    <h3 class="mb-4">Service Packages</h3>
                    
                    <div id="packages-container">
                        @if(!empty($portfolio->packages))
                            @foreach($portfolio->packages as $index => $package)
                                <div class="package-item mb-4 p-3 border rounded">
                                    <h4>Package</h4>
                                    <div class="form-group">
                                        <label class="form-label">Package Title</label>
                                        <input type="text" class="form-control" name="package_title[]" value="{{ $package['title'] ?? '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Price</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="number" class="form-control" name="package_price[]" value="{{ $package['price'] ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" name="package_description[]" rows="3">{{ $package['description'] ?? '' }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Features (one per line)</label>
                                        <textarea class="form-control" name="package_features[]" rows="5">{{ $package['features'] ?? '' }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Featured Package</label>
                                        <select class="form-control" name="package_featured[]">
                                            <option value="0" @if($package['featured'] == 0) selected @endif>No</option>
                                            <option value="1" @if($package['featured'] == 1) selected @endif>Yes</option>
                                        </select>
                                    </div>
                                    <button type="button" class="btn btn-danger remove-package"><i class="fa fa-trash"></i> Remove Package</button>
                                </div>
                            @endforeach
                        @else
                            <!-- Default package items -->
                        @endif
                    </div>
                    
                    <button type="button" class="btn btn-primary add-package mb-4"><i class="fa fa-plus"></i> Add Package</button>
                </div>
            </div>
            
            <div class="col-lg-4">
                <!-- Sidebar -->
                <div class="profile-sidebar">
                    <h3 class="mb-4">Services Information</h3>
                    
                    <!-- Services Section -->
                    <div class="form-group">
                        <label class="form-label">My Services (one per line)</label>
                        <textarea class="form-control" name="services" rows="5">{{ $portfolio->services ?? 'Wedding Photography
Engagement Sessions
Corporate Events
Portrait Sessions
Product Photography' }}</textarea>
                    </div>
                    
                    <!-- Availability Section -->
                    <div class="form-group">
                        <label class="form-label">Availability</label>
                        <input type="text" class="form-control" name="availability" value="{{ $portfolio->availability ?? 'Currently booking for 2023-2024' }}">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Response Time</label>
                        <input type="text" class="form-control" name="response_time" value="{{ $portfolio->response_time ?? '2 hours' }}">
                    </div>
                    
                    <!-- Experience Section -->
                    <div class="form-group">
                        <label class="form-label">Years of Experience</label>
                        <input type="text" class="form-control" name="years_experience" value="{{ $portfolio->years_experience ?? '10+ years' }}">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Projects Completed</label>
                        <textarea class="form-control" name="projects_completed" rows="3">{{ $portfolio->projects_completed ?? '250+ weddings photographed
100+ corporate events' }}</textarea>
                    </div>
                    
                    <!-- Equipment Section -->
                    <div class="form-group">
                        <label class="form-label">Equipment (one per line)</label>
                        <textarea class="form-control" name="equipment" rows="4">{{ $portfolio->equipment ?? 'Sony Alpha A7R IV
Canon EOS R5
Professional Lighting Kit
DJI Mavic 3 Drone' }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('dist/frontend/js/slick.min.js') }}"></script>
<script src="{{ asset('libs/summernote/summernote-bs4.min.js') }}"></script>
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
        
        // Initialize summernote editor
        $('#about_me').summernote({
            height: 200,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
        
        // Add event listener for avatar upload
        document.getElementById('avatar-upload').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('avatar-preview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
        
        // Add event listeners for dynamic form elements
        document.querySelector('.add-language').addEventListener('click', function() {
            const container = document.getElementById('languages-container');
            const newLanguageItem = document.createElement('div');
            newLanguageItem.className = 'row language-item mb-3';
            newLanguageItem.innerHTML = `
                <div class="col-md-6">
                    <input type="text" class="form-control" name="language_name[]" placeholder="Language">
                </div>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="language_level[]" placeholder="Level">
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger remove-language"><i class="fa fa-trash"></i></button>
                </div>
            `;
            container.appendChild(newLanguageItem);
        });
        
        document.querySelector('.add-education').addEventListener('click', function() {
            const container = document.getElementById('education-container');
            const newEducationItem = document.createElement('div');
            newEducationItem.className = 'row education-item mb-3';
            newEducationItem.innerHTML = `
                <div class="col-md-6">
                    <input type="text" class="form-control" name="education_title[]" placeholder="Degree/Certificate">
                </div>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="education_details[]" placeholder="School, Years">
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger remove-education"><i class="fa fa-trash"></i></button>
                </div>
            `;
            container.appendChild(newEducationItem);
        });
        
        document.querySelector('.add-package').addEventListener('click', function() {
            console.log('ddfsd');
            const container = document.getElementById('packages-container');
            const newPackageItem = document.createElement('div');
            newPackageItem.className = 'package-item mb-4 p-3 border rounded';
            newPackageItem.innerHTML = `
                <h4>Package</h4>
                <div class="form-group">
                    <label class="form-label">Package Title</label>
                    <input type="text" class="form-control" name="package_title[]">
                </div>
                <div class="form-group">
                    <label class="form-label">Price</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="number" class="form-control" name="package_price[]">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="package_description[]" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Features (one per line)</label>
                    <textarea class="form-control" name="package_features[]" rows="5"></textarea>
                </div>
                <button type="button" class="btn btn-danger remove-package"><i class="fa fa-trash"></i> Remove Package</button>
            `;
            container.appendChild(newPackageItem);
        });
        
        document.getElementById('packages-container').addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-package')) {
                event.target.closest('.package-item').remove();
            }
        });
        
        document.getElementById('languages-container').addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-language')) {
                event.target.closest('.language-item').remove();
            }
        });
        
        document.getElementById('education-container').addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-education')) {
                event.target.closest('.education-item').remove();
            }
        });
    });
</script>
@endsection

@section('footer')
    <script type="text/javascript" src="{{ asset('libs/tinymce/js/tinymce/tinymce.min.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('js/condition.js?_ver='.config('app.asset_version')) }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add Language functionality
        const addLanguageBtn = document.querySelector('.add-language');
        if (addLanguageBtn) {
            addLanguageBtn.addEventListener('click', function() {
                const container = document.getElementById('languages-container');
                const newLanguageItem = document.createElement('div');
                newLanguageItem.className = 'row language-item mb-3';
                newLanguageItem.innerHTML = `
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="language_name[]" placeholder="Language">
                    </div>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="language_level[]" placeholder="Level">
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger btn-sm remove-language"><i class="fa fa-trash"></i></button>
                    </div>
                `;
                container.appendChild(newLanguageItem);
                
                // Add event listener to the new remove button
                const newRemoveBtn = newLanguageItem.querySelector('.remove-language');
                if (newRemoveBtn) {
                    newRemoveBtn.addEventListener('click', removeLanguage);
                }
            });
        }
        
        // Remove Language functionality
        function removeLanguage() {
            const languageItem = this.closest('.language-item');
            if (languageItem) {
                languageItem.remove();
            }
        }
        
        // Add event listeners to existing remove language buttons
        const removeLanguageBtns = document.querySelectorAll('.remove-language');
        if (removeLanguageBtns.length > 0) {
            removeLanguageBtns.forEach(button => {
                button.addEventListener('click', removeLanguage);
            });
        }
        
        // Package toggle functionality
        const packageToggleInputs = document.querySelectorAll('.package-toggle-input');
        if (packageToggleInputs.length > 0) {
            packageToggleInputs.forEach(input => {
                input.addEventListener('change', function() {
                    const packageType = this.id.replace('has_', '').replace('_package', '');
                    togglePackage(packageType);
                });
                
                // Initialize package state
                const packageType = input.id.replace('has_', '').replace('_package', '');
                togglePackage(packageType);
            });
        }
        
        // Toggle package visibility based on checkbox
        function togglePackage(packageType) {
            const checkbox = document.getElementById(`has_${packageType}_package`);
            const packageContent = document.getElementById(`${packageType}-package-content`);
            
            if (checkbox && packageContent) {
                if (checkbox.checked) {
                    packageContent.classList.remove('package-disabled');
                    packageContent.style.opacity = '1';
                    packageContent.style.pointerEvents = 'auto';
                } else {
                    packageContent.classList.add('package-disabled');
                    packageContent.style.opacity = '0.5';
                    packageContent.style.pointerEvents = 'none';
                }
            }
        }
        
        // Initialize all packages
        ['basic', 'standard', 'premium'].forEach(packageType => {
            togglePackage(packageType);
        });
    });
</script>
@endsection
