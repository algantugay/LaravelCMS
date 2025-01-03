@extends('admin.admin_master')

@section('content')
<div class="container">
    <div class="card">
        <!-- Başlık -->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title">Yeni Sayfa Oluştur</h3>
        </div>
        <!-- İçerik -->
        <div class="card-body">
            <form action="{{ route('admin.pages.store') }}" method="POST" enctype="multipart/form-data" id="pageForm">
                @csrf
                
                <!-- Kategori Seçim -->
                <div class="form-group mb-3">
                    <label for="category_id" class="form-label">Kategori</label>
                    <select name="category_id" id="category_id" class="form-control" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Başlık -->
                <div class="form-group mb-3">
                    <label for="title" class="form-label">Başlık</label>
                    <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}" required>
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- İçerik -->
                <div class="form-group mb-3">
                    <label for="content" class="form-label">İçerik</label>
                    <textarea name="content" class="form-control" id="content" rows="5" style="visibility: hidden;"></textarea>
                    @error('content')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Durum -->
                <div class="form-group mb-3">
                    <label for="status" class="form-label">Durum</label>
                    <select name="status" id="status" class="form-control">
                        <option value="draft">Taslak</option>
                        <option value="published">Yayınlandı</option>
                    </select>
                    @error('status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Resim -->
                <div class="form-group mb-3">
                    <label for="image" class="form-label">Resim</label>
                    <input type="file" name="image" class="form-control" id="image">
                    @error('image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Kaydet Butonu -->
                <button type="submit" class="btn btn-success" id="saveBtn">Kaydet</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let contentEditor;
    ClassicEditor
        .create(document.querySelector('#content'))
        .then(editor => {
            contentEditor = editor;
        })
        .catch(error => {
            console.error('CKEditor Yükleme Hatası:', error);
        });

    const form = document.querySelector('#pageForm');
    const contentInput = document.querySelector('#content');

    form.addEventListener('submit', function(e) {
        // CKEditor'dan gelen içeriği textarea'ya yaz
        if (contentEditor) {
            contentInput.value = contentEditor.getData();
        }

        // Eğer içerik boşsa, form gönderimini engelle
        if (!contentInput.value.trim()) {
            e.preventDefault();
            alert('İçerik alanı boş olamaz!');
        }
    });
});
</script>
<script src="{{ asset('backend/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('backend/assets/js/scripts.bundle.js') }}"></script>
@endsection
