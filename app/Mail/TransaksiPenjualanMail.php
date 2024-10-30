<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\TransaksiPenjualan;

class TransaksiPenjualanMail extends Mailable
{
    use Queueable, SerializesModels;

    public $transaksi;

    public function __construct(TransaksiPenjualan $transaksi)
    {
        $this->transaksi = $transaksi;
    }

    public function build()
    {
        return $this->subject('Detail Transaksi')
                    ->view('transaksi.show') // The path to your show view
                    ->with(['transaksi' => $this->transaksi]);
    }
}
