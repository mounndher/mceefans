 @php

    $hero = \App\Models\Hero::first();
@endphp
 <div class="hero hero-bg-image dark-section parallaxie" style="background-image: url('{{ asset($hero->image ?? 'frontend/images/hero-image (1).png') }}');">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <!-- Hero Content Start -->
                    <div class="hero-content">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">{{ $hero->subtitle }}.</h3>
                            <h1 class="text-anime-style-2" data-cursor="-opaque">{{ $hero->title }}</h1>
                        </div>
                        
                    </div>
                    <!-- Hero Content End -->
                </div>
            </div>
        </div>
</div>
