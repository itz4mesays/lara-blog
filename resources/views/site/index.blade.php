@extends('layouts.main')

@section('content')

    <section class="slice py-7">
        <div class="container">
            <div class="row row-grid align-items-center">
                <div class="col-12 col-md-5 col-lg-6 order-md-2 text-center">
                    <!-- Image -->
                    <figure class="w-100">
                        <img alt="Image placeholder" src=" {{ asset('img/svg/illustrations/illustration-3.svg') }}" class="img-fluid mw-md-120">
                    </figure>
                </div>
                <div class="col-12 col-md-7 col-lg-6 order-md-1 pr-md-5">
                    <!-- Heading -->
                    <h1 class="display-4 text-center text-md-left mb-3">
                        We are about to get Blogified using <strong class="text-primary"> Laravel</strong>
                    </h1>
                    <!-- Text -->
                    <p class="lead text-center text-md-left text-muted">
                        Just a devGod understanding some more programming
                    </p>
                    <!-- Buttons -->
                    <div class="text-center text-md-left mt-5">
                        <a href="{{ url('/') }}" class="btn btn-primary btn-icon" target="_blank">
                            <span class="btn-inner--text">Get started</span>
                            <span class="btn-inner--icon"><i data-feather="chevron-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection