@extends('admin.admin_master')

@section('admin')
<div class="container-fluid" id="admin-panel">
    <div class="row">
        <!-- Toplam Kullanıcı Kartı -->
        <div class="col-md-6 col-lg-3 mb-4">
            <a href="{{ route('admin.users.index') }}" class="text-decoration-none">
                <div class="card text-white bg-success h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Toplam Kullanıcı</h5>
                        <p class="card-text">{{ $userCount }} Adet</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Aktif Kullanıcı Kartı -->
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card text-white bg-primary h-100 shadow-sm">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Aktif Kullanıcı</h5>
                    <p class="card-text">{{ $activeUserCount }} Adet</p>
                </div>
            </div>
        </div>

        <!-- Tüm Mesajlar Kartı -->
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card text-white bg-info h-100 shadow-sm">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Tüm Mesajlar</h5>
                    <p class="card-text">{{ $totalMessagesCount }} Adet</p>
                </div>
            </div>
        </div>

        <!-- Okunmamış Mesajlar Kartı -->
        <div class="col-md-6 col-lg-3 mb-4">
            <a href="{{ route('admin.messages.index') }}" class="text-decoration-none">
                <div class="card text-white bg-warning h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Okunmamış Mesajlar</h5>
                        <p class="card-text">{{ $unreadMessagesCount }} Adet</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Son 5 Yorum Listesi -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Son Yorumlar</h5>
                    <a href="{{ route('admin.comments.index') }}" class="btn btn-sm btn-light">Tümünü Gör</a>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($recentComments as $comment)
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 rounded mb-2">
                                <div>
                                    <strong>{{ $comment->name }}</strong>
                                    <p class="mb-0 text-muted">{{ Str::limit($comment->comment, 100, '...') }}</p>
                                </div>
                                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <!-- Son 5 Kullanıcı Listesi -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Son Kullanıcılar</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($recentUsers as $user)
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 rounded mb-2">
                                <div>
                                    <strong>{{ $user->name }}</strong>
                                    <p class="mb-0 text-muted">{{ $user->email }}</p>
                                </div>
                                <small>{{ $user->created_at->diffForHumans() }}</small>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #admin-panel .container-fluid {
        padding: 20px;
    }

    #admin-panel .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    #admin-panel .col-md-6, #admin-panel .col-lg-3 {
        margin-bottom: 20px;
    }

    #admin-panel .card {
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    #admin-panel .card:hover {
        transform: translateY(-5px);
    }

    #admin-panel .card-header h5 {
        font-size: 18px;
        font-weight: bold;
    }

    #admin-panel .card-body {
        padding: 20px;
    }

    #admin-panel .card-title {
        font-size: 18px;
        font-weight: bold;
    }

    #admin-panel .list-group-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #f8f9fa;
        border-radius: 5px;
        padding: 10px;
    }

    #admin-panel .list-group-item:hover {
        background-color: #e9ecef;
    }

    #admin-panel .btn {
        background-color: #17a2b8;
        color: #fff;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 14px;
    }

    #admin-panel .btn:hover {
        background-color: #138496;
    }

    #admin-panel .text-muted {
        font-size: 12px;
    }

    #admin-panel .card {
        margin-bottom: 30px;
    }

    #admin-panel .card:hover {
        transform: translateY(-5px);
        margin-top: 10px;
    }
</style>

@endsection
