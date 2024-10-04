@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row px-4">
            <div class="col-12 col-md-4">
                @if ($contact->profile_picture_url)
                    <div class="card card-custom mb-5">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <img src="{{ $contact->profile_picture_url }}" class="w-100 rounded" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="card card-custom">
                    <div class="card-header">
                        <div class="card-title justify-content-center w-100 mx-0">
                            <h3 class="card-label text-center mx-0">Public Link</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-center">
                                <div id="qrcode"></div>
                                <a id="download_image" class="btn btn-light-primary mt-10" href="#" target="_blank" download="qrcode.png"> Download Image </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8">
                <div class="card card-custom">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">Contact Detail</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <x-contact-detail :contact="$contact" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/easy.qrcode.js') }}"></script>
    <script>
        (function($) {
            "use strict";

            var qrcode;

            $(document).ready(function() {
                $('#qrcode').html('');
                var link = "{{ route('public-contact-detail', ['contact_code' => $contact->contact_code]) }}";
                var color = '#000000';

                var opts = {
                    text: link,
                    margin: 4,
                    width: 256,
                    height: 256,
                    quietZone: 20,
                    colorDark: color,
                    colorLight: "#ffffffff",
                }

                // if ($('#title').val().trim() !== '') {
                //     opts.title = $('#title').val();
                //     opts.titleFont = "bold 18px Arial";
                //     opts.titleColor = "#004284";
                //     opts.titleBackgroundColor = "#ffffff";
                //     opts.titleHeight = 60;
                //     opts.titleTop = 20;
                // }

                // if ($('#subtitle').val().trim() !== '') {
                //     opts.subTitle = $('#title').val();
                //     opts.subTitleFont = "14px Arial";
                //     opts.subTitleColor = "#4F4F4F";
                //     opts.subTitleTop = 40;
                // }

                // if ($('#show_logo').is(':checked')) {
                opts.logo = `data:image/png;base64,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`;
                // }

                new QRCode(document.getElementById("qrcode"), opts);
            });
        })(jQuery);

        $('#download_image').click(function(e) {
            let downloadImageElement = document.getElementById("download_image");
            downloadImageElement.href = document.getElementById("qrcode").querySelector("canvas").toDataURL("image/png");
        });
    </script>
@endpush