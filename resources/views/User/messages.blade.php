<div class="container mt-4">
    <h2 class="mb-4">Mesajlar</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Mesajları Listele -->
    <div class="list-group mb-4">
        @foreach($messages->sortByDesc('created_at') as $message) <!-- Mesajları oluşturulma tarihine göre sıraladık -->
            <div class="list-group-item {{ $message->sender_id == Auth::id() ? 'text-right' : 'text-left' }}">
                <strong>
                    @if($message->sender_id == Auth::id()) <!-- Eğer mesajı gönderen kimlik şu anki kullanıcı ise -->
                        Sen
                    @elseif($message->sender_id == 2) <!-- Admin ID'si (Admin'in gönderdiği mesaj) -->
                        Admin
                    @else
                        {{ $message->sender->name }} <!-- Diğer kullanıcılar -->
                    @endif
                </strong>
                <p>{{ $message->message }}</p>
                <span class="text-muted">{{ $message->created_at->diffForHumans() }}</span>

                @if($message->is_read)
                    <span class="badge bg-success">Okundu</span>
                @else
                    <span class="badge bg-warning">Okunmadı</span>
                @endif
            </div>
        @endforeach
    </div>

    <!-- Yeni Mesaj Gönderme Formu -->
    <h4>Yeni Mesaj Gönder</h4>
    <form action="{{ route('user.messages.send') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="message">Mesaj</label>
            <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Gönder</button>
    </form>
</div>

<style>
    .list-group-item {
        position: relative;
    }

    .list-group-item.text-right {
        background-color: #f1f1f1;
    }

    .list-group-item.text-left {
        background-color: #e9ecef;
    }

    .badge {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 0.8rem;
    }

    .text-muted {
        font-size: 0.8rem;
    }
</style>
