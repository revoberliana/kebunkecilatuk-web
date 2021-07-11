@extends('layouts.dashboard')

@section('title')
    KKA Dashboard  Product Detail
@endsection

@section('content')
     
    <!-- Section Content -->
    <div class="section-content section-dashboard-home" data-aos="fade-up">
      <div class="container-fluid">
        <div class="dashboard-heading">
          <h2 class="dashboard-tittle">Aglaonema Cinta</h2>
          <p class="dashboard-subtittle">
            Product Details
          </p>
        </div>
        <div class="dashboard-content">
          <div class="row">
            <div class="col-12">
               @if($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ( $errors->all() as $error )
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
              @endif
              <form action="{{  route('dashboard-product-update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="users_id" value="{{  Auth::user()->id }}">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label> Product Name</label>
                          <input type="text" class="form-control" value="{{  $product->name }}"/>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label> Price</label>
                          <input type="number" class="form-control" value="50.000"/>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Kategori</label>
                          <select name="category" class="form-control" value ="">
                            <option value="" disabled
                            >Select Category</option
                            >
                          </select>
                        </div>
                        </div>
                         <div class="col-md-12">
                        <div class="form-group">
                          <label>Description</label>
                          <textarea name="editor"></textarea>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                        <div class="col text-right">
                          <button
                          type="submit"
                          class="tbn btn-success px-5 btn-block"
                          >
                        Save Now
                      </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  </form>
                </div>
            </div>
            </div>
            <div class="row mt-2">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                <div class="row">
                  <div class="col-md-4">
                    <div class="gallery-container">
                      <img src="/images/product-card-1.jpg" alt="" class="w-100">
                      <a href="#" class="delete-gallery">
                        <img src="/images/icon-delete.svg" alt="">
                      </a>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="gallery-container">
                      <img src="/images/product-card-2.jpg" alt="" class="w-100">
                      <a href="#" class="delete-gallery">
                        <img src="/images/icon-delete.svg" alt="">
                      </a>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="gallery-container">
                      <img src="/images/product-card-3.jpg" alt="" class="w-100">
                      <a href="#" class="delete-gallery">
                        <img src="/images/icon-delete.svg" alt="">
                      </a>
                    </div>
                  </div>
                  <div class="col-12">
                    <input type="file" id="file" style="display: none;" multiple>
                    <button class="btn btn-secondary btn-block mt-3" onclick="thisFileUpload()">
                      Add Photo
                    </button>
                  </div>
                </div>
              </div>
              </div>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
      </div>
    </div>
    </div>
@endsection

@push('addon-script')
     <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
   <script>
     function thisFileUpload() {
     document.getElementById("file").click()
   }
   </script>
   <script>
     CKEDITOR.replace('editor');
   </script>
@endpush