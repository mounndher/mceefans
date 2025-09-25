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

