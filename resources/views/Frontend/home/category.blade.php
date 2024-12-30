@php
    $category = App\Models\Category::orderBy('name','DESC')->get();
@endphp

<div class="mb-n10 mb-lg-n20 z-index-2">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Heading-->
        <div class="text-center mb-17">
            <!--begin::Title-->
            <h3 class="fs-2hx text-dark mb-5" id="how-it-works" data-kt-scroll-offset="{default: 100, lg: 150}">Kategoriler</h3>
            <!--end::Title-->
        </div>
        <!--end::Heading-->
        <!--begin::Row-->
        <div class="row w-100 gy-10 mb-md-20">
            <!--begin::Col-->
            @foreach ($category as $kategori)
            <div class="col-md-4 px-5">
                <!--begin::Story-->
                <div class="text-center mb-10 mb-md-0">
                    <!--begin::Illustration-->
                    <img src="{{ asset('storage/' . $kategori->image) }}" class="mh-125px mb-9" alt="" />
                    <!--end::Illustration-->
                    <!--begin::Heading-->
                    <div class="d-flex flex-center mb-5">
                        <!--begin::Badge-->
                        <span class="badge badge-light-success fw-bold p-5 me-3 fs-3">{{$kategori->name}}</span>
                        <!--end::Badge-->
                    </div>
                    <!--end::Heading-->
                </div>
                <!--end::Story-->
            </div>
            @endforeach
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>