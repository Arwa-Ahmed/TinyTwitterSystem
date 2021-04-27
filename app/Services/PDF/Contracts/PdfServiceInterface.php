<?php

namespace App\Services\PDF\Contracts;

interface PdfServiceInterface
{
    /**
     * Display a listing of the resource.
     *
     * @param string view_name
     * @param array $data
     * @return PDF
     */
    public function generatePdf(string $view_name ,array $data);
}
