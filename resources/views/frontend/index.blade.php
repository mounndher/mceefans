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
<div class="why-choose-us">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <!-- Why Choose Image Start -->
                <div class="why-choose-image">
                    <figure>
                        <img src="{{ asset('frontend/images/why-choose-image.png')}}" alt="">
                    </figure>
                </div>
                <!-- Why Choose Image End -->
            </div>

            <div class="col-lg-6">
                <!-- Why Choose Content Start -->
                <div class="why-choose-content">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <div class="section-bg-title wow fadeInUp">
                            <span>Why choose us</span>
                        </div>
                        <h3 class="wow fadeInUp" data-wow-delay="0.2s">Why choose us</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">
                            Dedicated to Every Players Growth and Greatness
                        </h2>
                        <p class="wow fadeInUp" data-wow-delay="0.4s">
                            We personalize training, promote teamwork, and support overall development
                            to ensure every athlete has the chance to improve.
                        </p>
                    </div>
                    <!-- Section Title End -->

                    <!-- ✅ Tracking Form Start -->
                    <div class="tracking-form mt-4 p-3 border rounded shadow-sm bg-light">
                        <h4 class="mb-3">Track Your Card</h4>
                        <div class="tracking-form p-4 rounded shadow-sm bg-white wow fadeInUp" data-wow-delay="0.2s">
                            <form action="{{ route('contact.send') }}" method="POST" data-toggle="validator">
                                @csrf
                                <div class="row">




                                    <div class="form-group col-md-12 mb-4">
                                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Numéro de téléphone" required>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group col-md-12 mb-4">
                                        <textarea name="message" class="form-control" id="message" rows="4" placeholder="Écrire un message..." required></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary w-100">
                                            Ajouter un message
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <p class="text-muted small mt-2">Enter your phone and NIN to track your card status.</p>
                    </div>
                    <!-- ✅ Tracking Form End -->

                </div>
                <!-- Why Choose Content End -->
            </div>
        </div>
    </div>
</div>

<!-- Why Choose us Section End -->

<!-- Our Schedule Section Start -->
<div class="our-schedule dark-section parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <!-- Our Schedule Content Start -->
                <div class="our-schedule-content">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Fixtures & kick-off times</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Get ready for the action — mark your calendars</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">Stay updated with the latest fixtures and kick-off times for all upcoming matches. Plan your game nights with accurate schedules and venue details.</p>
                    </div>
                    <!-- Section Title End -->

                    <!-- Schedule Button Start -->
                    <div class="schedule-btn wow fadeInUp" data-wow-delay="0.4s">
                        <a href="about.html" class="btn-default btn-highlighted">more about us</a>
                    </div>
                    <!-- Schedule Button End -->
                </div>
                <!-- Our Schedule Content Start -->
            </div>

            <div class="col-lg-7">
                <!-- Match Schedule List Start -->
                <div class="match-schedule-list">
                    <!-- Match Schedule Item Start -->
                    <div class="match-schedule-item wow fadeInUp">
                        <!-- Icon Box Start -->
                        <div class="icon-box order-md-1 order-2">
                            <img src="images/icon-schedule-1.svg" alt="">
                        </div>
                        <!-- Icon Box End -->

                        <!-- Match Schedule Item Content Start -->
                        <div class="match-schedule-item-content order-md-2 order-3">
                            <div class="match-content-info">
                                <p>Melbourne knight</p>
                                <img src="images/icon-vs.svg" alt="">
                                <p>Avondale FC</p>
                            </div>
                            <div class="match-content-location">
                                <img src="images/icon-location.svg" alt="">
                                <h3>Allianz Arena Stadium</h3>
                            </div>
                        </div>
                        <!-- Match Schedule Item Content End -->

                        <!-- Icon Box Start -->
                        <div class="icon-box order-md-3 order-2">
                            <img src="images/icon-schedule-2.svg" alt="">
                        </div>
                        <!-- Icon Box End -->
                    </div>
                    <!-- Match Schedule Item End -->

                    <!-- Match Schedule Item Start -->
                    <div class="match-schedule-item wow fadeInUp" data-wow-delay="0.2s">
                        <!-- Icon Box Start -->
                        <div class="icon-box order-md-1 order-2">
                            <img src="images/icon-schedule-3.svg" alt="">
                        </div>
                        <!-- Icon Box End -->

                        <!-- Match Schedule Item Content Start -->
                        <div class="match-schedule-item-content order-md-2 order-3">
                            <div class="match-content-info">
                                <p>Pontevedra FC</p>
                                <img src="images/icon-vs.svg" alt="">
                                <p>Bergantiños FC</p>
                            </div>
                            <div class="match-content-location">
                                <img src="images/icon-location.svg" alt="">
                                <h3>Stadio Giuseppe Meazza</h3>
                            </div>
                        </div>
                        <!-- Match Schedule Item Content End -->

                        <!-- Icon Box Start -->
                        <div class="icon-box order-md-3 order-2">
                            <img src="images/icon-schedule-4.svg" alt="">
                        </div>
                        <!-- Icon Box End -->
                    </div>
                    <!-- Match Schedule Item End -->

                    <!-- Match Schedule Item Start -->
                    <div class="match-schedule-item wow fadeInUp" data-wow-delay="0.4s">
                        <!-- Icon Box Start -->
                        <div class="icon-box order-md-1 order-2">
                            <img src="{{ asset('frontend/images/icon-schedule-5.svg')}}" alt="">
                        </div>
                        <!-- Icon Box End -->

                        <!-- Match Schedule Item Content Start -->
                        <div class="match-schedule-item-content order-md-2 order-3">
                            <div class="match-content-info">
                                <p>Ribadumia FC</p>
                                <img src="images/icon-vs.svg" alt="">
                                <p>Santa Comba FC</p>
                            </div>
                            <div class="match-content-location">
                                <img src="{{ asset('frontend/images/icon-location.svg') }}" alt="">
                                <h3>Olympiastadion STADIUM</h3>
                            </div>
                        </div>
                        <!-- Match Schedule Item Content End -->

                        <!-- Icon Box Start -->
                        <div class="icon-box order-md-3 order-2">
                            <img src="images/icon-schedule-6.svg" alt="">
                        </div>
                        <!-- Icon Box End -->
                    </div>
                    <!-- Match Schedule Item End -->
                </div>
                <!-- Match Schedule List End -->
            </div>
        </div>
    </div>
