@extends('user.dashboard')

@section('content')
    <div class="container mt-4">
        <h2 class="text-dark">Admin ile Mesajlar</h2>

        <!-- Mesajlar Alanı -->
        <div class="messages-container mb-4 p-3" style="background-color: #f4f6f9; border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); max-height: 450px; overflow-y: auto;" id="messages-container">
            @foreach($messages->sortBy('created_at') as $message)
                @if($message->sender_id == auth()->user()->id)
                    <!-- Kullanıcı Mesajı -->
                    <div class="message user-message d-flex justify-content-end mb-2">
                        <div class="message-box" style="background-color: #13263C; color: white; padding: 12px 18px; border-radius: 8px; max-width: 75%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                            <p><strong>Sen:</strong> {{ $message->message }}</p>
                        </div>
                    </div>
                @else
                    <!-- Admin Mesajı -->
                    <div class="message admin-message d-flex justify-content-start mb-2">
                        <div class="message-box p-3 rounded shadow-sm" style="max-width: 75%; background-color: {{ $message->is_read ? '#e0f7fa' : '#f7f7f7' }}; border-radius: 8px;">
                            <p><strong>Admin:</strong> {{ $message->message }}</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Yeni Mesaj Gönderme Formu -->
        <form action="{{ route('user.messages.send') }}" method="POST" class="mb-4">
            @csrf
            <div class="form-group">
                <textarea name="message" class="form-control" rows="3" placeholder="Mesajınızı yazın..." required style="border-radius: 8px; padding: 12px; font-size: 1rem;"></textarea>
            </div>

            <div class="d-flex justify-content-between mt-3">
                <button type="submit" class="btn" style="background-color: #13263C; color: white; padding: 12px 24px; border-radius: 8px; font-size: 1rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: background-color 0.3s ease;">
                    Gönder
                </button>

                <a href="{{ route('user.messages.index') }}" class="btn" style="background-color: #13263C; color: white; padding: 12px 24px; border-radius: 8px; font-size: 1rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: background-color 0.3s ease;">
                    Mesajlara Geri Dön
                </a>
            </div>
        </form>
    </div>

    <script>
        window.onload = function() {
            var messagesContainer = document.getElementById('messages-container');
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        };
    </script>
@endsection
