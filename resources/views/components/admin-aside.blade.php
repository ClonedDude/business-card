@php
    use Illuminate\Support\Facades\Auth;

    $user = Auth::user();
@endphp

<!--begin::Aside-->
<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <!--begin::Brand-->
    <div class="aside-logo flex-column-auto" id="kt_aside_logo">
        <!--begin::Logo-->
        <a href="{{ route('home') }}">
            {{-- <img alt="Logo" src="{{ asset("assets/images/logo.png") }}" class="h-50px logo" /> --}}
        </a>
        <!--end::Logo-->
        <!--begin::Aside toggler-->
        <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
            <span class="svg-icon svg-icon-1 rotate-180">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path opacity="0.5" d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z" fill="black" />
                    <path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z" fill="black" />
                </svg>
            </span>
            <!--end::Svg Icon-->
        </div>
        <!--end::Aside toggler-->
    </div>
    <!--end::Brand-->
    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid">
        <!--begin::Aside Menu-->
        <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
            <!--begin::Menu-->
            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true" style="flex-direction: column; height:100%;">
                <div class="menu-item">
                    <div class="menu-content pb-2">
                        <span class="menu-section text-muted text-uppercase fs-8 ls-1">Dashboard</span>
                    </div>
                </div>
                <div class="menu-item menu-accordion">
                    <a class="menu-link" href="{{ route('home') }}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M3 7.19995H10C10.6 7.19995 11 6.79995 11 6.19995V3.19995C11 2.59995 10.6 2.19995 10 2.19995H3C2.4 2.19995 2 2.59995 2 3.19995V6.19995C2 6.69995 2.4 7.19995 3 7.19995Z" fill="currentColor"/>
                                    <path opacity="0.3" d="M10.1 22H3.10001C2.50001 22 2.10001 21.6 2.10001 21V10C2.10001 9.4 2.50001 9 3.10001 9H10.1C10.7 9 11.1 9.4 11.1 9V20C11.1 21.6 10.7 22 10.1 22ZM13.1 18V21C13.1 21.6 13.5 22 14.1 22H21.1C21.7 22 22.1 21.6 22.1 21V18C22.1 17.4 21.7 17 21.1 17H14.1C13.5 17 13.1 17.4 13.1 18ZM21.1 2H14.1C13.5 2 13.1 2.4 13.1 3V14C13.1 14.6 13.5 15 14.1 15H21.1C21.7 15 22.1 14.6 22.1 14V3C22.1 2.4 21.7 2 21.1 2Z" fill="currentColor"/>
                                    </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </div>

                @can('users.view')
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.3" d="M16.5 9C16.5 13.125 13.125 16.5 9 16.5C4.875 16.5 1.5 13.125 1.5 9C1.5 4.875 4.875 1.5 9 1.5C13.125 1.5 16.5 4.875 16.5 9Z" fill="currentColor"/>
                                    <path d="M9 16.5C10.95 16.5 12.75 15.75 14.025 14.55C13.425 12.675 11.4 11.25 9 11.25C6.6 11.25 4.57499 12.675 3.97499 14.55C5.24999 15.75 7.05 16.5 9 16.5Z" fill="currentColor"/>
                                    <rect x="7" y="6" width="4" height="4" rx="2" fill="currentColor"/>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">User</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <a class="menu-link" href="{{ route("users.index") }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">List User</span>
                        </a>

                        <a class="menu-link" href="{{ route("users.create") }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Add User</span>
                        </a>
                    </div>
                </div>
                @endcan

                @can('roles.view')
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.3" d="M16.5 9C16.5 13.125 13.125 16.5 9 16.5C4.875 16.5 1.5 13.125 1.5 9C1.5 4.875 4.875 1.5 9 1.5C13.125 1.5 16.5 4.875 16.5 9Z" fill="currentColor"/>
                                    <path d="M9 16.5C10.95 16.5 12.75 15.75 14.025 14.55C13.425 12.675 11.4 11.25 9 11.25C6.6 11.25 4.57499 12.675 3.97499 14.55C5.24999 15.75 7.05 16.5 9 16.5Z" fill="currentColor"/>
                                    <rect x="7" y="6" width="4" height="4" rx="2" fill="currentColor"/>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">Role</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <a class="menu-link" href="{{ route("roles.index") }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">List Role</span>
                        </a>

                        <a class="menu-link" href="{{ route("roles.create") }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Add Role</span>
                        </a>
                    </div>
                </div>
                @endcan

                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | Company Icon-->
                            <span class="svg-icon svg-icon-2">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <!-- Background Circle -->
                                    <path opacity="0.3" d="M16.5 9C16.5 13.125 13.125 16.5 9 16.5C4.875 16.5 1.5 13.125 1.5 9C1.5 4.875 4.875 1.5 9 1.5C13.125 1.5 16.5 4.875 16.5 9Z" fill="currentColor" />
                                    <!-- Building Base -->
                                    <rect x="5" y="5" width="8" height="10" rx="1" fill="currentColor" />
                                    <!-- Building Windows -->
                                    <rect x="6.5" y="6.5" width="1.5" height="1.5" rx="0.2" fill="white" />
                                    <rect x="10" y="6.5" width="1.5" height="1.5" rx="0.2" fill="white" />
                                    <rect x="6.5" y="9" width="1.5" height="1.5" rx="0.2" fill="white" />
                                    <rect x="10" y="9" width="1.5" height="1.5" rx="0.2" fill="white" />
                                    <rect x="6.5" y="11.5" width="5" height="1.5" rx="0.2" fill="white" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">Company</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <a class="menu-link" href="{{ route("companies.index") }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">List Company</span>
                        </a>

                        <a class="menu-link" href="{{ route("companies.create") }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Add Company</span>
                        </a>
                    </div>
                </div>

                @can('contacts.view')
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | Multi-User Icon-->
                            <span class="svg-icon svg-icon-2">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <!-- Outer Circle Background -->
                                    <path opacity="0.3" d="M16.5 9C16.5 13.125 13.125 16.5 9 16.5C4.875 16.5 1.5 13.125 1.5 9C1.5 4.875 4.875 1.5 9 1.5C13.125 1.5 16.5 4.875 16.5 9Z" fill="currentColor" />
                                    <!-- Primary User (Center) -->
                                    <path d="M9 16.5C10.95 16.5 12.75 15.75 14.025 14.55C13.425 12.675 11.4 11.25 9 11.25C6.6 11.25 4.57499 12.675 3.97499 14.55C5.24999 15.75 7.05 16.5 9 16.5Z" fill="currentColor" />
                                    <rect x="7" y="6" width="4" height="4" rx="2" fill="currentColor" />
                                    <!-- Secondary User (Left) -->
                                    <path d="M4.5 14C5.325 14.875 6.6 15.375 7.8 15.375C7.425 14.4 6.225 13.65 4.875 13.5C3.6 13.35 2.925 13.8 2.775 14.025C3.375 14.5 3.975 14.75 4.5 14Z" fill="currentColor" />
                                    <circle cx="5.5" cy="7.5" r="1.5" fill="currentColor" />
                                    <!-- Secondary User (Right) -->
                                    <path d="M13.5 14C12.675 14.875 11.4 15.375 10.2 15.375C10.575 14.4 11.775 13.65 13.125 13.5C14.4 13.35 15.075 13.8 15.225 14.025C14.625 14.5 14.025 14.75 13.5 14Z" fill="currentColor" />
                                    <circle cx="12.5" cy="7.5" r="1.5" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        
                        <span class="menu-title">Contact</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <a class="menu-link" href="{{ route("contacts.index") }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">List Contact</span>
                        </a>

                        <a class="menu-link" href="{{ route("contacts.create") }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Add Contact</span>
                        </a>
                    </div>
                </div>
                @endcan

             @can('external.view')
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.3" d="M16.5 9C16.5 13.125 13.125 16.5 9 16.5C4.875 16.5 1.5 13.125 1.5 9C1.5 4.875 4.875 1.5 9 1.5C13.125 1.5 16.5 4.875 16.5 9Z" fill="currentColor"/>
                                    <path d="M9 16.5C10.95 16.5 12.75 15.75 14.025 14.55C13.425 12.675 11.4 11.25 9 11.25C6.6 11.25 4.57499 12.675 3.97499 14.55C5.24999 15.75 7.05 16.5 9 16.5Z" fill="currentColor"/>
                                    <rect x="7" y="6" width="4" height="4" rx="2" fill="currentColor"/>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">External Link Type</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <a class="menu-link" href="{{ route("external-link-types.index") }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">List External Link Type</span>
                        </a>

                        <a class="menu-link" href="{{ route("external-link-types.create") }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Add External Link Type</span>
                        </a>
                    </div>
                </div>
            @endcan

            <!-- Subscription plans  -->
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">
                        <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.3" d="M16.5 9C16.5 13.125 13.125 16.5 9 16.5C4.875 16.5 1.5 13.125 1.5 9C1.5 4.875 4.875 1.5 9 1.5C13.125 1.5 16.5 4.875 16.5 9Z" fill="currentColor"/>
                                <path d="M9 16.5C10.95 16.5 12.75 15.75 14.025 14.55C13.425 12.675 11.4 11.25 9 11.25C6.6 11.25 4.57499 12.675 3.97499 14.55C5.24999 15.75 7.05 16.5 9 16.5Z" fill="currentColor"/>
                                <rect x="7" y="6" width="4" height="4" rx="2" fill="currentColor"/>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="menu-title">Subscriptions</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    <a class="menu-link" href="{{ route("subscription-plans.index") }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">View subscription plans</span>
                    </a>

                    <a class="menu-link" href="{{ route("subscription-plans.create") }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Add subscription plan</span>
                    </a>
                </div>
            </div>


                @can('expenses.view')
                {{-- Expense management sidebar --}}
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor" />
                                    <path d="M12 7C10.3431 7 9 8.34315 9 10C9 11.1046 9.89543 12 11 12H13C14.1046 12 15 12.8954 15 14C15 15.6569 13.6569 17 12 17M12 7V17M12 7C13.6569 7 15 8.34315 15 10M12 17C10.3431 17 9 15.6569 9 14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">Expense management</span>
                        <span class="menu-arrow"></span>
                    </span>

                    @can('expenses.view')
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <a class="menu-link" href="{{ route("expenses.index") }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">View Expense</span>
                        </a>
                    @endcan

                    @can('expenses.store')
                        <a class="menu-link" href="{{ route("expenses.create") }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Create Expense</span>
                        </a>
                    @endcan

                    @can('items.view')
                        <a class="menu-link" href="{{ route("items.index") }}">
                        
                               <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">View Items</span>
                        </a>
                    @endcan

                    @can('items.store')
                        <a class="menu-link" href="{{ route("items.create") }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Create Items</span>
                        </a>
                    @endcan
                    </div>
                </div>
                @endcan
                {{-- End of expense management --}}

                
                <div class="menu-item" style="margin-top: auto">
                    <form class="menu-link" action="{{ route("logout") }}" method="POST">
                        @csrf
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
                                    <path d="M12.0657 12.5657L14.463 14.963C14.7733 15.2733 14.8151 15.7619 14.5621 16.1204C14.2384 16.5789 13.5789 16.6334 13.1844 16.2342L9.69464 12.7029C9.30968 12.3134 9.30968 11.6866 9.69464 11.2971L13.1844 7.76582C13.5789 7.3666 14.2384 7.42107 14.5621 7.87962C14.8151 8.23809 14.7733 8.72669 14.463 9.03696L12.0657 11.4343C11.7533 11.7467 11.7533 12.2533 12.0657 12.5657Z" fill="currentColor"/>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <button class="border-0 ps-0 menu-title bg-transparent">Logout</button>
                    </form>
                </div>
            </div>
            
            <!--end::Menu-->
        </div>
        <!--end::Aside Menu-->
    </div>
    <!--end::Aside menu-->
</div>
<!--end::Aside-->
