<x-layout-front title="Contact - Wigati Buku">
    {{-- herosection --}}
    <section class="py-20 px-10 space-x-6 container mx-auto flex items-center justify-between ">
        <div class="container mx-auto w-3/6 text-center">
            <h4 class="text-4xl font-bold mb-4 text-gray-600">Contact</h4>
            <p class="text-lg mb-8 text-gray-600">Hubungi Wigati Buku</p>
        </div>
    </section>
    {{-- Contact section --}}
    <section class="py-20 px-10 bg-gray-50 container mx-auto">
        <h2 class="text-3xl font-bold text-center mb-10 text-gray-600">Hubungi Kami</h2>
        <p class="text-lg mb-6 text-gray-600">Jika Anda memiliki pertanyaan atau masalah, jangan ragu untuk menghubungi
            kami melalui formulir di bawah ini. Kami akan berusaha untuk merespons secepat mungkin.</p>
        <form action="#" method="POST" class="max-w-2xl mx-auto">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold mb-2">Nama</label>
                <input type="text" id="name" name="name" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-600">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                <input type="email" id="email" name="email" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-600">
            </div>
            <div class="mb-4">
                <label for="message" class="block text-gray-700 font-semibold mb-2">Pesan</label>
                <textarea id="message" name="message" rows="5" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-600"></textarea>
            </div>
            <div class="text-center">
                <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-8 rounded-full transition">
                    Kirim Pesan
                </button>
            </div>
        </form>
    </section>
    {{-- Section CTA --}}
    <section>
        <div class="py-20 px-10 bg-white container mx-auto">
            <p class="text-2xl font-bold text-center text-gray-600 mb-6 px-6">Ingin tahu lebih banyak
                tentang Wigati
                Buku?
            </p>
            <div class="text-center">
                <a href="{{ route('front.about') }}"
                    class="bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-8 rounded-full transition">
                    About Us
                </a>
            </div>
        </div>
    </section>
</x-layout-front>
