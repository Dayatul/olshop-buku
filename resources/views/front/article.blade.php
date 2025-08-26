<x-layout-front title="Blog - Wigati Buku">
    {{-- article section --}}
    <section class="py-20 px-10 space-x-6 container mx-auto flex items-center justify-between">
        <div class="container mx-auto w-3/6 text-center">
            <h4 class="text-4xl font-bold mb-4 text-gray-600">{{ $article->title }}</h4>
            <p class="text-lg mb-8 text-gray-600">By {{ $article->user->name }} |
                {{ $article->created_at->format('d M Y') }}
            </p>
        </div>
    </section>
    <section class="container mx-auto px-10 mb-20">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <img src="{{ Storage::url($article->featured_image) }}" alt="{{ $article->title }}"
                class="w-full h-96 object-cover mb-4 rounded">
            <div class="prose max-w-none">
                {!! $article->content !!}
            </div>
        </div>
    </section>
    {{-- end article section --}}
    {{-- blog section --}}
    <section class="py-20 px-10 bg-gray-100">
        <div class="container mx-auto ">
            <h2 class="text-3xl font-bold text-center mb-10">Latest Article Posts</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($articles as $article)
                    <div class="bg-white p-6 rounded-lg shadow-lg hover:scale-105 transition">
                        <img src=" {{ Storage::url($article->featured_image) }}  " alt="{{ $article->title }}"
                            class="w-full h-48 object-cover mb-4 rounded">
                        <h3 class="text-xl font-semibold mb-2">{{ $article->title }}</h3>
                        <p class="text-gray-600 mb-4"> {{ Str::limit(strip_tags($article->content), 100, '...') }}</p>
                        <a href="{{ route('front.article.details', $article->slug) }}"
                            class="text-red-600 hover:underline">Read
                            More</a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-layout-front>
