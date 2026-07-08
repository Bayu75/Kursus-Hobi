<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificateController extends Controller
{
    public function show(Certificate $certificate)
    {
        $certificate->load([
            'enrollment.user',
            'enrollment.course',
            'enrollment.course.instructor'
        ]);

        // Pastikan hanya pemilik sertifikat yang bisa melihat
        if ($certificate->enrollment->user_id != auth()->id()) {
            abort(403);
        }

        return view('certificates.show', compact('certificate'));
    }

    public function download(Certificate $certificate)
    {
        $certificate->load([
            'enrollment.user',
            'enrollment.course',
        ]);

        $pdf = Pdf::loadView(
            'certificates.pdf',
            compact('certificate')
        );

        return $pdf->download(
            'sertifikat-'.$certificate->certificate_number.'.pdf'
        );
    }
}