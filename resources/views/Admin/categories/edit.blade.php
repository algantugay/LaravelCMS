@extends('admin.admin_master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title">Kategoriyi Düzenle</h3>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary mb-3">Geri Dön</a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="name">İsim</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $category->name) }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="slug">Slug</label>
                    <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $category->slug) }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Güncelle</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/js/scripts.js') }}"></script>
@endsection
