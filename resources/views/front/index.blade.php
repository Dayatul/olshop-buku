<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Olshop Buku</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
    {{-- navigation --}}
    <nav>
        <div class="container mx-auto flex items-center justify-between p-4">
            <a href="#" class="w-[150px]"><img src="{{ asset('/assets/images/logo-sample.webp') }}"
                    alt=""></a>
            <div class="flex space-x-6 font-semibold">
                <a href="#" class="hover:text-red-600">Home</a>
                <a href="#" class="hover:text-red-600">Product</a>
                <a href="#" class="hover:text-red-600">Blog</a>
                <a href="#" class="hover:text-red-600">About Us</a>
                <a href="#" class="hover:text-red-600">Contact</a>
            </div>
            <a href="{{ route('login') }}"
                class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded">Login</a>
        </div>
    </nav>

    {{-- herosection --}}
    <section class=" py-20 px-10 space-x-6 container mx-auto flex items-center justify-between">
        <div class="container mx-auto w-3/6">
            <h4 class="text-4xl font-bold mb-4 text-gray-600">Ribuan judul buku dari berbagai genre</h4>
            <p class="text-lg mb-8 text-gray-600">fiksi, nonfiksi, bisnis, pendidikan, hingga buku anak. Lengkap.
                Terjangkau. Cepat
                sampai</p>
            <a href="#" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded">Shop
                Now</a>
        </div>
        <div class="container mx-auto w-3/6">
            <img src="{{ asset('/assets/images/herosection.webp') }}" alt="">
        </div>
    </section>

    {{-- Categories Section --}}
    <section class="py-10 bg-gray-100 px-10 space-x-6">
        <div class="container mx-auto">
            {{-- <h2 class="text-3xl font-bold text-center mb-10">Categories</h2> --}}
            <div id="categoriesSlider" class="relative overflow-x-auto whitespace-nowrap flex justify-center">
                @forelse ($categories as $category)
                    <div class="inline-flex gap-2.5 items-center py-3 px-3.5 relative bg-white rounded-xl mr-4">
                        <img src="{{ Storage::url($category->icon) }}" class="size-10" alt="">
                        <a href="{{ route('front.product.category', $category->id) }}"
                            class="text-base font-semibold truncate stretched-link">
                            {{ $category->name }}
                        </a>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </section>
    {{-- end categories section --}}
    {{-- product section --}}
    <section class="py-20 bg-gray-50 px-10">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center mb-10">Featured Products</h2>
            @forelse ($products as $product)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 justify-center">
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            class="w-full h-48 object-cover mb-4 rounded">
                        <h3 class="text-xl font-semibold mb-2">{{ $product->name }}</h3>
                        <p class="text-gray-600 mb-4">{{ $product->description }}</p>
                        <span class="text-red-600 font-bold">${{ $product->price }}</span>
                    </div>
                </div>
            @empty
                <p class="text-lg mb-8 text-gray-600 text-center">Ups, Belum ada produk yang tersedia!</p>
            @endforelse
        </div>
    </section>
    {{-- end product section --}}

    {{-- Cta section --}}
    <section class="py-20 bg-gray-200 px-10">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center mb-10">Ready to start your reading journey?</h2>
            <p class="text-lg text-center mb-6">Discover our wide range of books and find your next favorite read.</p>
            <div class="flex justify-center">
                <a href="#" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded">Shop
                    Now</a>
            </div>
        </div>
    </section>

    {{-- blog section --}}
    <section class="py-20 px-10">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center mb-10">Latest Article Posts</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($articles as $article)
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
                            class="w-full h-48 object-cover mb-4 rounded">
                        <h3 class="text-xl font-semibold mb-2">{{ $article->title }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit($article->content, 100) }}</p>
                        <a href="#"" class="text-red-600 hover:underline">Read
                            More</a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- footer --}}
    <footer class="bg-gray-600 text-white py-4">
        <div class="container mx-auto text-center">
            <p class="text-sm">© {{ date('Y') }} Olshop Buku. All rights reserved.</p>

        </div>
    </footer>
</body>

</html>
