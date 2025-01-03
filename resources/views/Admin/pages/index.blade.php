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
                            <input id="page-search" type="text" class="form-control form-control-solid w-250px ps-12" placeholder="Ürün ara" />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">Yeni Sayfa Ekle</a>
                    </div>
                </div>
                <div class="card-body pt-0">
                    @if ($pages->isEmpty())
                        <p class="text-center text-muted">Henüz bir sayfa eklenmedi.</p>
                    @else
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_page_table">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-200px">Kategori</th>
                                    <th class="min-w-200px">Görsel</th>
                                    <th class="min-w-250px">Başlık</th>
                                    <th class="min-w-100px">Durum</th>
                                    <th class="min-w-150px">Güncellenme Tarihi</th>
                                    <th class="text-end min-w-100px">Eylemler</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600" id="page-tbody">
                                @foreach($pages as $page)
                                    <tr>
                                        <td>{{ $page->category->name }}</td>
                                        <td>
                                            @if($page->image_path)
                                            <img src="{{ asset('storage/' . $page->image_path) }}" alt="{{ $page->title }}" style="max-height: 60px; max-width: 100px;">
                                        @else
                                            <span class="text-muted">Resim Yok</span>
                                        @endif
                                        </td>
                                        <td>{{ $page->title }}</td>
                                        <td>{{ ucfirst($page->status) }}</td>
                                        <td>{{ $page->updated_at->format('d M Y, H:i') }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-sm btn-light">Düzenle</a>
                                            <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-light text-danger">Sil</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>
                            {{ $pages->links('pagination::bootstrap-4') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('page-search').addEventListener('input', function() {
        const searchValue = this.value.toLowerCase();
        const rows = document.querySelectorAll('#page-tbody tr');

        rows.forEach(row => {
            const title = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
            const category = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
            
            if (title.includes(searchValue) || category.includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
@endsection