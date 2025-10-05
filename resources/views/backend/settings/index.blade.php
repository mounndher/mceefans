@extends('backend.layouts.master')

@section('context')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Modifier les paramètres du site</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('settings.update',  1) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- ⚠️ utiliser PUT pour update -->

                    <!-- Nom du site -->
                    <div class="mb-3">
                        <label class="form-label">Nom du site</label>
                        <input type="text" class="form-control" name="site_name"
                               value="{{ old('site_name', $setting->site_name ?? '') }}"
                               placeholder="Nom du site">
                        @error('site_name')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">



                        <label class="form-label">Titre du site</label>


                        <input type="text" class="form-control" name="title"


                               value="{{ old('title', $setting->title ?? '') }}"


                               placeholder="Titre du site">


                        @error('title')


                        <div class="text-danger small">{{ $message }}</div>


                        @enderror


                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                         <label class="form-label">Description (SEO)</label>
                        <textarea class="form-control" name="description" rows="3"
                                  placeholder="Description">{{ old('description', $setting->description ?? '') }}</textarea>
                        @error('description')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                     <div class="mb-3">



                        <label class="form-label">Description du site (contenu)</label>


                        <textarea class="form-control" name="description_site" rows="3"


                                  placeholder="Description du site">{{ old('description_site', $setting->description_site ?? '') }}</textarea>


                        @error('description_site')


                        <div class="text-danger small">{{ $message }}</div>


                        @enderror


                    </div>





                    <!-- Keywords -->


                    <div class="mb-3">


                        <label class="form-label">Mots-clés (SEO)</label>


                        <textarea class="form-control" name="keywords" rows="2"


                                  placeholder="ex: ecommerce, boutique, vêtements">{{ old('keywords', $setting->keywords ?? '') }}</textarea>


                        @error('keywords')


                        <div class="text-danger small">{{ $message }}</div>


                        @enderror


                    </div>





                    <!-- Liens sociaux -->


                    <div class="mb-3">


                        <label class="form-label">Lien Facebook</label>


                        <input type="url" class="form-control" name="facebook_link"


                               value="{{ old('facebook_link', $setting->facebook_link ?? '') }}"


                               placeholder="https://facebook.com/...">


                        @error('facebook_link')


                        <div class="text-danger small">{{ $message }}</div>


                        @enderror


                    </div>





                    <div class="mb-3">


                        <label class="form-label">Lien Instagram</label>


                        <input type="url" class="form-control" name="instagram_link"


                               value="{{ old('instagram_link', $setting->instagram_link ?? '') }}"


                               placeholder="https://instagram.com/...">


                        @error('instagram_link')


                        <div class="text-danger small">{{ $message }}</div>


                        @enderror


                    </div>





                    <div class="mb-3">


                        <label class="form-label">Lien TikTok</label>


                        <input type="url" class="form-control" name="tiktok_link"


                               value="{{ old('tiktok_link', $setting->tiktok_link ?? '') }}"


                               placeholder="https://tiktok.com/@...">


                        @error('tiktok_link')


                        <div class="text-danger small">{{ $message }}</div>


                        @enderror


                    </div>





                    <!-- Maps -->


                    <div class="mb-3">


                        <label class="form-label">Google Maps (iframe ou lien)</label>


                        <textarea class="form-control" name="maps" rows="3"


                                  placeholder="Lien ou code embed Google Maps">{{ old('maps', $setting->maps ?? '') }}</textarea>


                        @error('maps')


                        <div class="text-danger small">{{ $message }}</div>


                        @enderror


                    </div>

                    <!-- Logo du site -->
                    <div class="mb-3">
                        <label class="form-label">Logo du site</label>
                        <input type="file" class="form-control" name="site_logo">
                        @if(!empty($setting->site_logo))
                        <div class="mt-2">
                            <img src="{{ asset($setting->site_logo) }}" alt="Logo du site" width="150">
                        </div>
                        @endif
                        @error('site_logo')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Favicon -->
                    <div class="mb-3">
                        <label class="form-label">Favicon</label>
                        <input type="file" class="form-control" name="site_favicon">
                        @if(!empty($setting->site_favicon))
                        <div class="mt-2">
                            <img src="{{ asset($setting->site_favicon) }}" alt="Favicon" width="50">
                        </div>
                        @endif
                        @error('site_favicon')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 text-center">
                        <button class="btn btn-primary" type="submit">Mettre à jour les paramètres</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
