@extends('admin.admin_master')

@section('content')
<div class="container">
    <div class="card">
        <!-- Başlık -->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title">Sayfa Düzenle</h3>
        </div>
        <!-- İçerik -->
        <div class="card-body">
            <form action="{{ route('admin.pages.update', $page->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Kategori Seçim -->
                <div class="form-group mb-3">
                    <label for="category_id" class="form-label">Kategori</label>
                    <select name="category_id" id="category_id" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $page->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Başlık -->
                <div class="form-group mb-3">
                    <label for="title" class="form-label">Başlık</label>
                    <input type="text" name="title" class="form-control" id="title" value="{{ $page->title }}" required>
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- İçerik -->
                <div class="form-group mb-3">
                    <label for="content" class="form-label">İçerik</label>
                    <textarea name="content" class="form-control" id="content" rows="5" required>{{ $page->content }}</textarea>
                    @error('content')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Durum -->
                <div class="form-group mb-3">
                    <label for="status" class="form-label">Durum</label>
                    <select name="status" id="status" class="form-control">
                        <option value="draft" {{ $page->status == 'draft' ? 'selected' : '' }}>Taslak</option>
                        <option value="published" {{ $page->status == 'published' ? 'selected' : '' }}>Yayınlandı</option>
                    </select>
                    @error('status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Güncel Resim -->
                <div class="form-group mb-3">
                    <label for="image_path" class="form-label">Güncel Resim</label>
                    <div>
                        <img src="{{ asset('storage/' . $page->image_path) }}" alt="{{ $page->title }}" style="max-width: 200px;" id="current_image">
                    </div>
                    <input type="file" name="image_path" class="form-control mt-2" id="image_path">
                    @error('image_path')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Güncelle Butonu -->
                <button type="submit" class="btn btn-success">Güncelle</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
@endsection