</div>
<!-- Our Schedule Section End -->

<!-- Match Highlights Section Start -->
@include('frontend.match-highlights')
<!-- Match Highlights Section End -->

<!-- Club Success Section Start -->
<div class="club-success dark-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <!-- Club Success Image Start -->
                <div class="club-success-image">
                    <figure>
                        <img src="{{ asset('frontend/images/club-success-image.png') }}" alt="">
                    </figure>
                </div>
                <!-- Club Success Image End -->
            </div>

            <div class="col-lg-6">
                <!-- Club Success Content Start -->
                <div class="club-success-content">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <div class="section-bg-title wow fadeInUp">
                            <span>success</span>
                        </div>
                        <h3 class="wow fadeInUp" data-wow-delay="0.2s">club success</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Elite tools & training that drive player success</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.4s">From high-quality training grounds and modern locker rooms to dedicated fitness centers and recovery zones, our facilities support every aspect of a player's.</p>
                    </div>
                    <!-- Section Title End -->

                    <!-- Club Success List Start -->
                    <div class="club-success-list">
                        <!-- Club Success Item Start -->
                        <div class="club-success-item wow fadeInUp" data-wow-delay="0.6s">
                            <div class="icon-box">
                                <img src="{{ asset('frontend/images/icon-check.svg')}}" alt="">
                            </div>
                            <div class="club-success-item-content">
                                <h3>International Exposure Programs</h3>
                                <p>Fully equipped gym features strength, cardio, and agility equipment tailored the needs of footballers.</p>
                            </div>
                        </div>
                        <!-- Club Success Item End -->

                        <!-- Club Success Item Start -->
                        <div class="club-success-item wow fadeInUp" data-wow-delay="0.6s">
                            <div class="icon-box">
                                <img src="{{ asset('frontend/images/icon-check.svg')}}" alt="">
                            </div>
                            <div class="club-success-item-content">
                                <h3>Player Progress Tracking App</h3>
                                <p>Fully equipped gym features strength, cardio, and agility equipment tailored the needs of footballers.</p>
                            </div>
                        </div>
                        <!-- Club Success Item End -->

                        <!-- Club Success Item Start -->
                        <div class="club-success-item wow fadeInUp" data-wow-delay="0.8s">
                            <div class="icon-box">
                                <img src="{{ asset('frontend/images/icon-check.svg')}}" alt="">
                            </div>
                            <div class="club-success-item-content">
                                <h3>Video Analysis & Performance Review</h3>
                                <p>Fully equipped gym features strength, cardio, and agility equipment tailored the needs of footballers.</p>
                            </div>
                        </div>
                        <!-- Club Success Item End -->

                        <!-- Club Success Item Start -->
                        <div class="club-success-item wow fadeInUp" data-wow-delay="0.8s">
                            <div class="icon-box">
                                <img src="{{ asset('frontend/images/icon-check.svg')}}" alt="">
                            </div>
                            <div class="club-success-item-content">
                                <h3>Coaching & Sports Psychology Support</h3>
                                <p>Fully equipped gym features strength, cardio, and agility equipment tailored the needs of footballers.</p>
                            </div>
                        </div>
                        <!-- Club Success Item End -->
                    </div>
                    <!-- Club Success List End -->
                </div>
                <!-- Club Success Content End -->
            </div>
        </div>
    </div>
