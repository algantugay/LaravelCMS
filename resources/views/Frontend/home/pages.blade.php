@php
    $categories = App\Models\Category::orderBy('name', 'DESC')->get();
    $pages = App\Models\Page::where('status', 'Published')->get();
@endphp

<div class="mb-lg-n15 position-relative z-index-2">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <div class="card" style="filter: drop-shadow(0px 0px 40px rgba(68, 81, 96, 0.08))">
            <!--begin::Card body-->
            <div class="card-body p-lg-20">
                <!--begin::Heading-->
                <div class="text-center mb-5 mb-lg-10">
                    <!--begin::Title-->
                    <h3 class="fs-2hx text-dark mb-5" id="products" data-kt-scroll-offset="{default: 100, lg: 250}">Ürünler</h3>
                    <!--end::Title-->
                </div>
                <!--end::Heading-->
                
                <!--begin::Tabs wrapper-->
                <div class="d-flex flex-center mb-5 mb-lg-15">
                    <!--begin::Tabs-->
                    <ul class="nav border-transparent flex-center fs-5 fw-bold">
                        <li class="nav-item">
                            <a class="nav-link text-gray-500 text-active-primary px-3 px-lg-6" href="#category-all" data-bs-toggle="tab" data-bs-target="#category-all" onclick="scrollToProducts()">TÜM ÜRÜNLER</a>
                        </li>
                        @foreach ($categories as $category)
                        <li class="nav-item">
                            <a class="nav-link text-gray-500 text-active-primary px-3 px-lg-6" href="#category-{{ $category->id }}" data-bs-toggle="tab" data-bs-target="#category-{{ $category->id }}" onclick="scrollToProducts()"> {{ $category->name }}</a>
                        </li>
                        @endforeach
                    </ul>
                    <!--end::Tabs-->
                </div>
                <!--end::Tabs wrapper-->

                <!--begin::Tabs content-->
                <div class="tab-content">
                    <!-- Tüm Ürünler Sekmesi -->
                    <div class="tab-pane fade show active" id="category-all">
                        <div class="row">
                            @foreach ($pages as $page)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card h-100 shadow-sm d-flex flex-row">
                                    <!-- Resim Bölmesi -->
                                    <div class="image-container">
                                        <a href="#" class="product-link" data-bs-toggle="modal" data-bs-target="#productModal" data-image="{{ asset('storage/' . $page->image_path) }}" data-title="{{ $page->title }}" data-content="{{ $page->content }}">
                                            <img src="{{ asset('storage/' . $page->image_path) }}" class="img-fluid" alt="{{ $page->title }}">
                                        </a>
                                    </div>
                                    <!-- Metin Bölmesi -->
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <h6 class="card-title text-truncate" title="{{ $page->title }}" style="margin-bottom: 0;">{{ $page->title }}</h6>
                                        <p class="card-text small text-muted" style="margin-top: 0;">{!! Str::limit($page->content, 10) !!}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Kategoriye Özel Sekmeler -->
                    @foreach ($categories as $category)
                    <div class="tab-pane fade" id="category-{{ $category->id }}">
                        <div class="row">
                            @foreach ($pages->where('category_id', $category->id) as $page)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card h-100 shadow-sm d-flex flex-row">
                                    <!-- Resim Bölmesi -->
                                    <div class="image-container">
                                        <a href="#" class="product-link" data-bs-toggle="modal" data-bs-target="#productModal" data-image="{{ asset('storage/' . $page->image_path) }}" data-title="{{ $page->title }}" data-content="{{ $page->content }}">
                                            <img src="{{ asset('storage/' . $page->image_path) }}" class="img-fluid" alt="{{ $page->title }}">
                                        </a>
                                    </div>
                                    <!-- Metin Bölmesi -->
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <h6 class="card-title text-truncate" title="{{ $page->title }}">{{ $page->title }}</h6>
                                        <p class="card-text small text-muted">{!! Str::limit($page->content, 10) !!}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>           
                <!--end::Tabs content-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>

<!-- Açılır Pencere (Modal) -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Ürün Başlığı</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Sol Kısım (Resim) -->
                    <div class="col-md-6">
                        <img id="modalImage" src="" class="img-fluid" alt="Product Image">
                    </div>
                    <!-- Sağ Kısım (Başlık ve İçerik) -->
                    <div class="col-md-6">
                        <h6 id="modalTitle"></h6>
                        <p id="modalContent"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.modal-dialog {
    max-width: 800px;
}

.modal-body {
    padding: 20px;
}

.modal-body .row {
    display: flex;
}

.modal-body .col-md-6 {
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-body img {
    max-width: 100%;
    height: auto;
}

.modal-body h6, .modal-body p {
    margin-top: 0;
    word-wrap: break-word;
}

.image-container img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const productLinks = document.querySelectorAll(".product-link");
        productLinks.forEach(link => {
            link.addEventListener("click", function (event) {
                const modalTitle = document.getElementById("productModalLabel");
                const modalImage = document.getElementById("modalImage");
                const modalContent = document.getElementById("modalContent");
    
                const imageSrc = this.getAttribute("data-image");
                const title = this.getAttribute("data-title");
                const content = this.getAttribute("data-content");
    
                modalTitle.textContent = title;
                modalImage.src = imageSrc;
                modalContent.innerHTML = content;
            });
        });
    });
</script>

<script>
    function scrollToProducts() {
        const productsSection = document.getElementById("products");
        productsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
</script>
