@php
    $whatwedo = \App\Models\Whatwedo::first();
@endphp

@if($whatwedo)
<div class="what-we-do">
    <div class="container">
        <div class="row section-row">
            <div class="col-lg-12">
                <!-- Section Title Start -->
                <div class="section-title section-title-center">
                    <div class="section-bg-title wow fadeInUp">
                        <span>{{ $whatwedo->title }}</span>
                    </div>
                    <h3 class="wow fadeInUp" data-wow-delay="0.2s">{{ $whatwedo->title }}</h3>
                    <h2 class="text-anime-style-2" data-cursor="-opaque">
                        {{ $whatwedo->subtitle }}
                    </h2>
                </div>
                <!-- Section Title End -->
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <!-- What We Do Images Start -->
                <div class="what-we-do-images">
                    <!-- Image 1 -->
                    <div class="what-do-image-1">
                        <figure class="image-anime reveal">
                            <img src="{{ asset($whatwedo->image1) }}" alt="Image 1">
                        </figure>
                    </div>

                    <!-- Image 2 -->
                    <div class="what-do-image-2">
                        <figure class="image-anime reveal">
                            <img src="{{ asset($whatwedo->image2) }}" alt="Image 2">
                        </figure>
                    </div>

                    <!-- Image 3 -->
                    <div class="what-do-image-3">
                        <figure class="image-anime reveal">
                            <img src="{{ asset($whatwedo->image3) }}" alt="Image 3">
                        </figure>
                    </div>
                </div>
                <!-- What We Do Images End -->
            </div>

            <div class="col-lg-12">
                <!-- What We Do List Start -->
                <div class="what-we-do-list">
                    <!-- Item 1 -->
                    <div class="what-do-list-item wow fadeInUp">
                        <div class="icon-box">
                            <img src="{{ asset('frontend/images/icon-what-we-do-1.svg') }}" alt="">
                        </div>
                        <div class="what-do-item-content">
                            <h3>{{ $whatwedo->pharse1 }}</h3>
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div class="what-do-list-item wow fadeInUp" data-wow-delay="0.2s">
                        <div class="icon-box">
                            <img src="{{ asset('frontend/images/icon-what-we-do-2.svg') }}" alt="">
                        </div>
                        <div class="what-do-item-content">
                            <h3>{{ $whatwedo->pharse2 }}</h3>
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div class="what-do-list-item wow fadeInUp" data-wow-delay="0.4s">
                        <div class="icon-box">
                            <img src="{{ asset('frontend/images/icon-what-we-do-3.svg') }}" alt="">
                        </div>
                        <div class="what-do-item-content">
                            <h3>{{ $whatwedo->pharse3 }}</h3>
                        </div>
                    </div>
                </div>
                <!-- What We Do List End -->
            </div>
        </div>
    </div>
</div>
@endif
