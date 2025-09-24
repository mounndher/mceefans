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
    <div class="our-features dark-section">
        <div class="container-fluid">
            <div class="row no-gutters">
                <div class="col-lg-6">
                    <!-- Feature Image Content Start -->
                    <div class="feature-image-content">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">our features</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">Building champions on and off the field</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">Our club is a place for all players, from aspiring youth athletes to seasoned competitors. With features like our development-focused programs.</p>
                        </div>
                        <!-- Section Title End -->

                        <!-- Feature Button Start -->
                        <div class="feature-btn wow fadeInUp" data-wow-delay="0.4s">
                            <a href="contact.html" class="btn-default">contact us</a>
                        </div>
                        <!-- Feature Button End -->
                    </div>
                    <!-- Feature Image Content End -->
                </div>

                <div class="col-lg-6">
                    <!-- Feature List Start -->
                    <div class="feature-list">
                        <!-- Feature List Item Start -->
                        <div class="feature-list-item wow fadeInUp">
                            <div class="icon-box">
                                <img src="{{ asset('frontend/images/icon-feature-1.svg') }}" alt="">
                            </div>
                            <div class="feature-item-content">
                                <h3>Elite Coaching Staff</h3>
                                <p>Our experienced and licensed coaches bring professional-level training to players of all ages.</p>
                            </div>
                        </div>
                        <!-- Feature List Item End -->

                        <!-- Feature List Item Start -->
                        <div class="feature-list-item wow fadeInUp" data-wow-delay="0.2s">
                            <div class="icon-box">
                                <img src="{{ asset('frontend/images/icon-feature-2.svg')}}" alt="">
                            </div>
                            <div class="feature-item-content">
                                <h3>State-of-the-Art Facilities</h3>
                                <p>From high-quality training grounds to modern locker rooms and recovery zones.</p>
                            </div>
                        </div>
                        <!-- Feature List Item End -->

                        <!-- Feature List Item Start -->
                        <div class="feature-list-item wow fadeInUp" data-wow-delay="0.4s">
                            <div class="icon-box">
                                <img src="{{ asset('frontend/images/icon-feature-3.svg')}}" alt="">
                            </div>
                            <div class="feature-item-content">
                                <h3>Player-Centered Development</h3>
                                <p>We tailor training programs to each athletes strengths and goals, offering a pathway from youth levels.</p>
                            </div>
                        </div>
                        <!-- Feature List Item End -->

                        <!-- Feature List Item Start -->
                        <div class="feature-list-item wow fadeInUp" data-wow-delay="0.6s">
                            <div class="icon-box">
                                <img src="{{ asset('frontend/images/icon-feature-4.svg')}}" alt="">
                            </div>
                            <div class="feature-item-content">
                                <h3>Competitive Exposure & Tournaments</h3>
                                <p>Players regularly participate in local, regional, and international tournaments, gaining real matchexperience.</p>
                            </div>
                        </div>
                        <!-- Feature List Item End -->
                    </div>
                    <!-- Feature List End -->
                </div>
            </div>
        </div>
    </div>
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
                            <h2 class="text-anime-style-2" data-cursor="-opaque">Dedicated to Every Player's Growth and Greatness</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.4s">We personalize training, promote teamwork, and support overall development to ensure every athlete has the chance to improve.</p>
                        </div>
                        <!-- Section Title End -->

                        <!-- Why Choose Body Start -->
                        <div class="why-choose-body">
                            <!-- Why Choose Item List Start -->
                            <div class="why-choose-item-list wow fadeInUp" data-wow-delay="0.6s">
                                <!-- Why Choose Item Start -->
                                <div class="why-choose-item">
                                    <div class="icon-box">
                                        <img src="{{ asset('frontend/images/icon-why-choose-1.svg')}}" alt="">
                                    </div>
                                    <div class="why-choose-item-content">
                                        <h3>Player development</h3>
                                    </div>
                                </div>
                                <!-- Why Choose Item End -->

                                <!-- Why Choose Item Start -->
                                <div class="why-choose-item">
                                    <div class="icon-box">
                                        <img src="{{ asset('frontend/images/icon-why-choose-2.svg')}}" alt="">
                                    </div>
                                    <div class="why-choose-item-content">
                                        <h3>Supportive environment</h3>
                                    </div>
                                </div>
                                <!-- Why Choose Item End -->
                            </div>
                            <!-- Why Choose Item List End -->

                            <!-- Why Choose List Circle Start -->
                            <div class="why-choose-list-circle">
                                <!-- Why Choose List Start -->
                                <div class="why-choose-list wow fadeInUp" data-wow-delay="0.8s">
                                    <ul>
                                        <li>Professional coaching tailored to all skill levels.</li>
                                        <li>Safe, inclusive, and inspiring training environment.</li>
                                        <li>Focus on both individual growth and team success.</li>
                                    </ul>
                                </div>
                                <!-- Why Choose List End -->

                                <!-- Contact Us Circle Start -->
                                <div class="contact-us-circle">
                                    <a href="contact.html">
                                        <figure>
                                            <img src="{{ asset('frontend/images/contact-us-circle.svg')}}" alt="">
                                        </figure>

                                        <!-- Contact Circle Counter Start -->
                                        <div class="contact-circle-counter">
                                            <h2><span class="counter">20</span>+</h2>
                                        </div>
                                        <!-- Contact Circle Counter End -->
                                    </a>
                                </div>
                                <!-- Contact Us Circle End -->
                            </div>
                            <!-- Why Choose List Circle End -->
                        </div>
                        <!-- Why Choose Body End -->
                    </div>
                    <!-- Why Choose Content End -->
                </div>

                <div class="col-lg-12">
                    <!-- Offer Boxes Start -->
                    <div class="offer-boxes">
                        <!-- Offer Box Item Start -->
                        <div class="offer-box-item wow fadeInUp">
                            <!-- Offer Image Start -->
                            <div class="offer-image">
                                <figure>
                                    <img src="{{asset('frontend/images/offer-image-1.jpg)')}}" alt="">
                                </figure>
                            </div>
                            <!-- Offer Image End -->

                            <!-- Offer Item Content Start -->
                            <div class="offer-item-content">
                                <h2>25% Off On 4-Week Intensive Summer Camp</h2>
                                <h3>Summer Training Camp Offer</h3>
                            </div>
                            <!-- Offer Item Content ENd -->
                        </div>
                        <!-- Offer Box Item End -->

                        <!-- Offer Box Item Start -->
                        <div class="offer-box-item wow fadeInUp" data-wow-delay="0.2s">
                            <!-- Offer Image Start -->
                            <div class="offer-image">
                                <figure>
                                    <img src="{{ asset('frontend/images/offer-image-2.jpg')}}" alt="">
                                </figure>
                            </div>
                            <!-- Offer Image End -->

                            <!-- Offer Item Content Start -->
                            <div class="offer-item-content">
                                <h2>Player's Kit Bundle - Saveing Big 50%</h2>
                                <h3>Club Merchandise Combo</h3>
                            </div>
                            <!-- Offer Item Content ENd -->
                        </div>
                        <!-- Offer Box Item End -->
                    </div>
                    <!-- Offer Boxes End -->
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
    <div class="match-highlights">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-6 col-md-10">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <div class="section-bg-title wow fadeInUp">
                            <span>highlights</span>
                        </div>
                        <h3 class="wow fadeInUp" data-wow-delay="0.2s">Key moments uncovered</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Goals, wins & wows this weeks highlights</h2>
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
                                <!-- Match Highlight Slide Start -->
                                <div class="swiper-slide">
                                    <!-- Match Highlight Item Start -->
                                    <div class="match-highlight-item">
                                        <!-- Match Highlight Item Image Start -->
                                        <div class="match-highlight-item-image">
                                            <figure class="image-anime">
                                                <img src="{{ asset('frontend/images/match-highlight-image-1.jpg') }}" alt="">
                                            </figure>
                                        </div>
                                        <!-- Match Highlight Item Image End -->

                                        <!-- Match Highlight Item Body Start -->
                                        <div class="match-highlight-item-body">
                                            <div class="match-highlight-item-content">
                                                <h3>Epic Showdown! Thunder FC vs United - All the Goal & Drama!</h3>
                                            </div>
                                            <div class="match-highlight-video-btn">
                                                <a href="https://www.youtube.com/watch?v=Y-x0efG1seA" class="popup-video" data-cursor-text="Play">
                                                    <i class="fa-solid fa-play"></i>
                                                </a>
                                                <p>5:27 mins</p>
                                            </div>
                                        </div>
                                        <!-- Match Highlight Item Body End -->
                                    </div>
                                    <!-- Match Highlight Item End -->
                                </div>
                                <!-- Match Highlight Slide End -->

                                <!-- Match Highlight Slide Start -->
                                <div class="swiper-slide">
                                    <!-- Match Highlight Item Start -->
                                    <div class="match-highlight-item">
                                        <!-- Match Highlight Item Image Start -->
                                        <div class="match-highlight-item-image">
                                            <figure class="image-anime">
                                                <img src="{{ asset('frontend/images/match-highlight-image-2.jpg') }}" alt="">
                                            </figure>
                                        </div>
                                        <!-- Match Highlight Item Image End -->

                                        <!-- Match Highlight Item Body Start -->
                                        <div class="match-highlight-item-body">
                                            <div class="match-highlight-item-content">
                                                <h3>Leo Storms Hat-Trick! Thunder FC vs Blaze United Highlights</h3>
                                            </div>
                                            <div class="match-highlight-video-btn">
                                                <a href="https://www.youtube.com/watch?v=Y-x0efG1seA" class="popup-video" data-cursor-text="Play">
                                                    <i class="fa-solid fa-play"></i>
                                                </a>
                                                <p>5:27 mins</p>
                                            </div>
                                        </div>
                                        <!-- Match Highlight Item Body End -->
                                    </div>
                                    <!-- Match Highlight Item End -->
                                </div>
                                <!-- Match Highlight Slide End -->

                                <!-- Match Highlight Slide Start -->
                                <div class="swiper-slide">
                                    <!-- Match Highlight Item Start -->
                                    <div class="match-highlight-item">
                                        <!-- Match Highlight Item Image Start -->
                                        <div class="match-highlight-item-image">
                                            <figure class="image-anime">
                                                <img src="images/match-highlight-image-3.jpg" alt="">
                                            </figure>
                                        </div>
                                        <!-- Match Highlight Item Image End -->

                                        <!-- Match Highlight Item Body Start -->
                                        <div class="match-highlight-item-body">
                                            <div class="match-highlight-item-content">
                                                <h3>United Strikes Back: Drama Unfolds Against Thunder</h3>
                                            </div>
                                            <div class="match-highlight-video-btn">
                                                <a href="https://www.youtube.com/watch?v=Y-x0efG1seA" class="popup-video" data-cursor-text="Play">
                                                    <i class="fa-solid fa-play"></i>
                                                </a>
                                                <p>5:27 mins</p>
                                            </div>
                                        </div>
                                        <!-- Match Highlight Item Body End -->
                                    </div>
                                    <!-- Match Highlight Item End -->
                                </div>
                                <!-- Match Highlight Slide End -->

                                <!-- Match Highlight Slide Start -->
                                <div class="swiper-slide">
                                    <!-- Match Highlight Item Start -->
                                    <div class="match-highlight-item">
                                        <!-- Match Highlight Item Image Start -->
                                        <div class="match-highlight-item-image">
                                            <figure class="image-anime">
                                                <img src="{{ asset('frontend/images/match-highlight-image-4.jpg') }}" alt="">
                                            </figure>
                                        </div>
                                        <!-- Match Highlight Item Image End -->

                                        <!-- Match Highlight Item Body Start -->
                                        <div class="match-highlight-item-body">
                                            <div class="match-highlight-item-content">
                                                <h3>Tension, Technique, and Triumph - Full Match Story</h3>
                                            </div>
                                            <div class="match-highlight-video-btn">
                                                <a href="https://www.youtube.com/watch?v=Y-x0efG1seA" class="popup-video" data-cursor-text="Play">
                                                    <i class="fa-solid fa-play"></i>
                                                </a>
                                                <p>5:27 mins</p>
                                            </div>
                                        </div>
                                        <!-- Match Highlight Item Body End -->
                                    </div>
                                    <!-- Match Highlight Item End -->
                                </div>
                                <!-- Match Highlight Slide End -->

                                <!-- Match Highlight Slide Start -->
                                <div class="swiper-slide">
                                    <!-- Match Highlight Item Start -->
                                    <div class="match-highlight-item">
                                        <!-- Match Highlight Item Image Start -->
                                        <div class="match-highlight-item-image">
                                            <figure class="image-anime">
                                                <img src="{{ asset('frontend/images/match-highlight-image-5.jpg')}}" alt="">
                                            </figure>
                                        </div>
                                        <!-- Match Highlight Item Image End -->

                                        <!-- Match Highlight Item Body Start -->
                                        <div class="match-highlight-item-body">
                                            <div class="match-highlight-item-content">
                                                <h3>Blaze Ignites Late Comeback - A Match to Remember</h3>
                                            </div>
                                            <div class="match-highlight-video-btn">
                                                <a href="https://www.youtube.com/watch?v=Y-x0efG1seA" class="popup-video" data-cursor-text="Play">
                                                    <i class="fa-solid fa-play"></i>
                                                </a>
                                                <p>5:27 mins</p>
                                            </div>
                                        </div>
                                        <!-- Match Highlight Item Body End -->
                                    </div>
                                    <!-- Match Highlight Item End -->
                                </div>
                                <!-- Match Highlight Slide End -->
                            </div>
                            <div class="match-highlight-btn">
                                <div class="match-highlight-btn-prev"></div>
                                <div class="match-highlight-btn-next"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Match Highlight Slider End -->
                </div>
            </div>
        </div>
    </div>
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
