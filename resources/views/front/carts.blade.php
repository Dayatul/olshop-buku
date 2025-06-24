<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart | Parma</title>
    <link rel="shortcut icon" href="{{ asset('/assets/svgs/logo-mark.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('/assets/css/main.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <!-- Topbar -->
    <section class="relative flex items-center justify-between w-full gap-5 wrapper">
        <a href="{{ route('front.index') }}" class="p-2 bg-white rounded-full">
            <img src="{{ asset('/assets/svgs/ic-arrow-left.svg') }}" class="size-5" alt="">
        </a>
        <p class="absolute text-base font-semibold translate-x-1/2 -translate-y-1/2 top-1/2 right-1/2">
            Shopping Carts
        </p>
    </section>
    @error('error')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
    <!-- Items -->
    <section class="wrapper flex flex-col gap-2.5">
        <div class="flex items-center justify-between">
            <p class="text-base font-bold">
                Items
            </p>
            <button type="button" class="p-2 bg-white rounded-full" data-expand="itemsList">
                <img src="{{ asset('/assets/svgs/ic-chevron.svg') }}"
                    class="transition-all duration-300 -rotate-180 size-5" alt="">
            </button>
        </div>
        <div class="flex flex-col gap-4" id="itemsList">
            @forelse ($my_carts as $cart)
                <!-- List Product -->
                <div class="py-3.5 pl-4 pr-[22px] bg-white rounded-2xl flex gap-1 items-center relative">
                    <img src=" {{ Storage::url($cart->product->photo) }}"
                        class="w-full max-w-[70px] max-h-[70px] object-contain" alt="">
                    <div class="flex flex-wrap items-center justify-between w-full gap-1">
                        <div class="flex flex-col gap-1">
                            <a href="{{ route('front.product.details', $cart->product->slug) }}"
                                class="text-base font-semibold  whitespace-nowrap w-[150px] truncate">
                                {{ $cart->product->name }}
                            </a>
                            <p class="text-sm text-grey product-price" data-price="{{ $cart->product->price }}">
                                Rp. {{ number_format($cart->product->price) }}
                            </p>
                        </div>
                        <form action="{{ route('carts.destroy', $cart) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <img src="{{ asset('/assets/svgs/ic-trash-can-filled.svg') }}" class="size-[30px]"
                                    alt="">
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p>
                    Ups, Belum ada produk yang ditambahkan!
                </p>
            @endforelse


        </div>
    </section>

    <!-- Details Payment -->
    <section class="wrapper flex flex-col gap-2.5">
        <div class="flex items-center justify-between">
            <p class="text-base font-bold">
                Details Payment
            </p>
            <button type="button" class="p-2 bg-white rounded-full" data-expand="__detailsPayment">
                <img src="{{ asset('/assets/svgs/ic-chevron.svg') }}" class="transition-all duration-300 size-5"
                    alt="">
            </button>
        </div>
        <div class="p-6 bg-white rounded-3xl" id="__detailsPayment" style="display: none;">
            <ul class="flex flex-col gap-5">
                <li class="flex items-center justify-between">
                    <p class="text-base font-semibold first:font-normal">
                        Sub Total
                    </p>
                    <p class="text-base font-semibold first:font-normal" id="checkoutSubTotal">

                    </p>
                </li>
                <li class="flex items-center justify-between">
                    <p class="text-base font-semibold first:font-normal">
                        PPN 11%
                    </p>
                    <p class="text-base font-semibold first:font-normal" id="checkoutTax">

                    </p>
                </li>
                <li class="flex items-center justify-between">
                    <p class="text-base font-semibold first:font-normal">
                        Insurance 23%
                    </p>
                    <p class="text-base font-semibold first:font-normal" id="checkoutInsurance">

                    </p>
                </li>
                <li class="flex items-center justify-between">
                    <p class="text-base font-semibold first:font-normal">
                        Delivery (Promo)
                    </p>
                    <p class="text-base font-semibold first:font-normal" id="checkoutDeliveryFee">

                    </p>
                </li>
                <li class="flex items-center justify-between">
                    <p class="text-base font-bold first:font-normal">
                        Grand Total
                    </p>
                    <p class="text-base font-bold first:font-normal text-primary" id="checkoutGrandTotal">

                    </p>
                </li>
            </ul>
        </div>
    </section>

    <!-- Payment Method -->
    <section class="wrapper flex flex-col gap-2.5">
        <div class="flex items-center justify-between">
            <p class="text-base font-bold">
                Payment Method
            </p>
        </div>
        <div class="grid items-center grid-cols-2 gap-4">
            <label
                class="relative rounded-2xl bg-white flex gap-2.5 px-3.5 py-3 items-center justify-start has-[:checked]:ring-2 has-[:checked]:ring-primary transition-all">
                <input type="radio" name="payment_method" id="manualMethod" class="absolute opacity-0">
                <img src="{{ asset('/assets/svgs/ic-receipt-text-filled.svg') }}" alt="">
                <p class="text-base font-semibold">
                    Manual
                </p>
            </label>
            <label
                class="relative rounded-2xl bg-white flex gap-2.5 px-3.5 py-3 items-center justify-start has-[:checked]:ring-2 has-[:checked]:ring-primary transition-all">
                <input type="radio" name="payment_method" id="creditMethod" class="absolute opacity-0">
                <img src="{{ asset('/assets/svgs/ic-card-filled.svg') }}" alt="">
                <p class="text-base font-semibold">
                    Credits
                </p>
                </lab>
        </div>
        <div class="p-4 mt-0.5 bg-white rounded-3xl hidden" id="manualPaymentDetail">
            <div class="flex flex-col gap-5">
                <p class="text-base font-bold">
                    Send Payment to
                </p>
                <div class="inline-flex items-center gap-2.5">
                    <img src="{{ asset('/assets/svgs/ic-bank.svg') }}" class="size-5" alt="">
                    <p class="text-base font-semibold">
                        MANDIRI - USAHA
                    </p>
                </div>
                <div class="inline-flex items-center gap-2.5">
                    <img src="{{ asset('/assets/svgs/ic-security-card.svg') }}" class="size-5" alt="">
                    <p class="text-base font-semibold">
                        11223322
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Delivery to -->
    <section class="wrapper flex flex-col gap-2.5 pb-40">
        <div class="flex items-center justify-between">
            <p class="text-base font-bold">
                Delivery to
            </p>
            <button type="button" class="p-2 bg-white rounded-full" data-expand="deliveryForm">
                <img src="{{ asset('/assets/svgs/ic-chevron.svg') }}"
                    class="transition-all duration-300 -rotate-180 size-5" alt="">
            </button>
        </div>
        <form action="{{ route('product_transactions.store') }}" enctype="multipart/form-data" method="POST"
            class="p-6 bg-white rounded-3xl" id="deliveryForm">
            @csrf
            @method('POST')
            <div class="flex flex-col gap-5">
                <!-- Address -->
                <div class="flex flex-col gap-2.5">
                    <label for="address" class="text-base font-semibold">Address</label>
                    <input type="text" name="address" id="address__"
                        style="background-image: url('/assets/svgs/ic-location.svg');"
                        class="form-input form-control @error('address') is-invalid @enderror"
                        value="{{ old('address') }}" placeholder="your address"
                        @error('address') autofocus @enderror>
                    @error('address')
                        <div class="pl-px invalid-feedback color-red-400" autofocus>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <!-- City -->
                <div class="flex flex-col gap-2.5">
                    <label for="city" class="text-base font-semibold">City</label>
                    <input type="text" name="city" id="city__"
                        style="background-image: url('/assets/svgs/ic-map.svg');"
                        class="form-input bg-[url('/public/assets/svgs/ic-map.svg')] @error('city') is-invalid @enderror"
                        value="{{ old('city') }}" placeholder="your city">
                    @error('city')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <!-- Post Code -->
                <div class="flex flex-col gap-2.5">
                    <label for="post_code" class="text-base font-semibold">Post Code</label>
                    <input type="number" name="post_code" id="postcode__"
                        style="background-image: url('/assets/svgs/ic-house.svg');"
                        class="form-input bg-[url('/public/assets/svgs/ic-house.svg')] @error('post_code') is-invalid @enderror"
                        value="{{ old('post_code') }}" placeholder="post code">
                    @error('post_code')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <!-- Phone Number -->
                <div class="flex flex-col gap-2.5">
                    <label for="phone_number" class="text-base font-semibold">Phone Number</label>
                    <input type="number" name="phone_number" id="phonenumber__"
                        style="background-image: url('/assets/svgs/ic-phone.svg');"
                        class="form-input bg-[url('/public/assets/svgs/ic-phone.svg')] @error('phone_number') is-invalid @enderror"
                        value="{{ old('phone_number') }}" placeholder="your phone number">
                    @error('phone_number')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <!-- Add. Notes -->
                <div class="flex flex-col gap-2.5">
                    <label for="notes" class="text-base font-semibold">Add. Notes</label>
                    <span class="relative">
                        <img src="{{ asset('assets/svgs/ic-edit.svg') }}" class="absolute size-5 top-4 left-4"
                            alt="">
                        <textarea name="notes" id="notes__"
                            class="form-input !rounded-2xl w-full min-h-[150px] @error('notes') is-invalid @enderror"
                            placeholder="Add your note"></textarea>
                    </span>
                    @error('notes')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Proof of Payment -->
                <div class="flex flex-col gap-2.5">
                    <label for="proof" class="text-base font-semibold">Proof of Payment</label>
                    <input type="file" name="proof" id="proof_of_payment__"
                        style="background-image: url('/assets/svgs/ic-folder-add.svg');"
                        class="form-input bg-[url('/public/assets/svgs/ic-folder-add.svg')]"
                        @error('proof') is-invalid @enderror>
                    @error('proof')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            </div>

    </section>

    <!-- Floating grand total -->
    <div
        class="fixed z-50 bottom-[30px] bg-black rounded-3xl p-5 left-1/2 -translate-x-1/2 w-[calc(100dvw-32px)] max-w-[425px]">
        <section class="flex items-center justify-between gap-5">
            <div>
                <p class="text-sm text-grey mb-0.5">
                    Grand Total
                </p>
                <p class="text-lg min-[350px]:text-2xl font-bold text-white" id="grandTotalFloat">
                </p>
            </div>
            <button type="submit"
                class="inline-flex items-center justify-center px-5 py-3 text-base font-bold text-white rounded-full w-max bg-primary whitespace-nowrap">
                Confirm
            </button>
        </section>
    </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('/assets/scripts/global.js') }}"></script>
    <script>
        function calculatePrice() {
            let subTotal = 0;
            let tax = 0;
            let insurance = 0;
            let deleveryFee = 0;
            let grandTotal = 0;

            //get data sub total
            document.querySelectorAll('.product-price').forEach(item => {
                subTotal += parseFloat(item.getAttribute('data-price'));
            });

            //view data delevery fee
            document.getElementById('checkoutDeliveryFee').textContent = 'Rp ' + deleveryFee.toLocaleString('id', {
                minimumFractionDigits: 2,
                maximumFractionDigit: 2
            });

            //view data sub total
            document.getElementById('checkoutSubTotal').textContent = 'Rp ' + subTotal.toLocaleString('id', {
                minimumFractionDigits: 2,
                maximumFractionDigit: 2
            });

            //view tax
            tax += (11 / 100) * subTotal;
            document.getElementById('checkoutTax').textContent = 'Rp ' + tax.toLocaleString('id', {
                minimumFractionDigits: 2,
                maximumFractionDigit: 2
            });

            //view insurance
            insurance += (23 / 100) * subTotal;
            document.getElementById('checkoutInsurance').textContent = 'Rp ' + insurance.toLocaleString('id', {
                minimumFractionDigits: 2,
                maximumFractionDigit: 2
            });

            //view grand total
            grandTotal += subTotal + tax + insurance;
            document.getElementById('checkoutGrandTotal').textContent = 'Rp ' + grandTotal.toLocaleString('id', {
                minimumFractionDigits: 2,
                maximumFractionDigit: 2
            });

            document.getElementById('grandTotalFloat').textContent = 'Rp ' + grandTotal.toLocaleString('id', {
                minimumFractionDigits: 2,
                maximumFractionDigit: 2
            });

        }

        document.addEventListener('DOMContentLoaded', function() {
            calculatePrice();
        });
    </script>
</body>

</html>
