@php
    $comments = App\Models\Comment::where('status', 'Published')->get();
@endphp

<div class="mt-20 mb-n20 position-relative z-index-2">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Heading-->
        <div class="text-center mb-17">
            <h3 class="fs-2hx text-dark mb-5" id="comment" data-kt-scroll-offset="{default: 125, lg: 150}">Müşterilerimiz Ne Diyor?</h3>
        </div>
        <!--end::Heading-->
        <!--begin::Row-->
        <div class="row g-lg-10 mb-10 mb-lg-20">
            @foreach($comments as $comment)
                <div class="col-lg-4">
                    <!--begin::Testimonial-->
                    <div class="card shadow-sm h-lg-100 px-4 py-4">
                        <div class="mb-7">
                            <div class="rating mb-3">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="ki-duotone ki-star fs-5 me-2 @if($i <= $comment->rating) text-warning @else text-muted @endif"></i>
                                @endfor
                            </div>
                            <div class="text-gray-500 fw-semibold fs-5 mb-4">"{{ $comment->comment }}"</div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <a href="#" class="text-dark fw-bold text-hover-primary fs-6">{{ $comment->name }}</a>
                            </div>
                        </div>
                    </div>
                    <!--end::Testimonial-->
                </div>
            @endforeach
        </div>
        <!--end::Row-->
    </div>
        <!--begin::Yorum Yapma Formu-->
        <div class="mt-10">
            <div class="card shadow-lg p-5">
                <h4 class="fs-3 text-dark mb-5 text-center py-3 rounded">Yorumunuzu Bırakın</h4>
                <form action="{{ route('comments.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <label for="name" class="form-label fw-semibold">Adınız</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Adınızı girin" required>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <label for="email" class="form-label fw-semibold">E-posta</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="E-posta adresinizi girin" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="comment" class="form-label fw-semibold">Yorumunuz</label>
                        <textarea id="comment" name="comment" rows="4" class="form-control" placeholder="Yorumunuzu yazın" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="rating" class="form-label fw-semibold">Derecelendirme</label>
                        <div class="d-flex justify-content-start">
                            @for ($i = 1; $i <= 5; $i++)
                                <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" class="rating-input" />
                                <label for="star{{ $i }}" class="rating-star">
                                    <i class="ki-duotone ki-star fs-3"></i>
                                </label>
                            @endfor
                        </div>
                    </div>
                    <div class="mb-4 text-center">
                        <button type="submit" class="btn btn-primary btn-lg">Yorum Gönder</button>
                    </div>
                </form>
            </div>
        </div>
        <!--end::Yorum Yapma Formu-->
</div>

<style>
.card {
    border-radius: 10px;
    background-color: #fff;
    padding: 20px;
    margin-top: 10px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
}

.card .rating {
    display: flex;
    justify-content: start;
}

.form-control {
    border: 1px solid #ddd;
    padding: 10px 15px;
}

.form-control.rounded-pill {
    border-radius: 50px;
}

textarea.form-control {
    resize: none;
}

.rating-input {
    display: none;
}

.rating-star {
    cursor: pointer;
    margin-right: 5px;
}

.rating-star i {
    color: #ddd;
    transition: color 0.2s ease;
}

.rating-input:checked + .rating-star i {
    color: #ffcc00;
}

.rating-star:hover i {
    color: #ffcc00;
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const stars = document.querySelectorAll('.rating-input');
    const labels = document.querySelectorAll('.rating-star i');

    stars.forEach((star, index) => {
        star.addEventListener('change', function() {
            const ratingValue = this.value;

            labels.forEach((label, i) => {
                if (i < ratingValue) {
                    label.style.color = '#ffcc00';
                } else {
                    label.style.color = '#ddd';
                }
            });
        });
    });

    labels.forEach((label, index) => {
        label.addEventListener('mouseover', () => {
            labels.forEach((label, i) => {
                if (i <= index) {
                    label.style.color = '#ffcc00';
                } else {
                    label.style.color = '#ddd';
                }
            });
        });

        label.addEventListener('mouseout', () => {
            const selectedRating = document.querySelector('input[name="rating"]:checked');
            const ratingValue = selectedRating ? selectedRating.value : 0;

            labels.forEach((label, i) => {
                if (i < ratingValue) {
                    label.style.color = '#ffcc00'; // Tıklanan yıldızlar sarı kalacak
                } else {
                    label.style.color = '#ddd'; // Diğerleri gri kalacak
                }
            });
        });
    });
});
</script>