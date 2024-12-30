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
                            <a class="menu-link nav-link py-3 px-4 px-xxl-6" href="{{route('contact.show')}}">İletişim</a>
                            <!--end::Menu link-->
                        </div>
                    </div>
                    <!--end::Menu-->
                </div>
            </div>
            <!--end::Menu wrapper-->

            <!--begin::Toolbar-->
            <div class="flex-equal text-end ms-1">
                <a href="{{route('admin.login')}}" class="btn btn-success">Giriş Yap</a>
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
