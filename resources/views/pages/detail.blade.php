@extends('layouts.app')

@section('title')
    KKA Detail Page
@endsection

@section('content')

     <!-- Page Content -->
<div class="page-content page-details">
  <section 
  class="store-breadcrumbs"
  data-aos="fade-down" 
  data-aos-delay="100"
  >
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">
                Product Details
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>

 <section class="store-gallery mb-3" id="gallery">
        <div class="container">
          <div class="row">
            <div class="col-lg-8" data-aos="zoom-in">
              <transition name="slide-fade" mode="out-in">
                <img
                  :key="photos[activePhoto].id"
                  :src="photos[activePhoto].url"
                  class="w-100 main-image"
                  alt=""
                />
              </transition>
            </div>
            <div class="col-lg-2">
              <div class="row">
                <div
                  class="col-3 col-lg-12 mt-2 mt-lg-0"
                  v-for="(photo, index) in photos"
                  :key="photo.id"
                  data-aos="zoom-in"
                  data-aos-delay="100"
                >
                  <a href="#" @click="changeActive(index)">
                    <img
                      :src="photo.url"
                      class="w-100 thumbnail-image"
                      :class="{ active: index == activePhoto }"
                      alt=""
                    />
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

  <div class="store-details-container" data-aos="fade-up">
    <section class="store-heading">
      <div class="container">
        <div class="row">
        <div class="col-lg-8">
        <h1>{{ $product -> name}}</h1>
        <div class="price">Rp{{number_format($product->price)}}</div>
      </div>
      <div class="col-lg-2" data-aos="zoom-in">
         @auth
            <form action="{{ route('detail-add',$product->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <button
                    class="btn btn-success px-4 text-white btn-block mb-3"
                    type="submit"
                  >
                    Add to Cart
                  </button>
            </form>
        @else
                <a
                href="{{route('login')}}"
                class="btn btn-success  text-white btn-block mb-3"
                  >Sign in to add
                </a>
        @endauth
      </div>
        </div>
      </div>
    </section>
    <section class="store-description">
      <div class="container">
        <div class="row">
          <div class="col-12 col-lg-6">
           {!! $product ->description !!}
          </div>
        </div>
      </div>
    </section>
    <section class="store-review">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-lg-8 mt-3 mb-3">
            <h5>Customer Review</h5>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-lg-8">
            <ul class="list-unstyled">
              <li class="media">
                <img src="/images/icons-testimonials-1.jpg" 
                alt="" 
                class="mr-3 rounded-circle"
                />
                <div class="media-body">
                  <h5 class="mt-2 mb-1">Amelia Dwi Indriani</h5>
                  Bagus bangett tanemannya cocok banget buat ruang kerja ku
                </div>
              </li>
              <li class="media">
                <img src="/images/icons-testimonials-2.jpg" 
                alt="" 
                class="mr-3 rounded-circle"
                />
                <div class="media-body">
                  <h5 class="mt-2 mb-1">Sufi J P</h5>
                 Istri saya sangat menyukainya!!!
                </div>
              </li>
              <li class="media">
                <img src="/images/icons-testimonials-3.jpg" 
                alt="" 
                class="mr-3 rounded-circle"
                />
                <div class="media-body">
                  <h5 class="mt-2 mb-1">Dakimu Wangi</h5>
                  pertama kali melihat fotonya sudah langsung jatuh cinta 
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>


@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script>
        var gallery = new Vue({
          el: "#gallery",
        mounted() {
          AOS.init();
        },
        data: {
          activePhoto: 0,
          photos: [
           @foreach($product->galleries as $gallery)
            {
              id: {{ $gallery->id }},
              url: "{{ Storage::url($gallery->photos) }}",
            },
          @endforeach
          ],
        },
        methods: {
          changeActive(id) {
            this.activePhoto = id;
          },
        },
      }); 
    </script>
@endpush