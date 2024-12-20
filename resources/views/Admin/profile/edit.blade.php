@extends('admin.admin_master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Profili Düzenle</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Ad</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ $profile->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="surname" class="form-label">Soyad</label>
                    <input type="text" name="surname" class="form-control" id="surname" value="{{ $profile->surname }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" value="{{ $profile->email }}" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Telefon</label>
                    <input type="text" name="phone" class="form-control" id="phone" value="{{ $profile->phone }}">
                </div>

                <div class="mb-3">
                    <label for="country" class="form-label">Ülke</label>
                    <input type="text" name="country" class="form-control" id="country" value="{{ $profile->country }}">
                </div>

                <div class="mb-3">
                    <label for="avatar" class="form-label">Profil Resmi</label>
                    <input type="file" name="avatar" class="form-control" id="avatar">
                    @if($profile->avatar)
                        <img src="{{ asset('storage/' . $profile->avatar) }}" alt="Avatar" class="img-thumbnail mt-2" style="max-width: 100px;">
                    @endif
                </div>

                <button type="submit" class="btn btn-success">Güncelle</button>
            </form>
        </div>
    </div>
</div>
@endsection
