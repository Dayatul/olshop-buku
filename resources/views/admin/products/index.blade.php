<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row w-full justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage product') }}
            </h2>
            <a href="{{ route('admin.products.create') }}"
                class="font-bold py-3 px-5 rounded-full text-white bg-indigo-700">Add
                product</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex flex-col gap-y-5 p-10 overflow-hidden shadow-sm sm:rounded-lg">
                @forelse($products as $product)
                    <div class="item-card flex flex-row justify-between items-center">
                        <div class="flex flex-row items-center gap-x-3">
                            <img src="{{ Storage::url($product->photo) }}" alt="" class="w-[50px] h-[50px]">
                            <div>
                                <h3 class="text-xl font-bold text-indigo-900">{{ $product->name }}</h3>
                                <p class="text-base text-slate-500">
                                    Rp. {{ $product->price }}
                                </p>
                            </div>
                        </div>
                        <p class="text-base text-slate-500">
                            {{ $product->category->name }}
                        </p>
                        <div class="flex flex-row items-center gap-x-3">
                            <a href="{{ route('admin.products.edit', $product) }}"
                                class="font-bold py-3 px-5 rounded-full text-white bg-yellow-500">Edit</a>
                            <form method="POST" action="{{ route('admin.products.destroy', $product) }}">
                                @csrf
                                @method('DELETE')
                                <button class="font-bold py-3 px-5 rounded-full text-white bg-red-700">Delete</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p>
                        Ups, belum ada produk nih, <b>coba lagi nanti ya!</b>
                    </p>
                @endforelse
            </div>
        </div>
</x-app-layout>