</div>
<!-- Club Success Section End -->

<!-- Our Testimonial Section Start -->
@include('frontend.contact')

<!-- Our Testimonial Section End -->

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
<!-- CTA Box Section End -->

<!-- Our Blog Section Start -->
<div class="our-blog">
    <div class="container">
        <div class="row section-row">
            <div class="col-lg-12">
                <!-- Section Title Start -->
                <div class="section-title section-title-center">
                    <div class="section-bg-title wow fadeInUp">
                        <span>Blogs</span>
                    </div>
                    <h3 class="wow fadeInUp" data-wow-delay="0.2s">latest blog</h3>
                    <h2 class="text-anime-style-2" data-cursor="-opaque">Kick off with our latest football stories and catch every goal</h2>
                </div>
                <!-- Section Title End -->
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-6">
                <!-- Post Item Start -->
                <div class="post-item wow fadeInUp">
                    <!-- Post Featured Image Start-->
                    <div class="post-featured-image">
                        <a href="blog-single.html" data-cursor-text="View">
                            <figure class="image-anime">
                                <img src="{{ asset('frontend/images/post-1.jpg')}}" alt="">
                            </figure>
                        </a>
                    </div>
                    <!-- Post Featured Image End -->

                    <!-- Post Item Body Start -->
                    <div class="post-item-body">
                        <!-- Post Item Content Start -->
                        <div class="post-item-content">
                            <h2><a href="blog-single.html">Master Your Game 5 Proven Drills to Sharpen Your First Touch and Ball Control</a></h2>
                        </div>
                        <!-- Post Item Content End -->

                        <!-- Post Item Readmore Button Start-->
                        <div class="post-item-btn">
                            <a href="blog-single.html" class="readmore-btn">Learn more</a>
                        </div>
                        <!-- Post Item Readmore Button End-->
                    </div>
                    <!-- Post Item Body End -->
                </div>
                <!-- Post Item End -->
            </div>

            <div class="col-lg-4 col-md-6">
                <!-- Post Item Start -->
                <div class="post-item wow fadeInUp" data-wow-delay="0.2s">
                    <!-- Post Featured Image Start-->
                    <div class="post-featured-image">
                        <a href="blog-single.html" data-cursor-text="View">
                            <figure class="image-anime">
                                <img src="images/post-2.jpg" alt="">
                            </figure>
                        </a>
                    </div>
                    <!-- Post Featured Image End -->

                    <!-- Post Item Body Start -->
                    <div class="post-item-body">
                        <!-- Post Item Content Start -->
                        <div class="post-item-content">
                            <h2><a href="blog-single.html">A Derby to Remember How Our U16 Team Clinched a Thrilling 3-2 Victory Over Local Rivals</a></h2>
                        </div>
                        <!-- Post Item Content End -->

                        <!-- Post Item Readmore Button Start-->
                        <div class="post-item-btn">
                            <a href="blog-single.html" class="readmore-btn">Learn more</a>
                        </div>
                        <!-- Post Item Readmore Button End-->
                    </div>
                    <!-- Post Item Body End -->
                </div>
                <!-- Post Item End -->
            </div>

            <div class="col-lg-4 col-md-6">
                <!-- Post Item Start -->
                <div class="post-item wow fadeInUp" data-wow-delay="0.4s">
                    <!-- Post Featured Image Start-->
                    <div class="post-featured-image">
                        <a href="blog-single.html" data-cursor-text="View">
                            <figure class="image-anime">
                                <img src="{{ asset('frontend/images/post-3.jpg')}}" alt="">
                            </figure>
                        </a>
                    </div>
                    <!-- Post Featured Image End -->

                    <!-- Post Item Body Start -->
                    <div class="post-item-body">
                        <!-- Post Item Content Start -->
                        <div class="post-item-content">
                            <h2><a href="blog-single.html">Fuel Like a Pro The Impact of Nutrition on Football Performance and Recovery</a></h2>
                        </div>
                        <!-- Post Item Content End -->

                        <!-- Post Item Readmore Button Start-->
                        <div class="post-item-btn">
                            <a href="blog-single.html" class="readmore-btn">Learn more</a>
                        </div>
                        <!-- Post Item Readmore Button End-->
                    </div>
                    <!-- Post Item Body End -->
                </div>
                <!-- Post Item End -->
            </div>
        </div>
    </div>
</div>
<!-- Our Blog Section End -->
@endsection

