@extends('admin.admin_master')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Card-->
            <div class="card shadow-sm">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        <h2 class="mb-4">Mesajlar</h2>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body py-4">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_messages">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-75px">ID</th> <!-- Genişlik küçültüldü -->
                                    <th class="min-w-125px">İsim</th>
                                    <th class="min-w-125px">Email</th>
                                    <th class="min-w-125px">Mesaj</th>
                                    <th class="min-w-125px">Tarih</th>
                                    <th class="min-w-125px">Cevap</th>
                                    <th class="text-end min-w-100px">Eylemler</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                @foreach($messages as $message)
                                <tr>
                                    <td>{{ $message->id }}</td>
                                    <td>{{ $message->name }}</td>
                                    <td>{{ $message->email }}</td>
                                    <td>{{ Str::limit($message->message, 50, '...') }}</td>
                                    <td>{{ $message->created_at->format('d/m/Y H:i') }}</td>
                                    <td>{{ $message->reply ?? 'Henüz yanıt verilmedi.' }}</td>
                                    <td class="text-end">
                                        <!-- Butonları yan yana koymak için d-flex kullanılıyor -->
                                        <div class="d-flex">
                                            <!-- Cevapla Butonu -->
                                            <a href="{{ route('admin.messages.reply', $message->id) }}" class="btn btn-sm btn-light me-2">
                                                <i class="fas fa-reply"></i> Cevapla
                                            </a>
                                            <!-- Silme Butonu -->
                                            <form action="{{ route('admin.messages.delete', $message->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Bu mesajı silmek istediğinize emin misiniz?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-light text-danger">
                                                    <i class="fas fa-trash"></i> Sil
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div>
                        {{ $messages->links('pagination::bootstrap-4') }}
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>

<script>
document.querySelector('[data-kt-user-table-filter="search"]').addEventListener('input', function() {
    let searchTerm = this.value.toLowerCase();
    let rows = document.querySelectorAll('#kt_table_messages tbody tr');

    rows.forEach(function(row) {
        let name = row.querySelector('td').textContent.toLowerCase();
        if (name.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
</script>

@endsection
