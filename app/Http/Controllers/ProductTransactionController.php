<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use App\Models\ProductTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ProductTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();
        if ($user->hasRole('buyer')) {
            $product_transactions = $user->productTransactions()->orderBy('created_at', 'desc')->get();
        } else {
            $product_transactions = ProductTransaction::orderBy('created_at', 'desc')->get();
        }
        return view('admin.product_transaction.index', ['product_transactions' => $product_transactions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for creating a detail.
     */
    public function detail()
    {
        //

        return view('admin.product_transaction.details');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $cartItems = $user->carts;
        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Ups, Balum ada produk yang anda masukan ke keranjang!');
        }

        $validated = $request->validate([
            'address' => 'required|string|max:512',
            'city' => 'required|string|max:255',
            'post_code' => 'required|integer',
            'phone_number' => 'required',
            'notes' => 'max:65535',
            'proof' => 'required|image|mimes:png,jpg,jpeg',
        ]);
        DB::beginTransaction();
        try {
            $cartItems = $user->carts;
            if ($cartItems->isEmpty()) {
                throw new \Exception('Your cart is empty');
            }

            $subTotalCent = 0;
            $deliveryFeeCent = 0 * 100;

            $cartItems = $user->carts;
            foreach ($cartItems as $item) {
                $subTotalCent += $item->product->price * 100;
            }

            $taxCent = (11 / 100) * $subTotalCent;
            $insuranceCent = (23 / 100) * $subTotalCent;
            $grandTotalCent = $subTotalCent + $deliveryFeeCent + $taxCent + $insuranceCent;

            $grandTotal = $grandTotalCent / 100;

            $validated['user_id'] = $user->id;
            $validated['total_amount'] = $grandTotal;
            $validated['is_paid'] = false;

            if ($request->hasFile('proof')) {
                $proofPath = $request->file('proof')->store('payment_proofs', 'public');
                $validated['proof'] = $proofPath;
            }

            $newTransaction = ProductTransaction::create($validated);

            foreach ($cartItems as $item) {
                TransactionDetail::create([
                    'product_transaction_id' => $newTransaction->id,
                    'product_id' => $item->product_id,
                    'price' => $item->product->price,
                    'qty' => 1,
                ]);
                $item->delete();
            }
            DB::commit();
            return redirect()->route('product_transactions.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['System error!' . $e->getMessage()],
            ]);
            throw $error;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductTransaction $productTransaction)
    {
        $productTransaction = ProductTransaction::with('transactionDetails.product')->find($productTransaction->id);
        return view('admin.product_transaction.details', ['product_transaction' => $productTransaction]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductTransaction $productTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductTransaction $product_transaction)
    {
        //
        // echo "Gagal";
        // dd($productTransaction);
        $product_transaction->update([
            'is_paid' => true,
        ]);
        return redirect()->back()->with('success', 'Product Transaction Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductTransaction $productTransaction)
    {
        //
    }
}
