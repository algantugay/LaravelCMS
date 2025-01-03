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
                    @if($users->isEmpty())
                        <p class="text-center text-muted">Henüz mesaj gönderen kullanıcı yok.</p>
                    @else
                    <div class="card-header">
                        <table class="table align-middle table-row-dashed fs-6 gy-5">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px">Ad</th>
                                    <th class="min-w-125px">E-posta</th>
                                    <th class="min-w-125px">Son Mesaj</th>
                                    <th class="text-end min-w-100px">İşlemler</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->sender->name }}</td>
                                    <td>{{ $user->sender->email }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($user->message, 50) }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.messages.show', $user->sender_id) }}" 
                                            class="btn btn-sm btn-light">
                                            Mesajları Gör
                                        </a>
                                        <form action="{{ route('admin.messages.destroyUserMessages', $user->sender_id) }}" 
                                              method="POST" 
                                              class="d-inline-block" 
                                              onsubmit="return confirm('Bu kullanıcıya ait tüm mesajları silmek istediğinizden emin misiniz?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light text-danger">
                                                Tüm Mesajları Sil
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
@endsection
