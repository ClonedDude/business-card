<!DOCTYPE html>
<html lang="en">
	<head><base href="">
		<title>Business Card</title>
		<meta charset="utf-8" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="shortcut icon" href="{{ asset("assets/admin/images/logo.png") }}" type="image/x-icon">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Round">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">
		{{-- <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
		<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
		<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
		<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
		@vite(['resources/sass/app.scss'])
		<link href="{{ asset('assets/admin/css/style.bundle.css') }}" rel="stylesheet" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		@livewireStyles
		@stack('head')

		<style>
			.modal {
				z-index: 99999;
			}
		</style>
	</head>
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
		<div class="d-flex flex-column flex-root">
			<div class="page d-flex flex-row flex-column-fluid">
                @auth
                    <x-admin-aside />
                    <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
						<x-header />
                        <div class="content d-flex flex-column flex-column-fluid pt-8" id="kt_content">
                            @yield('content')
                        </div>
                    </div>
                @else
                    <div class="container">
                        <div class="w-100 row d-flex align-items-center" style="min-height: 100vh">
                            @yield('content')
                        </div>
                    </div>
                @endauth
			</div>
		</div>

		<script src="{{ asset("assets/admin/js/scripts.bundle.js") }}"></script>
		<script src="{{ asset("assets/admin/plugins/global/plugins.bundle.js")}}"></script>

		<script>
			const myDefaultAllowList = bootstrap.Tooltip.Default.allowList;

			myDefaultAllowList.div = ["class"];
			myDefaultAllowList.form = ["class", "action", "method"];
			myDefaultAllowList.button = ["type", "class", "onclick"];
			myDefaultAllowList.input = ["type", "class", "value", "name"];
		</script>

		@if (session("error"))
			<script>
				Swal.fire({
					text: "{{ session('error') }}!",
					icon: "error",
					buttonsStyling: false,
					confirmButtonText: "Close Message!",
					customClass: {
						confirmButton: "btn btn-danger"
					}
				});
			</script>
		@elseif (session("success"))
			<script>
				Swal.fire({
					text: "{{ session('success') }}",
					icon: "success",
					buttonsStyling: false,
					confirmButtonText: "Ok, got it!",
					customClass: {
						confirmButton: "btn btn-success"
					}
				});
			</script>
		@endif

		@livewireScripts()
		@livewireScriptConfig()
		
		@stack('scripts')

		{{-- @livewire('javascript-executor') --}}
	</body>
</html>