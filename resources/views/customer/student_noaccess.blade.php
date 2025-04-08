@extends('layouts.cms')
@section('content')

<section class="page-banner text-center text-white shape-page-banner">
            <div class="banner-img">
                <img src="{{ asset('/storage/tutors/tutor-details-bg.jpg') }}" alt="">
            </div>
            
            <div class="wave-shape">
                <svg width="1920" height="220" viewBox="0 0 1920 220" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1053.24 189.748C299.711 239.656 -19.6444 -62.5258 -36.6941 11.843C-53.7438 86.2118 -184.684 219.5 23.302 219.5H1947.18C1955.34 29.326 1966.78 172.932 1947.18 154.744C1922.83 132.15 1808.19 139.743 1067.11 188.829L1053.24 189.748Z" fill="#F5F5F7"></path>
                </svg>
            </div>
        </section>

<section class="subject-full-details pb-0">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <h2 class="section-heading">No Access Error</h2>
                        <p> We have encountered a security issue with the page you were trying to view - on viewing this page we have been alerted of this problem.</p>
                        <p>If you are unsure why this occured please <a href="{{url('/contact-us')}}">let us know</a>.</p>
                    </div>
                </div>
            </div>
        </section>
@endsection
