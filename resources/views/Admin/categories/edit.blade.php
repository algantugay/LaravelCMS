@extends('admin.admin_master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title">Kategoriyi Düzenle</h3>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary mb-3">Geri Dön</a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="name">İsim</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $category->name) }}" required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="slug">Slug</label>
                    <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $category->slug) }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="image" class="form-label">Kategori Resmi</label>
                    @if($category->image)
                        <div class="mb-2">
                            <img src="{{ Storage::url($category->image) }}" alt="Kategori Resmi" width="150">
                        </div>
                    @endif
                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    @error('image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">Güncelle</button>
            </form>
        </div>
    </div>
</div>
<script>
    @if(session('success'))
        Swal.fire({
            title: 'Başarılı!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'Tamam'
        });
    @endif
</script>
@endsection

