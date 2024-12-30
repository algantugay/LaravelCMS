<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İLETİŞİM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="contact-form-container">
        <h2 class="form-heading">İLETİŞİM</h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form action="{{ route('contact.submit') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">İsim</label>
                <input type="text" class="form-control" id="name" name="name" required placeholder="Adınızı giriniz">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required placeholder="Email adresinizi giriniz">
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Mesaj</label>
                <textarea class="form-control" id="message" name="message" rows="6" required placeholder="Mesajınızı buraya yazınız"></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Gönder</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<style>
    .contact-form-container {
        background-color: #f8f9fa;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 30px;
    }

    .form-heading {
        font-size: 2rem;
        margin-bottom: 20px;
        color: #13263C;
    }

    .btn-primary {
        background-color: #13263C;
        border-color: #13263C;
        transition: background-color 0.3s, border-color 0.3s;
    }

    .btn-primary:hover {
        background-color: #13263C;
        border-color: #13263C;
    }

    .alert {
        margin-top: 20px;
    }
</style>
