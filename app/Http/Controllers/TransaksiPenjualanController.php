<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiPenjualan;
use App\Models\DetailTransaksiPenjualan;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class TransaksiPenjualanController extends Controller
{
    /**
     * Display a listing of the transactions.
     *
     * @return View
     */
    public function index(): View
    {
        $transaksi = TransaksiPenjualan::with('details.product')->get();
        return view('transaksi.index', compact('transaksi'));
    }

    /**
     * Show the form for creating a new transaction.
     *
     * @return View
     */
    public function create(): View
    {
        $products = Product::all();
        return view('transaksi.create', compact('products'));
    }

    /**
     * Store a newly created transaction in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $this->validateTransaction($request);

        DB::transaction(function () use ($validatedData) {
            $transaksi = TransaksiPenjualan::create([
                'tanggal_transaksi' => $validatedData['tanggal_transaksi'],
                'total' => 0,
            ]);

            $total = 0;

            foreach ($validatedData['details'] as $detail) {
                $product = Product::findOrFail($detail['product_id']);
                $subtotal = $product->price * $detail['jumlah_pembelian'];
                $total += $subtotal;

                DetailTransaksiPenjualan::create([
                    'transaksi_penjualan_id' => $transaksi->id,
                    'product_id' => $detail['product_id'],
                    'harga' => $product->price,
                    'jumlah_pembelian' => $detail['jumlah_pembelian'],
                ]);
            }
            $transaksi->update(['total' => $total]);
        });

        return redirect()->route('transaksi.index')
                         ->with('success', 'Transaksi penjualan berhasil ditambahkan.');
    }

    /**
     * Display the specified transaction.
     *
     * @param TransaksiPenjualan $transaksi
     * @return View
     */
    public function show(TransaksiPenjualan $transaksi): View
    {
        $transaksi->load('details.product');
        return view('transaksi.show', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified transaction.
     *
     * @param TransaksiPenjualan $transaksi
     * @return View
     */
    public function edit(TransaksiPenjualan $transaksi): View
    {
        $transaksi->load('details');
        $products = Product::all();
        return view('transaksi.edit', compact('transaksi', 'products'));
    }

    /**
     * Update the specified transaction in storage.
     *
     * @param Request $request
     * @param TransaksiPenjualan $transaksi
     * @return RedirectResponse
     */
    public function update(Request $request, TransaksiPenjualan $transaksi): RedirectResponse
    {
        $validatedData = $this->validateTransaction($request);

        DB::transaction(function () use ($validatedData, $transaksi) {
            $transaksi->update([
                'tanggal_transaksi' => $validatedData['tanggal_transaksi'],
            ]);

            // Clear existing details
            $transaksi->details()->delete();

            $total = 0;

            // Add updated details
            foreach ($validatedData['details'] as $detail) {
                $product = Product::findOrFail($detail['product_id']);
                $subtotal = $product->price * $detail['jumlah_pembelian'];
                $total += $subtotal;

                DetailTransaksiPenjualan::create([
                    'transaksi_penjualan_id' => $transaksi->id,
                    'product_id' => $detail['product_id'],
                    'harga' => $product->price,
                    'jumlah_pembelian' => $detail['jumlah_pembelian'],
                ]);
            }
            $transaksi->update(['total' => $total]);
        });

        return redirect()->route('transaksi.index')
                         ->with('success', 'Transaksi penjualan berhasil diperbarui.');
    }

    /**
     * Remove the specified transaction from storage.
     *
     * @param TransaksiPenjualan $transaksi
     * @return RedirectResponse
     */
    public function destroy(TransaksiPenjualan $transaksi): RedirectResponse
    {
        $transaksi->delete();
        return redirect()->route('transaksi.index')
                         ->with('success', 'Transaksi penjualan berhasil dihapus.');
    }

    /**
     * Validate transaction input.
     *
     * @param Request $request
     * @return array
     */
    private function validateTransaction(Request $request): array
    {
        return $request->validate([
            'tanggal_transaksi' => 'required|date',
            'details.*.product_id' => 'required|integer|exists:products,id',
            'details.*.jumlah_pembelian' => 'required|integer|min:1',
        ]);
    }

    // send email
    public function sendEmail($to, $id)
    {
        $transaksi = TransaksiPenjualan::with('details.product')->findOrFail($id);

        Mail::send('transaksi.show', ['transaksi' => $transaksi], function ($message) use ($to, $transaksi) {
            $message->to($to)
                    ->subject("Detail Transaksi: {$transaksi->id} - Total Tagihan Rp " . number_format($transaksi->total, 2, ',', '.'));
        });

        return response()->json(['message' => 'Email sent successfully!']);
    }
}