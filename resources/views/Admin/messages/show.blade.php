@extends('admin.admin_master')

@section('content')
    <div class="container mt-4">
        <h2 class="text-dark">{{ $user->name }} ile Mesajlar</h2>

        <div class="messages-container mb-4 p-3" style="background-color: #f7f7f7; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); max-height: 450px; overflow-y: auto;" id="messages-container">
            @foreach($messages as $message)
            @if($message->sender_id == auth()->user()->id)
                <div class="message admin-message d-flex justify-content-end mb-2">
                    <div class="message-box" style="background-color: #13263C; color: white; padding: 10px 15px; border-radius: 5px; border: 2px solid #13263C; max-width: 70%; ">
                        <p><strong>Admin:</strong> {{ $message->message }}</p>
                    </div>
                </div>
            @else
                <div class="message user-message d-flex justify-content-start mb-2">
                    <div class="message-box bg-light text-dark p-3 rounded shadow-sm" style="max-width: 70%; background-color: {{ $message->is_read ? '#e0f7fa' : '#f7f7f7' }};">
                        <p><strong>{{ $user->name }}:</strong> {{ $message->message }}</p>
                    </div>
                </div>
            @endif
        @endforeach           
        </div>
        <form action="{{ route('admin.messages.reply') }}" method="POST" class="mb-4">
            @csrf
            <input type="hidden" name="receiver_id" value="{{ $user->id }}">

            <div class="form-group">
                <textarea name="message" class="form-control" rows="3" placeholder="Mesajınızı yazın..." required></textarea>
            </div>

            <div class="d-flex justify-content-between mt-3">
                <button type="submit" class="btn" style="background-color: #13263C; color: white; padding: 10px 20px; border-radius: 5px;">Gönder</button>
                
                <a href="{{ route('admin.messages.index') }}" class="btn" style="background-color: #13263C; color: white; padding: 10px 20px; border-radius: 5px;">Mesajlara Geri Dön</a>
            </div>
        </form>
    </div>

    <script>
        window.onload = function() {
            var messagesContainer = document.getElementById('messages-container');
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        };
    </script>
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
