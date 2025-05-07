<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OtherService
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.other_service.base_url');
    }

    public function getMahasiswa($nim)
    {
        $response = Http::get("{$this->baseUrl}/mahasiswa/{$nim}");
        
        if ($response->successful()) {
            return $response->json();
        }
        
        return null;
    }

    public function sendNotification($nim, $message)
    {
        $response = Http::post("{$this->baseUrl}/notifikasi", [
            'nim' => $nim,
            'pesan' => $message
        ]);
        
        return $response->successful();
    }
}