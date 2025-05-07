<?php

namespace App\Services;

use App\Services\OtherService;

class NotificationService
{
    protected $otherService;

    public function __construct(OtherService $otherService)
    {
        $this->otherService = $otherService;
    }

    public function notifyTagihanCreated($nim, $tagihan)
    {
        $message = "Tagihan baru telah dibuat: {$tagihan->jenisTagihan->nama_jenis_tagihan} sebesar Rp " . number_format($tagihan->nominal, 0, ',', '.');
        return $this->otherService->sendNotification($nim, $message);
    }

    public function notifyPembayaranSuccess($nim, $pembayaran)
    {
        $message = "Pembayaran sebesar Rp " . number_format($pembayaran->nominal, 0, ',', '.') . " telah diterima.";
        return $this->otherService->sendNotification($nim, $message);
    }

    public function notifyKeringananStatus($nim, $keringanan)
    {
        $status = $keringanan->status_keringanan;
        $message = "Status keringanan {$keringanan->jenis_keringanan}: {$status}";
        return $this->otherService->sendNotification($nim, $message);
    }
    public function sendNotification($message)
    {
        // Implementasi logika notifikasi di sini
        return "Notifikasi terkirim: " . $message;
    }
}