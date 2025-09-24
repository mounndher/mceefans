@php
    $features = \App\Models\features::first();
@endphp

<div class="our-features dark-section">
    <div class="container-fluid">
        <div class="row no-gutters">

            <div class="col-lg-6">
                <!-- Feature Image Content Start -->
                <div class="feature-image-content">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">{{ $features->title  }}</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $features->bigtitle }}</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">{{ $features->decription  }}</p>
                    </div>
                    <!-- Section Title End -->

                    <!-- Feature Button Start -->
                    
                    <!-- Feature Button End -->
                </div>
                <!-- Feature Image Content End -->
            </div>

            <div class="col-lg-6">
                <!-- Feature List Start -->
                <div class="feature-list">

                    @for($i = 1; $i <= 4; $i++)
                        @php
                            $line = 'linge'.$i;
                            $subtitle = 'subtitle'.$i;
                        @endphp
                        @if(!empty($features->$line) && !empty($features->$subtitle))
                            <div class="feature-list-item wow fadeInUp" data-wow-delay="{{ 0.2 * $i }}s">
                                <div class="icon-box">
                                    <img src="{{ asset('frontend/images/icon-feature-'.$i.'.svg') }}" alt="">
                                </div>
                                <div class="feature-item-content">
                                    <h3>{{ $features->$subtitle }}</h3>
                                    <p>{{ $features->$line }}</p>
                                </div>
                            </div>
                        @endif
                    @endfor

                </div>
                <!-- Feature List End -->
            </div>

        </div>
    </div>
</div>
