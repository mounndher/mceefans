@extends('frontend.layouts.master')
@section('frontend')


<!-- Hero Section Start -->
@include('frontend.hero')
<!-- Hero Section End -->
<!-- Scrolling Ticker Section Start -->
<div class="our-scrolling-ticker">
    <!-- Scrolling Ticker Start -->
    <div class="scrolling-ticker-box">
        <div class="scrolling-content">
            <span><img src="images/icon-football.svg" alt="">explore now</span>
            <span><img src="images/icon-football.svg" alt="">purchese now</span>
            <span><img src="images/icon-football.svg" alt="">limited time deal</span>
            <span><img src="images/icon-football.svg" alt="">buy theme</span>
            <span><img src="images/icon-football.svg" alt="">explore now</span>
            <span><img src="images/icon-football.svg" alt="">purchese now</span>
            <span><img src="images/icon-football.svg" alt="">limited time deal</span>
            <span><img src="images/icon-football.svg" alt="">buy theme</span>
            <span><img src="images/icon-football.svg" alt="">explore now</span>
            <span><img src="images/icon-football.svg" alt="">purchese now</span>
            <span><img src="images/icon-football.svg" alt="">limited time deal</span>
            <span><img src="images/icon-football.svg" alt="">buy theme</span>
        </div>

        <div class="scrolling-content">
            <span><img src="images/icon-football.svg" alt="">explore now</span>
            <span><img src="images/icon-football.svg" alt="">purchese now</span>
            <span><img src="images/icon-football.svg" alt="">limited time deal</span>
            <span><img src="images/icon-football.svg" alt="">buy theme</span>
            <span><img src="images/icon-football.svg" alt="">explore now</span>
            <span><img src="images/icon-football.svg" alt="">purchese now</span>
            <span><img src="images/icon-football.svg" alt="">limited time deal</span>
            <span><img src="images/icon-football.svg" alt="">buy theme</span>
            <span><img src="images/icon-football.svg" alt="">explore now</span>
            <span><img src="images/icon-football.svg" alt="">purchese now</span>
            <span><img src="images/icon-football.svg" alt="">limited time deal</span>
            <span><img src="images/icon-football.svg" alt="">buy theme</span>
        </div>
    </div>
</div>
<!-- Scrolling Ticker Section End -->

<!-- About Us Section Start -->
@include('frontend.About')
<!-- About Us Section End -->

<!-- Our Services Section Start -->
@include('frontend.service')
<!-- Our Services Section End -->

<!-- What We Do Section Start -->
@include('frontend.whatwedo')
<!-- What We Do Section End -->

<!-- Our Features Section Start -->
@include('frontend.our-features')

<!-- Our Features Section End -->

<!-- Why Choose Us Section Start -->
@include('frontend.cart')


@include('frontend.succes')
<!-- Match Highlights Section Start -->
@include('frontend.match-highlights')
<!-- Match Highlights Section End -->


<!-- CTA Box Section Start -->
<div class="cta-box dark-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <!-- CTA Box Content Start -->
                <div class="cta-box-content">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <div class="section-bg-title wow fadeInUp">
                            <span>Contact</span>
                        </div>
                        <h3 class="wow fadeInUp" data-wow-delay="0.2s">Get in Touch</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Every goal every tackle every moment counts.</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.4s">From high-quality training grounds and modern locker rooms to dedicated fitness centers and recovery zones, our facilities support.</p>
                    </div>
                    <!-- Section Title End -->

                    <!-- CTA Box Form Start -->
                    <div class="cta-box-form wow fadeInUp" data-wow-delay="0.6s">
                        <form id="cta-box" action="#" method="POST">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" required="">
                                <button type="submit" class="btn-default">submit now</button>
                            </div>
                        </form>
                    </div>
                    <!-- CTA Box Form End -->

                    <!-- CTA Box List Start -->
                    <div class="cta-box-list wow fadeInUp" data-wow-delay="0.8s">
                        <ul>
                            <li>Special events offers</li>
                            <li>high quality training</li>
                        </ul>
                    </div>
                    <!-- CTA Box List End -->
                </div>
                <!-- CTA Box Content End -->
            </div>

            <div class="col-lg-7">
                <!-- CTA Box Image Start -->
                <div class="cta-box-image">
                    <figure>
                        <img src="{{ asset('frontend/images/cta-box-image.png') }}" alt="">
                    </figure>
                </div>
                <!-- CTA Box Image End -->
            </div>
        </div>
    </div>
</div>

@include('frontend.contact')
@endsection

