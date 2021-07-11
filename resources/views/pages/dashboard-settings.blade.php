@extends('layouts.dashboard')

@section('title')
    Store Settings
@endsection

@section('content')
       <!-- Section Content -->
    <div class="section-content section-dashboard-home" data-aos="fade-up">
      <div class="container-fluid">
        <div class="dashboard-heading">
          <h2 class="dashboard-tittle">Store Settings</h2>
          <p class="dashboard-subtittle">
            Make Kebun Kecil Atuk profitable
          </p>
        </div>
        <div class="dashboard-content">
          <div class="row">
            <div class="col-12">
              <form action="{{  route('dashboar-settings-redirect','dashboard-settings-store') }}" method="POST" enctype="multipart/form-data">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Store Name</label>
                          <input type="text" class="form-control" name="store_name" value="{{ $user->store_name }}"/>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Category</label>
                          <select name="categories_id" class="form-control">
                            <option value="{{ $user->categories_id}}">Tidak diganti</option>
                            @foreach ($categories as $category )
                            <option value="{{  $category->id }}">{{  $category->name }}</option>
                          @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Store</label>
                          <p class="text-muted">
                            Apakah anda ingin membuka toko?
                          </p>
                          <div class="custom-control custom-radio custom-control-inline">
                            <input 
                            type="radio"
                            class="custom-control-input"
                            name="store_status"
                            id="openStoreTrue"
                            value="1"
                            {{  $user->store_status == 1 ? 'checked' : '' }}
                            />
                            <label for="openStoreTrue" class="custom-control-label">
                              Bukka
                            </label>
                          </div>
                          <div class="custom-control custom-radio custom-control-inline">
                            <input 
                            type="radio"
                            class="custom-control-input"
                            name="is_store_open"
                            id="openStoreFalse"
                            value="0"
                            {{  $user->store_status == 0 || $user->store_status == NULL ? 'checked' : '' }}
                            />
                            <label for="openStoreFalse" class="custom-control-label">
                              Sementara Tutup
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
      </div>
    </div>
    </div> 
@endsection