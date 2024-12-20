<header>
    <nav>
        <ul>
            <li><a href="{{ route('frontend.index') }}">Anasayfa</a></li>
            @foreach ($categories as $category)
                <li><a href="{{ route('frontend.category', $category->slug) }}">{{ $category->name }}</a></li>
            @endforeach
        </ul>
    </nav>
</header>
