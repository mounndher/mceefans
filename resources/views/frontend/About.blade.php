@php
$about = \App\Models\About::first();
@endphp
<div class="about-us">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <!-- About Us Content Start -->
                    <div class="about-us-content">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <div class="section-bg-title wow fadeInUp">
                                <span>{{ $about->subtitle }}</span>
                            </div>
                            <h3 class="wow fadeInUp" data-wow-delay="0.2s">{{ $about->title_text }}</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $about->title }}</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.4s"> {{ $about->description }}</p>
                        </div>
                        <!-- Section Title End -->

                        <!-- About Us Body Start -->
                        <div class="about-us-body">
                            <!-- About Us List Start -->
                            <div class="about-us-list wow fadeInUp" data-wow-delay="0.6s visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp;">
                                <ul>
                                    @if ($about->button_text)
                                     <li>{{ $about->button_text }}</li>
                                    @endif
                                    @if ($about->button_link)
                                    <li>{{ $about->button_link }}</li>
                                    @endIf
                                     @if ($about->phase)
                                    <li>{{ $about->phase }}</li>
                                    @endIf
                                </ul>
                            </div>
                            <!-- About Us List End -->

                            <!-- Contact Us Circle Start -->
                            <div class="contact-us-circle">
                                <a href="">
                                    <figure>
                                        <img src="{{ asset('frontend/images/contact-us-circle.svg') }}" alt="">
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
                        <!-- About Us Body End -->
                    </div>
                    <!-- About Us Content End -->
                </div>

                <div class="col-lg-6">
                    <!-- About Image Box Start -->
                    <div class="about-image-box">
                        <!-- About Us Images Start -->
                        <div class="about-us-images">
                            <figure class="image-anime reveal">
                                <img src="{{ asset($about->image)}}" alt="">
                            </figure>
                        </div>

                    </div>
                    <!-- About Image Box End -->
                </div>
            </div>
        </div>
</div>
