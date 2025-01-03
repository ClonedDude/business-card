@extends('layouts.business-card')

@push('head')
    <style>
        @media (min-width: 1px) {
            .hero-content {
                white-space: normal !important;
                min-width: 360px;
                padding: 0;
            }

            .hero-container {
                height: calc(100vh);
            }

            .hero-content:before {
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100vw;
                height: calc(100vh);
                max-width: none;
                background: rgba(255,255,255,0.1);
                content: "";
            }

            .btn, .social-icons {
                z-index: 1;
                position: relative;
            }
            
        }

        @media (min-width: 576px) {
            .hero-container {
                height: calc(100vh - 10rem);
            }

            .hero-content:before {
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                height: calc(100vh - 10rem);
                /* max-width: 400px; */
                background: rgba(255,255,255,0.1);
                content: "";
                z-index: -1;
            }
        }
        @media (min-width: 768px) {}
        @media (min-width: 992px) {}
        @media (min-width: 1200px) {}
        @media (min-width: 1400px) {}

        html {
            scroll-snap-type: y mandatory;
        }
        .hero-section, .info-section{
            scroll-snap-align: start;
            scroll-snap-stop: always;
        }
        .hero-section {
            position: relative;
            top: 0;
            left: 0;
            width: calc(100vw - 0rem);
            height: calc(100vh - 0rem);
            /* background: #000; */
        }

        .hero-section:before {
            position: absolute !important;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('{{ $contact->profile_picture_url ?? asset('assets/images/contact-hero-section-picture.jpg') }}');
            background-size: cover;
            background-position: center;
            z-index: -3;
            content: "";
        }

        .hero-section:after {
            position: absolute !important;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(0deg, rgba(0,0,0,1), rgba(0,0,0,0.6), rgba(0,0,0,0.4), rgba(0,0,0,0.2));
            z-index: -2;
            content: "";
        }

        .hero-container {
            height: calc(100vh);
        }

        .hero-content {
            white-space: nowrap;
            max-width: 400px;
        }

        .bg-dark {
            background: #000 !important;
        }

        .bg-less-dark {
            background: rgba(217, 217, 217, 0.1);
        }
        .menu-left, .menu-right {
            position: fixed;
            top: 10px;
            /* right: 20px; */
            display: flex;
            z-index: 10;
        }
        .menu-right {
            right: 10px;
        }
        .icon {
            background-color: rgba(51, 51, 51, 0.7);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .icon:hover {
            background-color: rgba(85, 85, 85, 0.9);
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section -->
    
    <div class="hero-section text-white d-flex align-items-center p-0">
        <!--Menu Item-->
        <div class="menu-left">
            <a href="{{ route('contacts.index') }}">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-asterisk" viewBox="0 0 16 16">
                        <path d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1"/>
                    </svg>
                </div>
            </a>
        </div>
        <div class="menu-right">
            <a href="{{ route('public-download-vcard', [$contact_code]) }}" class="text-white">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                        <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                        <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5"/>
                    </svg>
                </div>
            </a>
            @if ($contact->website_url)
                <a href="{{ $contact->website_url }}" class="text-white">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-globe2" viewBox="0 0 16 16">
                            <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m7.5-6.923c-.67.204-1.335.82-1.887 1.855q-.215.403-.395.872c.705.157 1.472.257 2.282.287zM4.249 3.539q.214-.577.481-1.078a7 7 0 0 1 .597-.933A7 7 0 0 0 3.051 3.05q.544.277 1.198.49zM3.509 7.5c.036-1.07.188-2.087.436-3.008a9 9 0 0 1-1.565-.667A6.96 6.96 0 0 0 1.018 7.5zm1.4-2.741a12.3 12.3 0 0 0-.4 2.741H7.5V5.091c-.91-.03-1.783-.145-2.591-.332M8.5 5.09V7.5h2.99a12.3 12.3 0 0 0-.399-2.741c-.808.187-1.681.301-2.591.332zM4.51 8.5c.035.987.176 1.914.399 2.741A13.6 13.6 0 0 1 7.5 10.91V8.5zm3.99 0v2.409c.91.03 1.783.145 2.591.332.223-.827.364-1.754.4-2.741zm-3.282 3.696q.18.469.395.872c.552 1.035 1.218 1.65 1.887 1.855V11.91c-.81.03-1.577.13-2.282.287zm.11 2.276a7 7 0 0 1-.598-.933 9 9 0 0 1-.481-1.079 8.4 8.4 0 0 0-1.198.49 7 7 0 0 0 2.276 1.522zm-1.383-2.964A13.4 13.4 0 0 1 3.508 8.5h-2.49a6.96 6.96 0 0 0 1.362 3.675c.47-.258.995-.482 1.565-.667m6.728 2.964a7 7 0 0 0 2.275-1.521 8.4 8.4 0 0 0-1.197-.49 9 9 0 0 1-.481 1.078 7 7 0 0 1-.597.933M8.5 11.909v3.014c.67-.204 1.335-.82 1.887-1.855q.216-.403.395-.872A12.6 12.6 0 0 0 8.5 11.91zm3.555-.401c.57.185 1.095.409 1.565.667A6.96 6.96 0 0 0 14.982 8.5h-2.49a13.4 13.4 0 0 1-.437 3.008M14.982 7.5a6.96 6.96 0 0 0-1.362-3.675c-.47.258-.995.482-1.565.667.248.92.4 1.938.437 3.008zM11.27 2.461q.266.502.482 1.078a8.4 8.4 0 0 0 1.196-.49 7 7 0 0 0-2.275-1.52c.218.283.418.597.597.932m-.488 1.343a8 8 0 0 0-.395-.872C9.835 1.897 9.17 1.282 8.5 1.077V4.09c.81-.03 1.577-.13 2.282-.287z"/>
                        </svg>
                    </div>
                </a>
            @endif
            <a href="#" class="text-white share-button" onclick="shareCurrentLink()">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-share-fill" viewBox="0 0 16 16">
                        <path d="M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.5 2.5 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5"/>
                    </svg>
                </div>
            </a>
        </div>
        <!--End-->

        <div class="hero-container container text-left d-flex align-items-end p-0" style="">
            <div class="hero-content position-relative p-10">
                <div class="align-bottom d-block">
                    <h5 class="text-white fs-4">Hi, I'm</h5>
                    <h1 class="text-white fs-1">
                        {{ $contact->name }}
                    </h1>
                    <p class="text-white fs-3">
                        {{ $contact->subtitle }}
                    </p>
                    <div class="social-icons my-3">
                        @foreach ($contact->external_links as $external_link)
                            <a href="{{ $external_link->url }}" target="__blank" class="text-white me-3" style="width: 20px">
                                {!! $external_link->external_link_type->svg !!}
                            </a>
                        @endforeach
                    </div>
                    <div class="mt-4 d-flex justify-content-between flex-row flex-wrap">
                        <a
                            href="{{ route('public-download-vcard', [$contact->contact_code]) }}" class="btn my-2 me-2 btn-outline-light"
                            style="border: 1px solid #fff">
                            SAVE CONTACT
                        </a>
                        @if($contact->website_url)
                            <a href="https://{{ $contact->website_url }}" class="btn my-2 btn-light text-dark" target="_blank" rel="noopener noreferrer">
                                GO TO WEBSITE
                            </a>
                        @else
                            <p class="text-danger">Invalid URL</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="info-section">
        <!-- Contact Info Section -->
        <div class="contact-info-section py-10 text-white px-0">
            <div class="container px-md-0">
                <div class="row py-10 mb-15 mx-0">
                    <div class="col-12 col-md-6 d-sm-none align-items-center justify-content-center d-flex mb-20">
                        <blockquote class="blockquote">
                            <h1 class="fs-1 p-0 m-0 text-white">
                                {{ $contact->quote ?? "Brace The Truth, It Makes Me" }}
                            </h1>
                        </blockquote>
                    </div>
                    <div class="col-12 col-md-6 d-flex align-items-center">
                        <div class="card  w-100" style="background: rgba(255,255,255,0.1)">
                            <div class="card-body text-white w-100">
                                <h4 class="fs-1 text-white">
                                    {{ $contact->name }}
                                </h4>
                                <p class="fs-3 mb-10">
                                    {{ $contact->job_title }}
                                </p>
                                <p class="fs-3 mb-0">
                                    {{ $contact->phone_number }}
                                </p>
                                <p class="fs-3">
                                    {{ $contact->email }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6  d-sm-flex d-none align-items-center justify-content-center mt-20 pt-20 mt-md-0 pt-md-0">
                        <blockquote class="blockquote">
                            <h1 class="fs-1 p-0 m-0 text-white">
                                {{ $contact->quote ?? "Brace The Truth, It Makes Me" }}
                            </h1>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Company Info Section -->
        <div class="company-info-section bg-less-dark text-white px-0">
            <div class="container px-0">
                <div class="row  mx-0">
                    <div class="col-md-6 py-10 px-10 px-md-4 mb-md-0 d-flex align-items-center">
                        <div>
                            <h5 class="fs-1 text-white">
                                {{ $contact->company->name }}
                            </h5>
                            <p class="fs-4">
                                {{ $contact->company->address }}
                            </p>
                            <p  class="fs-4">
                                <a href="mailto:{{ $contact->company->email }}" target="_blank">{{ $contact->company->email }}</a>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ $contact->company->company_picture_url ?? asset('assets/images/contact-business-picture.jpg') }}" class="img-fluid" alt="Company">
                    </div>
                </div>
            </div>
        </div>

        <div class="text-light text-center p-10 fs-4">
            &copy;copyright reserved by iscadanet
        </div>
    </div>
    <script>
        function shareCurrentLink() {
            const url = window.location.href;
    
            if (navigator.share) {
                navigator.share({
                    title: document.title,
                    text: 'Check out this site!',
                    url: url
                }).then(() => {
                    console.log('Thanks for sharing!');
                }).catch((error) => {
                    console.error('Something went wrong sharing the link', error);
                });
            } else {
                // Fallback for browsers that do not support the Web Share API
                alert('Your browser does not support the Web Share API. Here is the URL: ' + url);
            }
        }
    </script>
    
@endsection
