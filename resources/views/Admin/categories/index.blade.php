@extends('admin.admin_master')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="card card-flush">
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4"></i>
                            <input id="category-search" type="text" class="form-control form-control-solid w-250px ps-12" placeholder="Kategori Ara" />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Kategori Ekle</a>
                    </div>
                </div>
                <div class="card-body pt-0">
                    @if ($categories->isEmpty())
                        <p class="text-center text-muted">Henüz bir kategori eklenmedi.</p>
                    @else
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_category_table">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-200px">Kategori Adı</th>
                                    <th class="min-w-150px">Görsel</th>
                                    <th class="text-end min-w-70px">Eylemler</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600" id="category-tbody">
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            @if($category->image)
                                                <img src="{{ Storage::url($category->image) }}" alt="Kategori Resmi" width="100" height="100" style="object-fit: cover; border-radius: 5px;">
                                            @else
                                                <span class="text-muted">Resim Yok</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-light">Düzenle</a>
                                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-light text-danger">Sil</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    <div class="d-flex justify-content-center">
                        {{ $categories->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('category-search').addEventListener('input', function() {
        const searchValue = this.value.toLowerCase();
        const rows = document.querySelectorAll('#category-tbody tr');

        rows.forEach(row => {
            const categoryName = row.querySelector('.category-name').textContent.toLowerCase();
            if (categoryName.includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
@endsection

