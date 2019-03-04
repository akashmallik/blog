@extends('layouts.frontend.app')

@push('css')
<link href="{{ asset('frontend/css/auth/styles.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/css/auth/responsive.css') }}" rel="stylesheet">  
@endpush

@section('content')
<div class="slider display-table center-text">
    <h1 class="title display-table-cell"><b>Register</b></h1>
</div><!-- slider -->

<section class="blog-area section">
    <div class="container">

        <div class="row">
            <div class="col-lg-2 col-md-0"></div>
            <div class="col-lg-8 col-md-12">
                <div class="post-wrapper">
                    <div class="card">
                        <div class="card-header">{{ __('Verify Your Email Address') }}</div>
        
                        <div class="card-body">
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                </div>
                            @endif
        
                            {{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                        </div>
                    </div>
                </div><!-- post-wrapper -->
            </div><!-- col-sm-8 col-sm-offset-2 -->
        </div><!-- row -->

    </div><!-- container -->
</section><!-- section -->
@endsection