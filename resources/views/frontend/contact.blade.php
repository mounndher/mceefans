@php
$contact = \App\Models\Contact::first();
use App\Models\Setting;
 $settings = Setting::first();
@endphp
<div class="page-contact-us">
    <div class="container">
        <div class="row section-row">
            <div class="col-lg-12">
                <!-- Section Title Start -->
                <div class="section-title section-title-center">
                    <div class="section-bg-title wow fadeInUp">
                        <span>{{ $contact->subtitle }}</span>
                    </div>
                    <h3 class="wow fadeInUp" data-wow-delay="0.2s"> {{ $contact->subtitle }}</h3>
                    <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $contact->title }}</h2>
                </div>
                <!-- Section Title End -->
            </div>
        </div>

        <div class="row align-items-center">
            <div class="col-lg-6">
                <!-- Contact Us Image Start -->
                <div class="contact-us-image">
                    <figure class="image-anime reveal">
                        <img src="{{ asset('frontend/images/contact-us-image.jpg') }}" alt="">
                    </figure>
                </div>
                <!-- Contact Us Image End -->
            </div>

            <div class="col-lg-6">
                <!-- Contact Info List Start -->
                <div class="contact-info-list">
                    <!-- Contact Info Item Start -->
                    <div class="contact-info-item wow fadeInUp">
                        <div class="icon-box">
                            <i class="fa fa-phone text-white"></i>
                        </div>
                        <div class="contact-info-content">
                            <h3>{{ $contact->phone_text }}</h3>
                            <p><a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</p>

                        </div>
                    </div>
                    <!-- Contact Info Item End -->

                    <!-- Contact Info Item Start -->
                    <div class="contact-info-item wow fadeInUp" data-wow-delay="0.2s">
                        <div class="icon-box">
                            <img src="images/icon-mail-white.svg" alt="">
                        </div>
                        <div class="contact-info-content">
                            <h3>{{ $contact->email_text }}</h3>
                            <p><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></p>

                        </div>
                    </div>
                    <!-- Contact Info Item End -->

                    <!-- Contact Info Item Start -->
                    <div class="contact-info-item wow fadeInUp" data-wow-delay="0.4s">
                        <div class="icon-box">
                            <img src="images/icon-location-white.svg" alt="">
                        </div>
                        <div class="contact-info-content">
                            <h3>{{ $contact->location_text }}</h3>
                            <p>{{ $contact->location }}</p>
                        </div>
                    </div>
                    <!-- Contact Info Item End -->
                </div>
                <!-- Contact Info List End -->
            </div>

            <div class="col-lg-12">
                <!-- Contact Us Form Start -->
                <div class="conatct-us-form">
                    <!-- Google Map Iframe Start -->
                    <div class="google-map order-lg-1 order-2">

                        {!! $settings->maps !!}

                    </div>
                    <!-- Google Map Iframe End -->

                    <!-- Contact Form Start -->
                    <div class="contact-form dark-section order-lg-1 order-1">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h2 class="text-anime-style-2" data-cursor="-opaque">envoyez-nous un message</h2>
                        </div>
                        <!-- Section Title End -->

                        <!-- Contact Form Start -->
                        <form  action="{{ route('contact.send') }}" method="POST" data-toggle="validator" class="wow fadeInUp" data-wow-delay="0.2s">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6 mb-4">
                                    <input type="text" name="prenom" class="form-control" id="prenom" placeholder="Prénom" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-md-6 mb-4">
                                    <input type="text" name="nom" class="form-control" id="nom" placeholder="Nom" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-md-12 mb-5">
                                    <input type="text" name="phone" class="form-control" id="phone" placeholder="Numéro de téléphone" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-md-12 mb-5">
                                    <textarea name="message" class="form-control" id="message" rows="4" placeholder="Écrire un message..." required></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="contact-form-btn">
                                        <button type="submit" class="btn-default btn-highlighted">
                                            <span>Ajouter un message</span>
                                        </button>
                                        <div id="msgSubmit" class="h3 hidden"></div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- Contact Form End -->
                    </div>
                    <!-- Contact Form End -->
                </div>
                <!-- Contact Us Form End -->
            </div>
        </div>
    </div>
</div>
