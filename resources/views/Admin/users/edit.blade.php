@extends('admin.admin_master')

@section('content')
<div class="container">
    <div class="card">
        <!-- Başlık -->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title">
                <span class="card-label fw-bold fs-3 mb-1">Kullanıcıyı Düzenle</span>
            </h3>
        </div>
        <!-- İçerik -->
        <div class="card-body">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- İsim -->
                <div class="mb-3">
                    <label for="name" class="form-label">İsim</label>
                    <input type="text" name="name" id="name" class="form-control" 
                           value="{{ old('name', $user->name) }}" required>
                                @if ($errors->has('name'))
                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                @endif
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" 
                           value="{{ old('email', $user->email) }}" required>
                                @if ($errors->has('email'))
                                    <div class="text-danger">{{ $errors->first('email') }}</div>
                                @endif
                </div>

                <!-- Şifre -->
                <div class="mb-3">
                    <label for="password" class="form-label">Şifre (Opsiyonel)</label>
                    <input type="password" name="password" id="password" class="form-control">
                                @if ($errors->has('password'))
                                    <div class="text-danger">{{ $errors->first('password') }}</div>
                                @endif
                </div>

                <!-- Şifre Onayı -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Şifreyi Onayla</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                </div>

                <!-- Rol -->
                <div class="mb-3">
                    <label for="role" class="form-label">Rol</label>
                    <select name="role" id="role" class="form-select" required>
                        <option value="2" {{ $user->role_id == '2' ? 'selected' : '' }}>Admin</option>
                        <option value="1" {{ $user->role_id == '1' ? 'selected' : '' }}>User</option>
                    </select>
                </div>

                <!-- Güncelle Butonu -->
                <button type="submit" class="btn btn-primary">Güncelle</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">İptal</a>
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
