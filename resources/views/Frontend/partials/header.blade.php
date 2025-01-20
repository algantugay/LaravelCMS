<div class="mb-0" id="home">
    <!--begin::Wrapper-->
    <div class="bgi-no-repeat bgi-size-contain bgi-position-x-center bgi-position-y-bottom landing-dark-bg" style="background-image: url{{asset('backend/assets/media/svg/illustrations/landing.svg')}}">
        <!--begin::Header-->
        <div class="landing-header" data-kt-sticky="true" data-kt-sticky-name="landing-header" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
        <!--begin::Container-->
        <div class="container">
        <!--begin::Wrapper-->
        <div class="d-flex align-items-center justify-content-between">
        <!--begin::Logo-->
        <div class="d-flex align-items-center flex-equal">
        <!--begin::Mobile menu toggle-->
        <button class="btn btn-icon btn-active-color-primary me-3 d-flex d-lg-none" id="kt_landing_menu_toggle">
        <i class="ki-duotone ki-abstract-14 fs-2hx">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
        </button>
        <!--end::Mobile menu toggle-->
        <!--begin::Logo image-->
        <a href="">
        <img alt="Logo" src="{{ asset('backend/assets/media/logos/darkhome.png') }}" class="logo-default h-30px h-lg-70px" />
        <img alt="Logo" src="{{ asset('backend/assets/media/logos/home.PNG') }}" class="logo-sticky h-30px h-lg-70px" />
        </a>
        <!--end::Logo image-->
        </div>
        <!--end::Logo-->

<!--begin::Menu wrapper-->
<div class="d-lg-block" id="kt_header_nav_wrapper">
    <div class="d-lg-block p-5 p-lg-0" data-kt-drawer="true" data-kt-drawer-name="landing-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="200px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_landing_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav_wrapper'}">
        <!--begin::Menu-->
        <div class="menu menu-column flex-nowrap menu-rounded menu-lg-row menu-title-gray-600 menu-state-title-primary nav nav-flush fs-5 fw-semibold" id="kt_landing_menu">
            <!--begin::Menu item-->
            <div class="menu-item">
                <a class="menu-link nav-link active py-3 px-4 px-xxl-6" href="#kt_body" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Anasayfa</a>
            </div>
            <!--end::Menu item-->

            <!--begin::Dropdown menu item-->
            <div class="menu-item dropdown" id="categoryDropdown">
                <!-- Dropdown başlığı -->
                <a class="menu-link nav-link py-3 px-4 px-xxl-6 dropdown-toggle" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true" href="#products">
                    Kategoriler
                </a>
                <!-- Dropdown menüsü -->
                <ul class="dropdown-menu">
                    @php
                        $categories = App\Models\Category::orderBy('name', 'ASC')->get();
                    @endphp

                    @foreach($categories as $category)
                        <li>
                            <a class="dropdown-item" href="#category-{{ Str::slug($category->name) }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <!--end::Dropdown menu item-->

            <div class="menu-item">
                <!--begin::Menu link-->
                <a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#comment" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Yorumlar</a>
                <!--end::Menu link-->
            </div>

            <div class="menu-item">
                <!--begin::Menu link-->
                <a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#footer" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">İletişim</a>
                <!--end::Menu link-->
            </div>
        </div>
        <!--end::Menu-->
    </div>
</div>
<!--end::Menu wrapper-->
<!--begin::Toolbar-->
<div class="flex-equal text-end ms-1">
    <a href="{{route('login.tamplate')}}" class="btn btn-success">Giriş Yap</a>
</div>
<!--end::Toolbar-->
        </div>
        <!--end::Wrapper-->
        </div>
        <!--end::Container-->
</div>

<style>
.menu-item.dropdown {
position: relative;
}

.menu-item.dropdown .dropdown-menu {
display: none;
opacity: 0;
visibility: hidden;
position: absolute;
top: 100%;
left: 0;
z-index: 1000;
transition: all 0.3s ease-in-out;
}

.menu-item.dropdown:hover > .dropdown-menu {
display: block !important;
opacity: 1;
visibility: visible;
}
</style>

        <!--end::Header-->
        
        <!--begin::Landing hero-->
        <div class="d-flex flex-column flex-center w-100 min-h-350px min-h-lg-500px px-9">
        <!--begin::Heading-->
        <div class="text-center mb-5 mb-lg-10 py-10 py-lg-20">
        <!--begin::Title-->
        <h1 class="text-white lh-base fw-bold fs-2x fs-lg-3x mb-15">	<span style="background: linear-gradient(to right, #12CE5D 0%, #FFD80C 100%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;">
        <span id="kt_landing_hero_text">MOTOSİKLET</span>
        </span>
        <br />İLE ALAKALI HER ŞEY!
        </h1>
        <!--end::Title-->
        </div>
        <!--end::Heading-->

<!--begin::Slider-->
<div class="tns tns-default" style="direction: ltr">
<!--begin::Slider-->
<div
data-tns="true"
data-tns-loop="true"
data-tns-swipe-angle="false"
data-tns-speed="2000"
data-tns-autoplay="true"
data-tns-autoplay-timeout="5000"
data-tns-controls="true"
data-tns-nav="false"
data-tns-items="4"
data-tns-center="true"
data-tns-dots="false"
data-tns-prev-button="#kt_team_slider_prev1"
data-tns-next-button="#kt_team_slider_next1">

@php
    $pages = App\Models\Page::where('status', 'Published')->paginate(20);
@endphp

<!--begin::Item-->
@foreach ($pages as $urun)
<div class="text-center px-1 py-1">
    <img src="{{ asset('storage/' . ($urun->image_path ?? 'default.jpg')) }}" 
         class="card-rounded mw-100" 
         style="height: 200px; object-fit: cover;" 
         alt="{{ $urun->title ?? 'No Title' }}" />
</div>
@endforeach
<!--end::Item-->
</div>
<!--end::Slider-->

<!--begin::Slider button-->
<button class="btn btn-icon btn-active-color-primary" id="kt_team_slider_prev1">
<span class="svg-icon fs-3x">
    &lt;
</span>
</button>
<!--end::Slider button-->

<!--begin::Slider button-->
<button class="btn btn-icon btn-active-color-primary" id="kt_team_slider_next1">
<span class="svg-icon fs-3x">
    &gt;
</span>
</button>
<!--end::Slider button-->
</div>
<!--end::Slider-->

</div>
        <!--end::Landing hero-->
    </div>
    <!--end::Wrapper-->
    <!--begin::Curve bottom-->
    <div class="landing-curve landing-dark-color mb-10 mb-lg-20">
        <svg viewBox="15 12 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 11C3.93573 11.3356 7.85984 11.6689 11.7725 12H1488.16C1492.1 11.6689 1496.04 11.3356 1500 11V12H1488.16C913.668 60.3476 586.282 60.6117 11.7725 12H0V11Z" fill="currentColor"></path>
        </svg>
    </div>
    <!--end::Curve bottom-->
</div>