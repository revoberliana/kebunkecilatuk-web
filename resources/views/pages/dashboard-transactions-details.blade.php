@extends('layouts.dashboard')

@section('title')
    KKA Dashboard Transaction Details
@endsection

@section('content')
   <!-- Section Content -->
    <div  class="section-content section-dashboard-home" 
          data-aos="fade-up"
          >
      <div class="container-fluid">
        <div class="dashboard-heading">
          <h2 class="dashboard-tittle">#{{  $transaction->code }}</h2>
          <p class="dashboard-subtittle">
            Transactions / details
          </p>
        </div>
        <div class="dashboard-content" id="transactionDetails">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12 col-md-4">
                      <img 
                      src="{{  Storage::url($transaction->product->galleries->first()->photos ?? '') }}" 
                      class="w-100 mb-3" 
                      alt=""
                      style="border-radius: 8px"
                      />
                    </div>
                    <div class="col-12 col-md-8">
                      <div class="row">
                        <div class="col-12 col-md-6">
                          <div class="product-tittle">Customer Name</div>
                          <div class="product-subtittle">{{  $transaction->transaction->user->name }}</div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-tittle">Product Name</div>
                          <div class="product-subtittle">
                            {{ $transaction->product->name }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-tittle">Date of Transaction</div>
                          <div class="product-subtittle">
                            {{ $transaction->created_at }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-tittle">Payment Status</div>
                          <div class="product-subtittle text-danger">
                            {{ $transaction->transaction->transaction_status }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-tittle">Total Amount</div>
                          <div class="product-subtittle">{{  number_format($transaction->transaction->total_price) }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-tittle">Mobile</div>
                          <div class="product-subtittle">{{ $transaction->transaction->user->phone_number }}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <form action="{{  route('dashboard-transaction-update', $transaction->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                    <div class="col-12 mt-4">
                      <h5>Shipping Information</h5>                      
                    </div>
                      <div class="col-12">
                      <div class="row">
                      <div class="col-12 col-md-6">
                          <div class="product-tittle">Address I</div>
                          <div class="product-subtittle">{{ $transaction->transaction->user->address_one }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-tittle">Address II</div>
                          <div class="product-subtittle">{{ $transaction->transaction->user->address_two }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-tittle">Province</div>
                          <div class="product-subtittle">
                            {{ App\Models\Province::find($transaction->transaction->user->provinces_id)->name }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-tittle">City</div>
                          <div class="product-subtittle">
                            {{ App\Models\Regency::find($transaction->transaction->user->regencies_id)->name }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-tittle">Postal Code</div>
                          <div class="product-subtittle">{{ $transaction->transaction->user->zip_code }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-tittle">Country</div>
                          <div class="product-subtittle"> {{ $transaction->transaction->user->country }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                         <div class="product-tittle">Shiping Status</div>
                         <div class="product-subtittle"> {{ $transaction->transaction->transaction_status }}
                          </div>
                          </div>
                        <div class="col-12 col-md-6">
                         <div class="product-tittle">Hubungi Penjual</div>
                           <a href="https://wa.me/+6231283128831"class="card"> 
                            <div class="col-md-3">
                                <img src="/images/chat-icon.svg" alt="">
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
@endsection

@push('adddon-script')
     <script src="/vendor/vue/vue.js"></script>
   <script>
     var transactionDetails = new Vue({
       el: '#transactionDetails',
       data: {
         status: "{{  $transaction->shipping_status }}",
         resi: "{{ $transaction->resi }}",
       },
     });
   </script>
@endpush