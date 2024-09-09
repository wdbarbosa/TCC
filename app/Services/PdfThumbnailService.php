<?php

namespace App\Services;

use Spatie\PdfToImage\Pdf;

class PdfThumbnailService
{
    public function generateThumbnail(string $pdfPath, string $outputPath)
{
    // Caminho correto para armazenar miniaturas no diretório público
    $outputPath = public_path('storage/thumbnails/' . basename($outputPath));

    $pdf = new Pdf($pdfPath);

    // Salva a miniatura da primeira página como uma imagem
    $pdf->setPage(1)->saveImage($outputPath);
}
}