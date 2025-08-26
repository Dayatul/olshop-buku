<x-layout-front title="Blog - Wigati Buku">
    {{-- herosection --}}
    <section class="py-20 px-10 space-x-6 container mx-auto flex items-center justify-between ">
        <div class="container mx-auto w-3/6 text-center">
            <h4 class="text-4xl font-bold mb-4 text-gray-600">Carts</h4>
            <p class="text-lg mb-8 text-gray-600">Chekout sekarang juga!</p>
        </div>
    </section>
    {{-- Cart --}}
    /************* ✨ Windsurf Command ⭐ *************/
    <section class="container mx-auto">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2">Product Name</th>
                    <th class="px-4 py-2">Quantity</th>
                    <th class="px-4 py-2">Price</th>
                    <th class="px-4 py-2">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carts as $cart)
                    <tr>
                        <td class="px-4 py-2 border">{{ $cart->product->name }}</td>
                        <td class="px-4 py-2 border">{{ $cart->quantity }}</td>
                        <td class="px-4 py-2 border">Rp {{ number_format($cart->product->price, 0, ',', '.') }}</td>
                        <td class="px-4 py-2 border">Rp
                            {{ number_format($cart->quantity * $cart->product->price, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            <p class="text-lg">Total: Rp {{ number_format($total, 0, ',', '.') }}</p>
            <a href="{{ route('front.checkout') }}"
                class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded">Checkout</a>
        </div>
    </section>
    /******* e763dba7-bfeb-4d21-ad46-40e614cb5bfa *******/

</x-layout-front>
