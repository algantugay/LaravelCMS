@extends('admin.admin_master')

@section('content')
<div class="container">
    <div class="card">
        <!-- Başlık -->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title">
                <span class="card-label fw-bold fs-3">Kullanıcı Listesi</span>
            </h3>
        </div>
        <!-- İçerik -->
        <div class="card-body py-3">
            <div class="table-responsive">
                <!-- Başarı Mesajı -->
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <!-- Kullanıcı Tablosu -->
                <table id="kt_datatable" class="table table-row-bordered gy-5">
                    <thead>
                        <tr class="fw-semibold fs-6 text-muted">
                            <th class="text-center">ID</th>
                            <th>İsim</th>
                            <th>Rol</th>
                            <th>Email</th>
                            <th>Kayıt Tarihi</th>
                            <th class="text-center">Eylemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="text-center">{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->role->role }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->format('d-m-Y') }}</td>
                                <td class="text-center">
                                    <!-- Düzenle Butonu -->
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">
                                        <i class="ki-duotone ki-setting-2 fs-4"></i> Düzenle
                                    </a>
                                    <!-- Sil Butonu -->
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="ki-duotone ki-trash fs-4"></i> Sil</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Toplam Kullanıcı Sayısı -->
                <div class="d-flex justify-content-between mt-3">
                    <p class="text-muted">Toplam Kullanıcı Sayısı: <strong>{{ $users->count() }}</strong></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Metronic JS -->
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>

<!-- DataTable JS -->
<script>
    $(document).ready(function () {
        $('#kt_datatable').DataTable({
            responsive: true,
            paging: true,
            ordering: true,
            info: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/Turkish.json' // Türkçe desteği
            }
        });
    });
</script>
@endsection
