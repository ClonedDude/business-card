<div id="kt_header" style="" class="header align-items-stretch">
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
            <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
                id="kt_aside_mobile_toggle">
                <span class="svg-icon svg-icon-2x mt-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
                            fill="black" />
                        <path opacity="0.3"
                            d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                            fill="black" />
                    </svg>
                </span>
            </div>
        </div>
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
            @if (auth()->user()->companies()->count() > 1)
                <form action="{{ route('switch-company') }}" method="POST" class="form-group d-flex flex-row">
                    @csrf
                    <select class="form-select form-select-lg me-2" name="company_id" id="company_id">
                        @foreach (auth()->user()->companies()->get() as $company)
                            <option value="{{ $company->id }}" @if (session("company_id") == $company->id) selected @endif>
                                {{ $company->name }}
                            </option>
                        @endforeach
                    </select>
                    <button class="btn btn-sm btn-primary">
                        Switch
                    </button>
                </form>
            @endif
        </div>

        <div class="d-flex flex-row-reverse align-items-center">
            <div class="dropdown">
                {{-- @livewire('notification-counter') --}}
                <div class="dropdown-menu dropdown-menu-right">
                    {{-- @livewire('notification-list')             --}}
                </div>
            </div>
        </div>
    </div>
</div>

@push('head')
@endpush
