<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Good - Bootstrap 5 HTML Admin Dashboard Template
Purchase: https://themes.getbootstrap.com/product/good-bootstrap-5-admin-dashboard-template
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!--begin::Head-->

<!-- Mirrored from preview.keenthemes.com/good/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jul 2022 09:39:00 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>

    <meta charset="utf-8" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
{{--    <meta name="description" content="Good admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />--}}
{{--    <meta name="keywords" content="Good, bootstrap, bootstrap 5, admin themes, free admin themes, bootstrap admin, bootstrap dashboard, bootstrap dark mode" />--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1" />--}}
{{--    <meta property="og:locale" content="en_US" />--}}
{{--    <meta property="og:type" content="article" />--}}
{{--    <meta property="og:title" content="Good - Bootstrap 5 HTML Admin Dashboard Template" />--}}
{{--    <meta property="og:url" content="https://themes.getbootstrap.com/product/good-bootstrap-5-admin-dashboard-template" />--}}
{{--    <meta property="og:site_name" content="Keenthemes | Good" />--}}


<!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
{{--    <script src="{{ mix('js/app.js') }}"></script>--}}
<!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">



{{--    <link rel="canonical" href="https://preview.keenthemes.com/good" />--}}
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Vendor Stylesheets(used by this page)-->
    <link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/custom/vis-timeline/vis-timeline.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Page Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->
<body  data-kt-app-layout="light-sidebar" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" class="app-default">
<!--Begin::Google Tag Manager (noscript) -->

<!--End::Google Tag Manager (noscript) -->
<!--begin::Root-->
<div class="d-flex flex-column flex-root" id="app">
    <!--begin::Page-->
    <div class="app-page flex-column flex-column-fluid">
        <!--begin::Header-->
        <div class="app-header">
            <!--begin::Header container-->
            <div class="app-container container-fluid d-flex align-items-stretch justify-content-between">
                <!--begin::Mobile menu toggle-->
                <div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show sidebar menu">
                    <div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                        <span class="svg-icon svg-icon-1">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="currentColor" />
										<path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="currentColor" />
									</svg>
								</span>
                        <!--end::Svg Icon-->
                    </div>
                </div>
                <!--end::Mobile menu toggle-->
                <!--begin::Mobile logo-->
                <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                    <a href="index-2.html" class="d-lg-none">
                        <img alt="Logo" src="assets/media/logos/default.svg" class="h-30px" />
                    </a>
                </div>
                <!--end::Mobile logo-->
                <!--begin::Header wrapper-->
                <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
                    <!--begin::Page title-->
                    <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_header_wrapper'}" class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                        <!--begin::Title-->
                        <h1 class="page-heading d-flex text-dark fw-bolder fs-3 flex-column justify-content-center my-0">Grape
                            <!--begin::Description-->
                            <span class="page-desc text-gray-400 fs-7 fw-bold pt-1">«Я виноградина, ви – гілки. Хто перебуває в мені, а я в ньому, – той плід приносить щедро…» Йоана, 15,5</span>
                            <!--end::Description--></h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Page title-->
                    <!--begin::Navbar-->
                    <div class="app-navbar align-items-center flex-shrink-0">
                        <!--begin::Notifications-->
                        <div class="app-navbar-item ms-2 ms-lg-4">
                            <!--begin::Menu- wrapper-->
                            <a href="#" class="btn btn-custom btn-icon btn-outline btn-icon-gray-700 btn-active-icon-primary" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <span class="svg-icon svg-icon-1">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor" />
												<rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor" />
												<rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor" />
												<rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor" />
											</svg>
										</span>
                                <!--end::Svg Icon-->
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column w-250px w-lg-325px" data-kt-menu="true">
                                <!--begin::Heading-->
                                <div class="d-flex flex-column flex-center bgi-no-repeat rounded-top px-9 py-10" style="background-image:url('assets/media/misc/header-dropdown.png')">
                                    <!--begin::Title-->
                                    <h3 class="text-white fw-bold mb-3">Швидкі посилання</h3>
                                    <!--end::Title-->
                                    <!--begin::Status-->
                                    <span class="badge bg-primary py-2 px-3">25 pending tasks</span>
                                    <!--end::Status-->
                                </div>
                                <!--end::Heading-->
                                <!--begin:Nav-->
                                <div class="row g-0">
                                    <!--begin:Item-->
                                    <div class="col-6">
{{--                                        <audio--}}
{{--                                            ref="audio"--}}
{{--                                            src="assets/media/SweetHome.mp3"--}}
{{--                                            preload="auto"--}}
{{--                                            id="audio"--}}
{{--                                            volume="0.1"--}}
{{--                                            muted--}}
{{--                                            loop--}}
{{--                                        >--}}
{{--                                            <source :src="file" />--}}
{{--                                        </audio>--}}
                                        <a href="#" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-end border-bottom">
                                            <!--begin::Svg Icon | path: icons/duotune/finance/fin009.svg-->
                                            <span class="svg-icon svg-icon-3x svg-icon-primary mb-2">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<path opacity="0.3" d="M15.8 11.4H6C5.4 11.4 5 11 5 10.4C5 9.80002 5.4 9.40002 6 9.40002H15.8C16.4 9.40002 16.8 9.80002 16.8 10.4C16.8 11 16.3 11.4 15.8 11.4ZM15.7 13.7999C15.7 13.1999 15.3 12.7999 14.7 12.7999H6C5.4 12.7999 5 13.1999 5 13.7999C5 14.3999 5.4 14.7999 6 14.7999H14.8C15.3 14.7999 15.7 14.2999 15.7 13.7999Z" fill="currentColor" />
															<path d="M18.8 15.5C18.9 15.7 19 15.9 19.1 16.1C19.2 16.7 18.7 17.2 18.4 17.6C17.9 18.1 17.3 18.4999 16.6 18.7999C15.9 19.0999 15 19.2999 14.1 19.2999C13.4 19.2999 12.7 19.2 12.1 19.1C11.5 19 11 18.7 10.5 18.5C10 18.2 9.60001 17.7999 9.20001 17.2999C8.80001 16.8999 8.49999 16.3999 8.29999 15.7999C8.09999 15.1999 7.80001 14.7 7.70001 14.1C7.60001 13.5 7.5 12.8 7.5 12.2C7.5 11.1 7.7 10.1 8 9.19995C8.3 8.29995 8.79999 7.60002 9.39999 6.90002C9.99999 6.30002 10.7 5.8 11.5 5.5C12.3 5.2 13.2 5 14.1 5C15.2 5 16.2 5.19995 17.1 5.69995C17.8 6.09995 18.7 6.6 18.8 7.5C18.8 7.9 18.6 8.29998 18.3 8.59998C18.2 8.69998 18.1 8.69993 18 8.79993C17.7 8.89993 17.4 8.79995 17.2 8.69995C16.7 8.49995 16.5 7.99995 16 7.69995C15.5 7.39995 14.9 7.19995 14.2 7.19995C13.1 7.19995 12.1 7.6 11.5 8.5C10.9 9.4 10.5 10.6 10.5 12.2C10.5 13.3 10.7 14.2 11 14.9C11.3 15.6 11.7 16.1 12.3 16.5C12.9 16.9 13.5 17 14.2 17C15 17 15.7 16.8 16.2 16.4C16.8 16 17.2 15.2 17.9 15.1C18 15 18.5 15.2 18.8 15.5Z" fill="currentColor" />
														</svg>
													</span>
                                            <!--end::Svg Icon-->
                                            <span class="fs-5 fw-bold text-gray-800 mb-0">Accounting</span>
                                            <span class="fs-7 text-gray-400">eCommerce</span>
                                        </a>
                                    </div>
                                    <!--end:Item-->
                                    <!--begin:Item-->
                                    <div class="col-6">
                                        <a href="apps/projects/settings.html" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-bottom">
                                            <!--begin::Svg Icon | path: icons/duotune/communication/com010.svg-->
                                            <span class="svg-icon svg-icon-3x svg-icon-primary mb-2">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<path d="M6 8.725C6 8.125 6.4 7.725 7 7.725H14L18 11.725V12.925L22 9.725L12.6 2.225C12.2 1.925 11.7 1.925 11.4 2.225L2 9.725L6 12.925V8.725Z" fill="currentColor" />
															<path opacity="0.3" d="M22 9.72498V20.725C22 21.325 21.6 21.725 21 21.725H3C2.4 21.725 2 21.325 2 20.725V9.72498L11.4 17.225C11.8 17.525 12.3 17.525 12.6 17.225L22 9.72498ZM15 11.725H18L14 7.72498V10.725C14 11.325 14.4 11.725 15 11.725Z" fill="currentColor" />
														</svg>
													</span>
                                            <!--end::Svg Icon-->
                                            <span class="fs-5 fw-bold text-gray-800 mb-0">Administration</span>
                                            <span class="fs-7 text-gray-400">Console</span>
                                        </a>
                                    </div>
                                    <!--end:Item-->
                                    <!--begin:Item-->
                                    <div class="col-6">
                                        <a href="apps/projects/list.html" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-end">
                                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs042.svg-->
                                            <span class="svg-icon svg-icon-3x svg-icon-primary mb-2">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<path d="M18 21.6C16.6 20.4 9.1 20.3 6.3 21.2C5.7 21.4 5.1 21.2 4.7 20.8L2 18C4.2 15.8 10.8 15.1 15.8 15.8C16.2 18.3 17 20.5 18 21.6ZM18.8 2.8C18.4 2.4 17.8 2.20001 17.2 2.40001C14.4 3.30001 6.9 3.2 5.5 2C6.8 3.3 7.4 5.5 7.7 7.7C9 7.9 10.3 8 11.7 8C15.8 8 19.8 7.2 21.5 5.5L18.8 2.8Z" fill="currentColor" />
															<path opacity="0.3" d="M21.2 17.3C21.4 17.9 21.2 18.5 20.8 18.9L18 21.6C15.8 19.4 15.1 12.8 15.8 7.8C18.3 7.4 20.4 6.70001 21.5 5.60001C20.4 7.00001 20.2 14.5 21.2 17.3ZM8 11.7C8 9 7.7 4.2 5.5 2L2.8 4.8C2.4 5.2 2.2 5.80001 2.4 6.40001C2.7 7.40001 3.00001 9.2 3.10001 11.7C3.10001 15.5 2.40001 17.6 2.10001 18C3.20001 16.9 5.3 16.2 7.8 15.8C8 14.2 8 12.7 8 11.7Z" fill="currentColor" />
														</svg>
													</span>
                                            <!--end::Svg Icon-->
                                            <span class="fs-5 fw-bold text-gray-800 mb-0">Projects</span>
                                            <span class="fs-7 text-gray-400">Pending Tasks</span>
                                        </a>
                                    </div>
                                    <!--end:Item-->
                                    <!--begin:Item-->
                                    <div class="col-6">
                                        <a href="apps/projects/users.html" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light">
                                            <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                                            <span class="svg-icon svg-icon-3x svg-icon-primary mb-2">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<path opacity="0.3" d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z" fill="currentColor" />
															<path d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z" fill="currentColor" />
														</svg>
													</span>
                                            <!--end::Svg Icon-->
                                            <span class="fs-5 fw-bold text-gray-800 mb-0">Customers</span>
                                            <span class="fs-7 text-gray-400">Latest cases</span>
                                        </a>
                                    </div>
                                    <!--end:Item-->
                                </div>
                                <!--end:Nav-->
                                <!--begin::View more-->
                                <div class="py-2 text-center border-top">
                                    <a href="#" class="btn btn-color-gray-600 btn-active-color-primary">View All
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                        <span class="svg-icon svg-icon-5">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor" />
													<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor" />
												</svg>
											</span>
                                        <!--end::Svg Icon--></a>
                                </div>
                                <!--end::View more-->
                            </div>
                            <!--end::Menu-->
                            <!--end::Menu wrapper-->
                        </div>
                        <!--end::Notifications-->
                        <!--begin::Theme mode-->
                        <div class="app-navbar-item ms-2 ms-lg-4">
                            <!--begin::Menu toggle-->
                            <a href="#" class="btn btn-custom btn-outline btn-icon btn-icon-warning btn-active-icon-warning">
                                <div class="row m-4">
                                    <div class="col-12 mt-3">
                                        <i class="fonticon-sun fs-2 text-warning"></i>
                                    </div>
                                    <div class="col-12 mb-3 text-warning">15</div>
                                </div>
                            </a>
                            <!--begin::Menu toggle-->
                        </div>
                        <!--end::Theme mode-->
                        <!--begin::Quick links-->
                        <div class="app-navbar-item ms-2 ms-lg-4">
                            <!--begin::Menu wrapper-->
                            <a href="#" class="btn btn-custom btn-outline btn-icon btn-icon-warning btn-active-icon-warning">
                                <div class="row">
                                    <div class="col-12 mt-3">
                                <i class="las la-tint text-primary fs-2"></i>
                                    </div>
                                    <div class="col-12 mb-3 text-primary">85</div>
                                </div>
                            </a>
                            <!--end::Menu wrapper-->
                        </div>
                        <!--end::Quick links-->
                        <!-- User -->
                        <div class="app-navbar-item ms-2 ms-ls-4">
                            <user-header></user-header>
                        </div>
                        <!-- UserEnd -->
                    </div>
                    <!--end::Navbar-->
                </div>
                <!--end::Header wrapper-->
            </div>
            <!--end::Header container-->
        </div>
        <!--end::Header-->
        <!--begin::Wrapper-->
        <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
            <!--begin::sidebar-->
            <div class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
                <!--begin::Logo-->
                <div class="app-sidebar-logo d-none d-lg-flex flex-stack flex-shrink-0 px-8">
                    <!--begin::Logo image-->
                    <a href="#">
                        <div class="row">
                            <div class="col-lg-5">
                            </div>
                            <div class="col-lg-2">
                                <img alt="Logo" src="demo/images/logo.jpg" class="h-80px" style="border-radius: 50%"/>
                            </div>
                            <div class="col-lg-5">
                            </div>
                        </div>
                    </a>
                    <!--end::Logo image-->
                </div>
                <!--end::Logo-->
                <div class="separator"></div>
                <!--begin::Sidebar menu-->
                <div class="app-sidebar-menu app-sidebar-menu-arrow hover-scroll-overlay-y my-5 my-lg-5 px-3" id="kt_app_sidebar_menu_wrapper" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_toolbar, #kt_app_sidebar_footer" data-kt-scroll-offset="0">
                    <!--begin::Menu-->
                    <div class="menu menu-column menu-sub-indention menu-active-bg fw-bold" id="#kt_sidebar_menu" data-kt-menu="true">
                        <img src="https://toppng.com/uploads/preview/svg-transparent-download-clipart-vines-clip-art-vine-11562945684oclumhc5bw.png" style="transform: rotate(90deg);">
                    </div>
                    <!--end::Menu-->
                </div>
                <!--end::Sidebar menu-->

            </div>
            <!--end::sidebar-->
            <!--begin::Main-->
            <div class="app-main flex-column flex-row-fluid">
                <!--begin::Content wrapper-->
                <div class="d-flex flex-column flex-column-fluid">
                    <!--begin::Content-->
                    <div class="app-content flex-column-fluid">
                        <!--begin::Content container-->
                        <div class="app-container container-fluid">
                            <!--begin::Row-->
                            <div class="row g-5 g-xl-10">

                                <div class="col-lg-4 mb-8">
                                    <!--begin::Col-->
                                    <div class="col mb-4">
                                        <player-card></player-card>
                                        <lumen-card></lumen-card>
                                    </div>
                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col">
                                        <water-card></water-card>
                                    </div>
                                    <!--end::Col-->
                                </div>

                                <!--begin::Col-->
                                <div class="col-xl-8 mb-8">
                                    <active-card></active-card>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->

                            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                                <!--begin::Col-->
                                <div class="col-xxl-6">
                                    <!--begin::Card widget 15-->
                                    <div class="card card-flush h-xl-100">
                                        <!--begin::Body-->
                                        <div class="card-body py-9">
                                            <!--begin::Row-->
                                            <div class="row gx-9 h-100">
                                                <!--begin::Col-->
                                                <div class="col-sm-6 mb-10 mb-sm-0">
                                                    <!--begin::Overlay-->
                                                    <a class="d-block overlay h-100" data-fslightbox="lightbox-hot-sales" href="#">
                                                        <!--begin::Image-->
                                                        <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-200px h-100" style="background-image:url('assets/media/tainstva/pokajanna1.jpg')"></div>
                                                        <!--end::Image-->
                                                        <!--begin::Action-->
                                                        <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                            <i class="bi bi-eye-fill fs-2x text-white"></i>
                                                        </div>
                                                        <!--end::Action-->
                                                    </a>
                                                    <!--end::Overlay-->
                                                </div>
                                                <!--end::Col-->
                                                <!--begin::Col-->
                                                <div class="col-sm-6">
                                                    <!--begin::Wrapper-->
                                                    <div class="d-flex flex-column h-100">
                                                        <!--begin::Header-->
                                                        <div class="mb-7">
                                                            <!--begin::Title-->
                                                            <div class="mb-6">
                                                                <span class="text-gray-400 fs-7 fw-bolder me-2 d-block lh-1 pb-1">NFT ID: 1</span>
                                                                <a href="#" class="text-gray-800 text-hover-primary fs-1 fw-bolder">Приготування до Таїнства Покаяння</a>
                                                            </div>
                                                            <!--end::Title-->
                                                            <!--begin::Items-->
                                                            <div class="d-flex align-items-center flex-wrap d-grid gap-2">

                                                                <!--begin::Item-->
                                                                <div class="d-flex align-items-center">
                                                                    <!--begin::Symbol-->
                                                                    <div class="symbol symbol-30px symbol-circle me-3">
                                                                        <i class="fonticon-sun fs-4x text-warning text-center"></i>
                                                                    </div>
                                                                    <!--end::Symbol-->
                                                                    <!--begin::Info-->
                                                                    <div class="m-0">
                                                                        <span class="fw-bold text-gray-400 d-block fs-8">Промінчиків</span>
                                                                        <a href="#" class="fw-bolder text-gray-800 text-hover-primary fs-7">800</a>
                                                                    </div>
                                                                    <!--end::Info-->
                                                                </div>
                                                                <!--end::Item-->
                                                                <!--begin::Item-->
                                                                <div class="d-flex align-items-center">
                                                                    <!--begin::Symbol-->
                                                                    <div class="symbol symbol-30px symbol-circle me-3">
                                                                        <i class="las la-tint text-primary fs-4x"></i>
                                                                    </div>
                                                                    <!--end::Symbol-->
                                                                    <!--begin::Info-->
                                                                    <div class="m-0">
                                                                        <span class="fw-bold text-gray-400 d-block fs-8">Капель</span>
                                                                        <a href="#" class="fw-bolder text-gray-800 text-hover-primary fs-7">1600</a>
                                                                    </div>
                                                                    <!--end::Info-->
                                                                </div>
                                                                <!--end::Item-->
                                                            </div>
                                                            <!--end::Items-->
                                                        </div>
                                                        <!--end::Header-->
                                                        <!--begin::Body-->
                                                        <div class="d-flex flex-column border border-1 border-gray-300 text-center pt-5 pb-7 mb-8 card-rounded">
                                                            <span class="fw-bold text-gray-600 fs-7 pb-1">Можна створити</span>
                                                            <span class="fw-bolder text-gray-800 fs-2hx lh-1 pb-1">4 листочки</span>
                                                            <span class="fw-bolder text-gray-600 fs-4 pb-5">1 гроно</span>
                                                            <span class="fw-bold text-gray-600 fs-7 pb-1">Час</span>
                                                            <span class="fw-bolder text-gray-800 fs-3">04 год 24 хв</span>
                                                        </div>
                                                        <!--end::Body-->
                                                        <!--begin::Footer-->
                                                        <div class="d-flex flex-stack mt-auto bd-highlight">
                                                            <!--begin::Actions-->
                                                            <a href="#" class="btn btn-primary btn-sm flex-shrink-0 me-3" >Розпочати</a>
                                                            <a href="#" class="btn btn-light btn-sm flex-shrink-0" >Детальніше</a>
                                                            <!--end::Actions-->
                                                        </div>
                                                        <!--end::Footer-->
                                                    </div>
                                                    <!--end::Wrapper-->
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Row-->
                                        </div>
                                        <!--end::Body-->
                                    </div>
                                    <!--end::Card widget 15-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-sm-6 col-xxl-3">
                                    <!--begin::Card widget 14-->
                                    <div class="card card-flush h-xl-100">
                                        <!--begin::Body-->
                                        <div class="card-body text-center pb-5">
                                            <!--begin::Overlay-->
                                            <a class="d-block overlay" data-fslightbox="lightbox-hot-sales" href="#">
                                                <!--begin::Image-->
                                                <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded mb-7" style="height: 266px;background-image:url('assets/media/tainstva/pokajanna1.jpg')"></div>
                                                <!--end::Image-->
                                                <!--begin::Action-->
                                                <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                    <i class="bi bi-eye-fill fs-2x text-white"></i>
                                                </div>
                                                <!--end::Action-->
                                            </a>
                                            <!--end::Overlay-->
                                            <!--begin::Info-->
                                            <div class="d-flex align-items-end flex-stack mb-1">
                                                <!--begin::Title-->
                                                <div class="text-start">
                                                    <span class="fw-bolder text-gray-800 cursor-pointer text-hover-primary fs-4 d-block">Перший клас</span>
                                                    <span class="text-gray-400 mt-1 fw-bolder fs-6">Промінчиків: 600</span>
                                                    <span class="text-gray-400 mt-1 fw-bolder fs-6">Капель: 1200</span>
                                                </div>
                                                <!--end::Title-->
                                                <!--begin::Total-->
                                                <span class="text-gray-600 text-end fw-bolder fs-6">130 хв.</span>
                                                <!--end::Total-->
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Body-->
                                        <!--begin::Footer-->
                                        <div class="card-footer d-flex flex-stack pt-0">
                                            <!--begin::Link-->
                                            <a class="btn btn-sm btn-primary flex-shrink-0 me-2">Розпочати</a>
                                            <!--end::Link-->
                                            <!--begin::Link-->
                                            <a class="btn btn-sm btn-light flex-shrink-0" href="#">Переглянути</a>
                                            <!--end::Link-->
                                        </div>
                                        <!--end::Footer-->
                                    </div>
                                    <!--end::Card widget 14-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-sm-6 col-xxl-3">
                                    <!--begin::Card widget 14-->
                                    <div class="card card-flush h-xl-100">
                                        <!--begin::Body-->
                                        <div class="card-body text-center pb-5">
                                            <!--begin::Overlay-->
                                            <a class="d-block overlay" data-fslightbox="lightbox-hot-sales" href="#">
                                                <!--begin::Image-->
                                                <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded mb-7" style="height: 266px;background-image:url('assets/media/tainstva/pokajanna1.jpg')"></div>
                                                <!--end::Image-->
                                                <!--begin::Action-->
                                                <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                    <i class="bi bi-eye-fill fs-2x text-white"></i>
                                                </div>
                                                <!--end::Action-->
                                            </a>
                                            <!--end::Overlay-->
                                            <!--begin::Info-->
                                            <div class="d-flex align-items-end flex-stack mb-1">
                                                <!--begin::Title-->
                                                <div class="text-start">
                                                    <span class="fw-bolder text-gray-800 cursor-pointer text-hover-primary fs-4 d-block">Другий клас</span>
                                                    <span class="text-gray-400 mt-1 fw-bolder fs-6">Промінчиків: 650</span>
                                                    <span class="text-gray-400 mt-1 fw-bolder fs-6">Капель: 1300</span>
                                                </div>
                                                <!--end::Title-->
                                                <!--begin::Total-->
                                                <span class="text-gray-600 text-end fw-bolder fs-6">160 хв.</span>
                                                <!--end::Total-->
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Body-->
                                        <!--begin::Footer-->
                                        <div class="card-footer d-flex flex-stack pt-0">
                                            <!--begin::Link-->
                                            <a class="btn btn-sm btn-primary flex-shrink-0 me-2">Розпочати</a>
                                            <!--end::Link-->
                                            <!--begin::Link-->
                                            <a class="btn btn-sm btn-light flex-shrink-0" href="#">Переглянути</a>
                                            <!--end::Link-->
                                        </div>
                                        <!--end::Footer-->
                                    </div>
                                    <!--end::Card widget 14-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--begin::Col-->
{{--                            <div class="col-xl-6 col-xxl-8 mb-6 mb-xxl-10">--}}
{{--                                <!--begin::Engage widget 2-->--}}
{{--                                <div class="card bgi-position-y-bottom bgi-position-x-end bgi-no-repeat bgi-size-cover min-h-250px h-xl-100 border-0 bg-gray-200" style="background-position: 100% 100%;background-size: 1000px auto;background-image:url('assets/media/tainstva/pokajanna.jpg')">--}}
{{--                                    <!--begin::Body-->--}}
{{--                                    <div class="card-body d-flex flex-column justify-content-center ps-lg-15">--}}
{{--                                        <!--begin::Title-->--}}
{{--                                        <h3 class="text-gray-800 fs-2qx fw-boldest mb-4 mb-lg-8">Приготування до--}}
{{--                                            <br />Таїнства Покаяння</h3>--}}
{{--                                        <!--end::Title-->--}}
{{--                                        <!--begin::Action-->--}}
{{--                                        <div class="m-0">--}}
{{--                                            <a href='#' class="btn btn-danger fw-bold">Розпочати</a>--}}
{{--                                        </div>--}}
{{--                                        <!--begin::Action-->--}}
{{--                                    </div>--}}
{{--                                    <!--end::Body-->--}}
{{--                                </div>--}}
{{--                                <!--end::Engage widget 2-->--}}
{{--                            </div>--}}
                            <!--end::Col-->
                        </div>
                        <!--end::Content container-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Content wrapper-->
                <!--begin::Footer-->
                <div id="kt_app_footer" class="app-footer">
                    <!--begin::Footer container-->
                    <div class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
                        <!--begin::Copyright-->
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-muted fw-bold me-1">2022©</span>
                            <a href="#" target="_blank" class="text-gray-800 text-hover-primary">Катехитична комісія УГКЦ</a>
                        </div>
                        <!--end::Copyright-->
                    </div>
                    <!--end::Footer container-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end:::Main-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::Root-->

<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
    <span class="svg-icon">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
					<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
					<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
				</svg>
			</span>
    <!--end::Svg Icon-->
</div>
<!--end::Scrolltop-->
<!--begin::Javascript-->
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="assets/plugins/global/plugins.bundle.js"></script>
<script src="assets/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Vendors Javascript(used by this page)-->
<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
<script src="assets/plugins/custom/vis-timeline/vis-timeline.bundle.js"></script>
<!--end::Page Vendors Javascript-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="assets/js/widgets.bundle.js"></script>
<script src="assets/js/custom/widgets.js"></script>
<script src="assets/js/custom/apps/chat/chat.js"></script>
<script src="assets/js/custom/intro.js"></script>
<script src="assets/js/custom/utilities/modals/upgrade-plan.js"></script>
<script src="assets/js/custom/utilities/modals/create-project/type.js"></script>
<script src="assets/js/custom/utilities/modals/create-project/budget.js"></script>
<script src="assets/js/custom/utilities/modals/create-project/settings.js"></script>
<script src="assets/js/custom/utilities/modals/create-project/team.js"></script>
<script src="assets/js/custom/utilities/modals/create-project/targets.js"></script>
<script src="assets/js/custom/utilities/modals/create-project/files.js"></script>
<script src="assets/js/custom/utilities/modals/create-project/complete.js"></script>
<script src="assets/js/custom/utilities/modals/create-project/main.js"></script>
<script src="assets/js/custom/utilities/modals/create-app.js"></script>
<script src="assets/js/custom/utilities/modals/create-campaign.js"></script>
<script src="assets/js/custom/utilities/modals/users-search.js"></script>
<!--end::Page Custom Javascript-->
<!--end::Javascript-->
</body>
<!--end::Body-->

<!-- Mirrored from preview.keenthemes.com/good/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jul 2022 09:39:01 GMT -->
</html>

<script>
    import ActiveCard from "../js/components/ActiveCard";
    import LumenCard from "../js/components/LumenCard";
    import UserHeader from "../js/components/header/UserHeader";
    import PlayerCard from "../js/components/PlayerCard";
    export default {
        components: {PlayerCard, UserHeader, LumenCard, ActiveCard}
    }
</script>
