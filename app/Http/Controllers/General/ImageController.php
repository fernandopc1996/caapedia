<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ImageController extends Controller{
    
    public function getImage($path){
        if (Str::contains($path, '..')) {
            abort(404, 'Imagem não encontrada');
            //abort(403, 'Acesso proibido');
        }

        $fullPath = storage_path('app/'  . $path);
    
        if (!file_exists($fullPath)) {
            abort(404, 'Imagem não encontrada');
        }
        
        $mimeType = mime_content_type($fullPath);
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/bmp', 'image/tiff'];
        if (!in_array($mimeType, $allowedMimeTypes)) {
            abort(404, 'Imagem não encontrada');
            //abort(403, 'Tipo de arquivo não permitido');
        }
        $file = file_get_contents($fullPath);
    
        return response()->make($file, 200, [
            'Content-Type' => $mimeType,
            'Cache-Control' => 'public, max-age=31536000', // Cache por 1 ano
            'Expires' => now()->addYear()->toRfc1123String(),
        ]);
    }
}
