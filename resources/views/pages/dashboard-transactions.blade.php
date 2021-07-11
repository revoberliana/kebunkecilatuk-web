@extends('layouts.dashboard')

@section('title')
    KKA Dashboard Transaction
@endsection

@section('content')
    <!-- Section Content -->
    <div class="section-content section-dashboard-home" data-aos="fade-up">
      <div class="container-fluid">
        <div class="dashboard-heading">
          <h2 class="dashboard-tittle">Transactions</h2>
          <p class="dashboard-subtittle">
            Disini Ada Disana Gaada
          </p>
        </div>
        <div class="dashboard-content">
        <div class="row ">
          <div class="col-12 mt-2">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
         <li class="nav-item" role="presentation">
           <a
           class="nav-link active" 
           id="pills-home-tab" 
           data-toggle="pill" 
           href="#pills-home"  
           role="tab" 
           aria-controls="pills-home" 
           aria-selected="true"
           >Buy Product</a>
        </li>
    </ul>
<div class="tab-content" id="pills-tabContent">
  <div 
  class="tab-pane fade show active" 
  id="pills-home" 
  role="tabpanel" 
  aria-labelledby="pills-home-tab"
  >
   @foreach ($buyTransaction as $transaction)
              <a 
            href="{{ route('dashboard-transaction-details', $transaction->id) }}" 
            class="card card-list d-block"
            >
          <div class="card-body">
            <div class="row">
             <div class="col-md-1">
                <img 
                src="{{  Storage::url($transaction->product->galleries->first()->photos ?? '') }}" 
                class="w-75"
                />
             </div>
             <div class="col-md-4">
               {{ $transaction->product->name ?? '' }}
             </div>
             <div class="col-md-3">
                {{  $transaction->transaction->user->name ?? '' }}
             </div>
             <div class="col-md-3">
               {{  $transaction->created_at->format('d-m-Y') ?? '' }}
             </div>
             <div class="col-md-1 d-none d-md-block">
               <img src="/images/dashboard-arrow-right.svg" alt=""/>
             </div>
            </div>
          </div>
          </a>
           @endforeach
           

</div>
<div 
  class="tab-pane fade" 
  id="pills-profile" 
  role="tabpanel" 
  aria-labelledby="pills-profile-tab"
  >
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