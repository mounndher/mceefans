   <footer class="main-footer">
        <!-- Scrolling Ticker Section Start -->
        <div class="our-scrolling-ticker">
            <!-- Scrolling Ticker Start -->
            <div class="scrolling-ticker-box">
                <div class="scrolling-content">
                    <span><img src="{{ asset('frontend/images/icon-football.svg')}}" alt="">explore now</span>
                    <span><img src="{{ asset('frontend/images/icon-football.svg')}}" alt="">purchese now</span>
                    <span><img src="{{ asset('frontend/images/icon-football.svg')}}" alt="">limited time deal</span>
                    <span><img src="{{ asset('frontend/images/icon-football.svg')}}" alt="">buy theme</span>
                    <span><img src="{{ asset('frontend/images/icon-football.svg')}}" alt="">explore now</span>
                    <span><img src="{{ asset('frontend/images/icon-football.svg')}}" alt="">purchese now</span>
                    <span><img src="{{ asset('frontend/images/icon-football.svg')}}" alt="">limited time deal</span>
                    <span><img src="{{ asset('frontend/images/icon-football.svg')}}" alt="">buy theme</span>
                    <span><img src="{{ asset('frontend/images/icon-football.svg')}}" alt="">explore now</span>
                    <span><img src="{{ asset('frontend/images/icon-football.svg')}}" alt="">purchese now</span>
                    <span><img src="{{ asset('frontend/images/icon-football.svg')}}" alt="">limited time deal</span>
                    <span><img src="{{ asset('frontend/images/icon-football.svg')}}" alt="">buy theme</span>
                </div>

                <div class="scrolling-content">
                    <span><img src="{{ asset('frontend/images/icon-football.svg')}}" alt="">explore now</span>
                    <span><img src="{{ asset('frontend/images/icon-football.svg')}}" alt="">purchese now</span>
                    <span><img src="{{ asset('frontend/images/icon-football.svg')}}" alt="">limited time deal</span>
                    <span><img src="{{ asset('frontend/images/icon-football.svg')}}" alt="">buy theme</span>
                    <span><img src="{{ asset('frontend/images/icon-football.svg')}}" alt="">explore now</span>
                    <span><img src="{{ asset('frontend/images/icon-football.svg')}}" alt="">purchese now</span>
                    <span><img src="{{ asset('frontend/images/icon-football.svg')}}" alt="">limited time deal</span>
                    <span><img src="{{ asset('frontend/images/icon-football.svg')}}" alt="">buy theme</span>
                    <span><img src="{{ asset('frontend/images/icon-football.svg')}}" alt="">explore now</span>
                    <span><img src="{{ asset('frontend/images/icon-football.svg')}}" alt="">purchese now</span>
                    <span><img src="{{ asset('frontend/images/icon-football.svg')}}" alt="">limited time deal</span>
                    <span><img src="{{ asset('frontend/images/icon-football.svg')}}" alt="">buy theme</span>
                </div>
            </div>
        </div>
        <!-- Scrolling Ticker Section End -->

        <!-- Footer Box Start -->
        <div class="footer-box dark-section">
            <div class="container">
                <div class="row">


                    <div class="col-lg-4">
                        <!-- About Footer Start -->
                        <div class="about-footer">
                            <!-- Footer Logo Start -->
                            <div class="footer-logo">
                                <img src="{{ asset('frontend/images/footer-logo.svg')}}" alt="">
                            </div>
                            <!-- Footer Logo End -->

                            <!-- About Footer Content Start -->
                            <div class="about-footer-content">
                                <p>{{ $settings->description }}</p>
                            </div>
                            <!-- About Footer Content End -->

                            <!-- Footer Social Link Start -->
                            <div class="footer-social-links">
                                <h3>Follow Us On:</h3>
                                <ul>
                             
                                    <li><a href="{{ $settings->tiktok_link}}"><i class="fa-brands fa-x-twitter"></i></a></li>
                                    <li><a href="{{ $settings->facebook_link}}"><i class="fa-brands fa-facebook-f"></i></a></li>
                                    <li><a href="{{ $settings->instagram_link }}"><i class="fa-brands fa-instagram"></i></a></li>
                                </ul>
                            </div>
                            <!-- Footer Social Link End -->
                        </div>
                        <!-- About Footer End -->
                    </div>

                    <div class="col-lg-2 col-md-3">
                        <!-- Footer Links Start -->
                        <div class="footer-links footer-menu">
                            <h3>quick links</h3>
                            <ul>
                                <li><a href="">home</a></li>
                                <li><a href="">about us</a></li>
                                <li><a href="">services</a></li>

                            </ul>
                        </div>
                        <!-- Footer Links End -->
                    </div>

                    <div class="col-lg-3 col-md-4">
                        <!-- Footer Links Start -->
                        <div class="footer-links">
                            <h3>Services</h3>
                            <ul>
                                <li><a href="">Professional Training</a></li>
                                <li><a href="">Indoor Training</a></li>
                                <li><a href="">Fitness & Conditioning</a></li>
                                <li><a href="">Video Analysis</a></li>
                            </ul>
                        </div>
                        <!-- Footer Links End -->
                    </div>

                    <div class="col-lg-3 col-md-5">
                        <!-- Footer Contact Details Start -->
                        <div class="footer-links footer-contact-details">
                            <h3>Club Information</h3>
                            <!-- Footer Contact Item Start -->
                            <div class="footer-contact-item">
                                <div class="icon-box">
                                    <img src="{{ asset('frontend/images/icon-location-white.svg')}}" alt="">
                                </div>
                                <div class="footer-contact-item-content">
                                    <h3>{{ $contact->location_text}}</h3>
                                    <p>{{ $contact->location }}</p>
                                </div>
                            </div>
                            <!-- Footer Contact Item End -->

                            <!-- Footer Contact Item Start -->
                            <div class="footer-contact-item">
                                <div class="icon-box">
                                    <img src="images/icon-phone-white.svg" alt="">
                                </div>
                                <div class="footer-contact-item-content">
                                    <h3>{{ $contact->phone_text}}</h3>
                                    <p><a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a></p>
                                </div>
                            </div>
                            <!-- Footer Contact Item End -->
                        </div>
                        <!-- Footer Contact Details End -->
                    </div>
                </div>
            </div>

            <!-- Footer Copyright Start -->
            <div class="footer-copyright">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <!-- Footer Copyright Text Start -->
                            <div class="footer-copyright-text">
                                <p>Copyright © 2025 All Rights Reserved.</p>
                            </div>
                            <!-- Footer Copyright Text End -->
                        </div>

                        <div class="col-md-6">
                            <!-- Footer Privacy Policy Start -->
                            <div class="footer-privacy-policy">
                                <ul>
                                    <li><a href="#">terms & condition</a></li>
                                    <li><a href="#">privacy policy</a></li>
                                </ul>
                            </div>
                            <!-- Footer Privacy Policy End -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer Copyright End -->
        </div>
        <!-- Footer Box End -->
    </footer>
