@extends('layouts.dashboard')

@section('title')
    KKA Dashboard 
@endsection

@section('content')

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/60eefe34649e0a0a5ccc332b/1faip1vsn';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

       <!-- Section Content -->
    <div class="section-content section-dashboard-home" data-aos="fade-up">
      <div class="container-fluid">
        <div class="dashboard-heading">
          <h2 class="dashboard-tittle">Dashboard</h2>
          <p class="dashboard-subtittle">
            Look what you have made today!
          </p>
        </div>
        <div class="dashboard-content">
          <div class="row">
            <div class="col-md-3">
              <div class="card mb-1">
                <div class="card-body">
                  <div class="dashboard-card-tittle">
                    Transaction
                  </div>
                  <div class="dashboard-card-subtittle">
                    {{ number_format($transaction_count) }}
                  </div>
                </div>
              </div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-10 mt-2">
            <h5 class="mb-3">Recent Transaction</h5>
           @foreach ($transaction_data as $transaction)
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
        </div>
        </div>
      </div>
    </div>
@endsection