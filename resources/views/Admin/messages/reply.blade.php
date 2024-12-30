@extends('admin.admin_master')

@section('contact')
<div class="container mt-5">
    <h2 class="mb-4">Mesajı Yanıtla</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <!-- Message Details -->
            <h5 class="card-title">MESAJ DETAYLARI</h5>
            <div class="mb-3">
                <label for="sender-name" class="form-label">Gönderi İsim</label>
                <input type="text" class="form-control" id="sender-name" value="{{ $message->name }}" readonly>
            </div>
            <div class="mb-3">
                <label for="sender-email" class="form-label">Gönderici Email</label>
                <input type="email" class="form-control" id="sender-email" value="{{ $message->email }}" readonly>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Mesaj İçeriği</label>
                <textarea class="form-control" id="message" rows="4" readonly>{{ $message->message }}</textarea>
            </div>
            <!-- Reply Form -->
            <hr>
            <h5 class="card-title">YANITINIZ</h5>
            <form action="{{ route('admin.messages.reply.submit', $message->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="reply" class="form-label">Yanıtınızı yazınız.</label>
                    <textarea class="form-control" id="reply" name="reply" rows="4" required>{{ $message->reply }}</textarea>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.messages') }}" class="btn btn-secondary">Mesajlara geri dön</a>
                    <button type="submit" class="btn btn-success">Yanıtı Gönder</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
