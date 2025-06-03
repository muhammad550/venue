@extends('layouts.user')

@section('head')
<style>
	.card {
    border-radius: 10px;
}
.card .card-title {
    font-size: 1.5rem;
}
.card h2 {
    font-size: 2rem;
}
ul li {
    margin-bottom: 10px;
}

</style>
@endsection

@section('content')
<div class="row justify-content-center mb-5">
    <!-- Free Plan -->
    <div class="col-md-4 mb-4">
        <div class="card h-100 text-center shadow-sm border-0">
            <div class="card-body">
                <h5 class="card-title font-weight-bold">Free</h5>
                <h2 class="my-3">$0 <small class="text-muted">/month</small></h2>
                <p class="text-muted">0% platform fee*</p>
                <a href="/stripe-checkout" class="btn btn-primary mb-3">Pay with Stripe</a>
                <ul class="list-unstyled text-start px-4">
                    
                    <li><span class="text-success">✔</span> 2 Properties</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Pro Plan -->
    <div class="col-md-4 mb-4">
        <div class="card h-100 text-center shadow border border-primary" style="background-color: #0c0c3c; color: #fff;">
            <div class="card-body">
                <h5 class="card-title font-weight-bold text-light">Basic</h5>
                <h2 class="my-3 text-light">$75 <small class="text-light">/month</small></h2>
                <p class="text-light">10% platform fee</p>
                <a href="{{route('user.stripe-checkout')}}" class="btn btn-primary mb-3">Pay with Stripe</a>
                <ul class="list-unstyled text-start px-4">
                    
                    <li><span class="text-success">✔</span> 5 Properties</li>
                    
                </ul>
            </div>
        </div>
    </div>

    <!-- Premium Plan -->
    <div class="col-md-4 mb-4">
        <div class="card h-100 text-center shadow-sm border-0">
            <div class="card-body">
                <h5 class="card-title font-weight-bold">Standerd</h5>
                <h2 class="my-3">Contact Support</h2>
                <p class="text-muted">Custom plan</p>
                <a href="#" class="btn btn-primary mb-3">Pay with Stripe</a>
                <ul class="list-unstyled text-start px-4">
                    <li><span class="text-success">✔</span> Unlimited Properties</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection
