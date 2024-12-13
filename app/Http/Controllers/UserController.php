<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Helpers\Data\StringHelper;
use Helpers\Validation\Validation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class UserController extends Controller
{
    public function index()
    {
        $jawaban = auth()->user()->jawabans()->where('progress', 'selesai')->latest()->first();
        if ($jawaban) {
            $testDate = StringHelper::replaceDate(Carbon::parse($jawaban->updated_at)->format('j F Y'));
        }

        return view('testing/halaman', [
            'user' => auth()->user(),
            'isAdmin' => Validation::isAdmin(auth()->user()->email),
            'jawaban' => $jawaban,
            'testDate' => isset($testDate) ? $testDate : null,
        ]);
    }

    public function downloadHasil(User $user)
    {
        if (auth()->user()->id !== $user->id) {
            abort(403, 'Bukan Milik Anda'); // Or redirect to a "Not Permitted" page
        }
        
        $view = request('view', 'download');
        
        $directory = storage_path('pdf');
        $filename = auth()->user()->jawabans()->where('progress', 'selesai')->latest()->first()->pdf_original_name . '.pdf';
        $filePath = $directory . DIRECTORY_SEPARATOR . $filename;
        
        // Check if the file exists.
        if (file_exists($filePath)) {
            if($view == 'download'){
                // Create a BinaryFileResponse for the download.
                return response()->download($filePath, $filename);
            } else {
                // Set the appropriate headers for PDF display.
                header('Content-Type: application/pdf');
                header('Content-Disposition: inline; filename="' . $filename . '"');

                // Output the PDF file content to the browser.
                readfile($filePath);
            }
        } else {
            // File not found.
            return redirect()->back()->withErrors(['filePdf' => 'File laporan tidak ditemukan']);  
        }
    }
}
