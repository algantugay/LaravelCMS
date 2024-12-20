@extends('frontend.layouts.app')

@section('title', $page->title)

@section('content')
<h1>{{ $page->title }}</h1>
<div>
    <p>Kategori: <a href="{{ route('frontend.category', $page->category->slug) }}">{{ $page->category->name }}</a></p>
    <p>{{ $page->created_at->format('d M Y') }}</p>
</div>
<div>
    {!! $page->content !!}
</div>
@endsection
