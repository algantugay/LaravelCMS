@extends('frontend.layouts.app')

@section('title', $category->name . ' Kategorisi')

@section('content')
<h1>{{ $category->name }} Kategorisindeki Sayfalar</h1>
<div class="row">
    @foreach ($pages as $page)
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5>{{ $page->title }}</h5>
                    <p>{{ Str::limit($page->content, 100) }}</p>
                    <a href="{{ route('frontend.page', ['slug' => $page->slug]) }}" class="btn btn-primary">Devamını Oku</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
{{ $pages->links() }}
@endsection
