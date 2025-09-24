@php
    // Fetch only 4 services from DB
    $services = \App\Models\Service::latest()->take(4)->get();
@endphp

<div class="our-services">
    <div class="container-fluid">
        <div class="row no-gutters service-list">
            @foreach($services as $service)
                <div class="col-lg-3 col-md-6">
                    <!-- Service Item Start -->
                    <div class="service-item">
                        <!-- Service Image Start -->
                        <div class="service-image">

                                <figure>
                                    <img src="{{ asset($service->iamge) }}" alt="{{ $service->title }}">
                                </figure>
                            
                        </div>
                        <!-- Service Image End -->

                        <!-- Service Body Start -->
                        <div class="service-body">
                            <!-- Service Body Title Start -->
                            <div class="service-body-title">
                                <h3>{{ $service->title }}</h3>
                            </div>
                            <!-- Service Body Title End -->

                            <!-- Service Content Box Start -->
                            <div class="service-content-box">
                                <!-- Service Content Start -->
                                <div class="service-content">
                                    <p>{{ $service->subtitle }}</p>
                                </div>
                                <!-- Service Content End -->

                                <!-- Service Readmore Button Start -->
                                <div class="service-readmore-btn">
                                    <a href="#">
                                        <img src="{{ asset('frontend/images/arrow-accent.svg')}}" alt="">
                                    </a>
                                </div>
                                <!-- Service Readmore Button End -->
                            </div>
                            <!-- Service Content Box End -->
                        </div>
                        <!-- Service Body End -->
                    </div>
                    <!-- Service Item End -->
                </div>
            @endforeach
        </div>
    </div>
</div>
