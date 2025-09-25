
@php
    $matchtext = \App\Models\MatchHighlightsText::first();
    $match = \App\Models\MatchHighlights::all();
@endphp

<div class="match-highlights">
    <div class="container">
        <div class="row section-row">
            <div class="col-lg-6 col-md-10">
                <!-- Section Title Start -->
                <div class="section-title">
                    <div class="section-bg-title wow fadeInUp">
                        <span>Points forts</span>
                    </div>
                    <h3 class="wow fadeInUp" data-wow-delay="0.2s">{{ $matchtext->title ?? '' }}</h3>
                    <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $matchtext->subtitle ?? '' }}</h2>
                </div>
                <!-- Section Title End -->
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <!-- Match Highlight Slider Start -->
                <div class="match-highlight-slider">
                    <div class="swiper">
                        <div class="swiper-wrapper">

                            <!-- Dynamic Slides -->
                            @foreach($match as $highlight)
                                <div class="swiper-slide">
                                    <div class="match-highlight-item">
                                        <!-- Image -->
                                        <div class="match-highlight-item-image">
                                            <figure class="image-anime">
                                                @if($highlight->image)
                                                    <img src="{{ asset('storage/' . $highlight->image) }}" alt="Highlight Image">
                                                @else
                                                    <img src="{{ asset('frontend/images/default.jpg') }}" alt="Default Image">
                                                @endif
                                            </figure>
                                        </div>

                                        <!-- Text -->
                                        <div class="match-highlight-item-body">
                                            <div class="match-highlight-item-content">
                                                <h3>{{ $highlight->text }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        <!-- Slider Arrows -->
                        
                    </div>
                </div>
                <!-- Match Highlight Slider End -->
            </div>
        </div>
    </div>
</div>
