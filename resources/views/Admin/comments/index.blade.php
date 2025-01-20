@extends('admin.admin_master')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card body-->
                <div class="card-body py-4">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_comments">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-125px">Ad</th>
                                <th class="min-w-125px">E-posta</th>
                                <th class="min-w-125px">Yorum</th>
                                <th class="min-w-125px">Durum</th>
                                <th class="text-end min-w-100px">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @foreach ($comments as $comment)
                            <tr>
                                <td>{{ $comment->name }}</td>
                                <td>{{ $comment->email }}</td>
                                <td>{{ $comment->comment }}</td>
                                <td>
                                    @if($comment->status == 'published')
                                        <span class="badge badge-success">Yayınlanmış</span>
                                    @elseif($comment->status == 'rejected')
                                        <span class="badge badge-danger">Reddedilmiş</span>
                                    @else
                                        <span class="badge badge-warning">Taslak</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <!-- Durum Güncelleme Formu -->
                                    <form action="{{ route('admin.comments.updateStatus', ['id' => $comment->id]) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group mb-0">
                                            <select name="status" class="form-control form-control-solid" onchange="this.form.submit()" style="width: 150px;">
                                                <option value="pending" {{ $comment->status == 'pending' ? 'selected' : '' }}>Taslak</option>
                                                <option value="published" {{ $comment->status == 'published' ? 'selected' : '' }}>Yayınla</option>
                                                <option value="rejected" {{ $comment->status == 'rejected' ? 'selected' : '' }}>Reddet</option>
                                            </select>
                                        </div>
                                    </form>

                                    <!-- Yorum Silme Butonu -->
                                    <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Yorumu silmek istediğinizden emin misiniz?');">
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
                        {{ $comments->links('pagination::bootstrap-4') }}
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
