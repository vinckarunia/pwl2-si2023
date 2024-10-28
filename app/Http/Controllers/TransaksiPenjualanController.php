<?php

namespace App\Http\Controllers;

use App\Models\TransaksiPenjualan;
use App\Models\DetailTransaksiPenjualan;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiPenjualanController extends Controller
{
    // Menampilkan daftar transaksi penjualan
    public function index()
    {
        $transaksi = TransaksiPenjualan::with('details.product')->get();
        return view('transaksi.index', compact('transaksi'));
    }

    // Menampilkan form untuk membuat transaksi penjualan baru
    public function create()
    {
        $products = Product::all();
        return view('transaksi.create', compact('products'));
    }

    // Menyimpan transaksi penjualan baru
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_transaksi' => 'required|date',
            'details.*.product_id' => 'required|integer|exists:products,id',
            'details.*.jumlah_pembelian' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {
            $transaksi = TransaksiPenjualan::create([
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'total' => 0,
            ]);

            $total = 0;

            foreach ($request->details as $detail) {
                $product = Product::find($detail['product_id']);
                $subtotal = $product->price * $detail['jumlah_pembelian'];
                $total += $subtotal;
                // dd($product);
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

    // Menampilkan detail transaksi penjualan
    public function show(TransaksiPenjualan $transaksi)
    {
        $transaksi->load('details.product');
        return view('transaksi.show', compact('transaksi'));
    }

    // Menampilkan form untuk mengedit transaksi penjualan
    public function edit(TransaksiPenjualan $transaksi)
    {
        $transaksi->load('details');
        $products = Product::all();
        return view('transaksi.edit', compact('transaksi', 'products'));
    }

    // Memperbarui transaksi penjualan
    public function update(Request $request, TransaksiPenjualan $transaksi)
    {
        $request->validate([
            'tanggal_transaksi' => 'required|date',
            'customer_id' => 'required|integer|exists:customers,id',
            'details.*.product_id' => 'required|integer|exists:products,id',
            'details.*.jumlah_pembelian' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request, $transaksi) {
            $transaksi->update([
                'tanggal_transaksi' => $request->tanggal,
                'customer_id' => $request->customer_id,
            ]);

            // Hapus detail lama
            $transaksi->details()->delete();

            $total = 0;

            // Tambahkan detail baru
            foreach ($request->details as $detail) {
                $product = Product::find($detail['product_id']);
                $subtotal = $product->harga * $detail['jumlah_pembelian'];
                $total += $subtotal;

                DetailTransaksiPenjualan::create([
                    'transaksi_penjualan_id' => $transaksi->id,
                    'product_id' => $detail['product_id'],
                    'jumlah_pembelian' => $detail['jumlah_pembelian'],
                ]);
            }

            $transaksi->update(['total' => $total]);
        });

        return redirect()->route('transaksi.index')
                         ->with('success', 'Transaksi penjualan berhasil diperbarui.');
    }

    // Menghapus transaksi penjualan
    public function destroy(TransaksiPenjualan $transaksi)
    {
        $transaksi->delete();
        return redirect()->route('transaksi.index')
                         ->with('success', 'Transaksi penjualan berhasil dihapus.');
    }
}
