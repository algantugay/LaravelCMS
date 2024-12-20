@extends('admin.admin_master')

@section('content')
<div class="container">
    <div class="card">
        <!-- Başlık -->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title">
                <span class="card-label fw-bold fs-3">Kategoriler</span>
            </h3>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">Yeni Kategori Ekle</a>
        </div>
        <!-- İçerik -->
        <div class="card-body">
            <table id="kt_datatable" class="table table-row-bordered gy-5">
                <thead>
                    <tr class="fw-semibold fs-6 text-muted">
                        <th>İsim</th>
                        <th>Oluşturulma Tarihi</th>
                        <th>Güncellenme Tarihi</th>
                        <th class="text-center">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->created_at->format('d M Y, H:i') }}</td>
                            <td>{{ $category->updated_at->format('d M Y, H:i') }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Düzenle</a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Sil</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Datatable initialization
        var datatable = new KTDatatable({
            // Customize your datatable configuration here
        });
    });
</script>
@endsection
