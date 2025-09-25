@php
    $cart = \App\Models\VotreCart::first();
@endphp
<div class="why-choose-us">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <!-- Why Choose Image Start -->
                <div class="why-choose-image">
                    <figure>
                          <img src="{{ asset($cart->image) }}" alt="">
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
                            <span> {{ $cart->title }}</span>
                        </div>
                        <h3 class="wow fadeInUp" data-wow-delay="0.2s">{{ $cart->title }}</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">
                              {{ $cart->subtitle  }}
                        </h2>
                        </h2>
                        <p class="wow fadeInUp" data-wow-delay="0.4s">
                             {{ $cart->description}}
                        </p>
                    </div>
                    <!-- Section Title End -->

                    <!-- ✅ Tracking Form Start -->
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

                                <div class="form-group col-md-12 mb-5">
                                    <input type="text" name="phone" class="form-control" id="phone" placeholder="Numéro de téléphone" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-md-12 mb-5">
                                    <input type="text" name="phone" class="form-control" id="phone" placeholder="Numéro de téléphone" required>
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
                    <!-- ✅ Tracking Form End -->

                </div>
                <!-- Why Choose Content End -->
            </div>
        </div>
    </div>
</div>
