@php
    $success = \App\Models\Success::first();
@endphp

@if($success)
<div class="club-success dark-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <!-- Club Success Image Start -->
                <div class="club-success-image">
                    <figure>
                        <img src="{{ asset($success->image) }}" alt="Success Image">
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
                            <span>Success</span>
                        </div>
                        <h3 class="wow fadeInUp" data-wow-delay="0.2s">{{ $success->title }}</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $success->subtitle }}</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.4s">{{ $success->descrition }}</p>
                    </div>
                    <!-- Section Title End -->

                    <!-- Club Success List Start -->
                    <div class="club-success-list">

                        <!-- Phrase 1 -->
                        <div class="club-success-item wow fadeInUp" data-wow-delay="0.6s">
                            <div class="icon-box">
                                <img src="{{ asset('frontend/images/icon-check.svg')}}" alt="">
                            </div>
                            <div class="club-success-item-content">
                                <h3>{{ $success->pharse1 }}</h3>
                                <p>{{ $success->textpharse1 }}</p>
                            </div>
                        </div>

                        <!-- Phrase 2 -->
                        <div class="club-success-item wow fadeInUp" data-wow-delay="0.6s">
                            <div class="icon-box">
                                <img src="{{ asset('frontend/images/icon-check.svg')}}" alt="">
                            </div>
                            <div class="club-success-item-content">
                                <h3>{{ $success->pharse2 }}</h3>
                                <p>{{ $success->textpharse2 }}</p>
                            </div>
                        </div>

                        <!-- Phrase 3 -->
                        <div class="club-success-item wow fadeInUp" data-wow-delay="0.8s">
                            <div class="icon-box">
                                <img src="{{ asset('frontend/images/icon-check.svg')}}" alt="">
                            </div>
                            <div class="club-success-item-content">
                                <h3>{{ $success->pharse3 }}</h3>
                                <p>{{ $success->textpharse3 }}</p>
                            </div>
                        </div>

                        <!-- Phrase 4 -->
                        <div class="club-success-item wow fadeInUp" data-wow-delay="0.8s">
                            <div class="icon-box">
                                <img src="{{ asset('frontend/images/icon-check.svg')}}" alt="">
                            </div>
                            <div class="club-success-item-content">
                                <h3>{{ $success->pharse4 }}</h3>
                                <p>{{ $success->textpharse4 }}</p>
                            </div>
                        </div>

                    </div>
                    <!-- Club Success List End -->
                </div>
                <!-- Club Success Content End -->
            </div>
        </div>
    </div>
</div>
@endif
