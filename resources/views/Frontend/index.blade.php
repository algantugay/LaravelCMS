@extends('frontend.layouts.app')

@section('title', 'Anasayfa')

@section('content')
<h1>Son Eklenen Sayfalar</h1>
<div class="row">
    @foreach ($pages as $page)
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">{{ $page->title }}</h5>
                    <p>{{ Str::limit($page->content, 100) }}</p>
                    <a href="{{ route('frontend.page', $page->slug) }}" class="btn btn-primary">Devamını Oku</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
{{ $pages->links() }}
@endsection
