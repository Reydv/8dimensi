<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class DeleteOldPDF extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-old-p-d-f';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete old pdf files (30 days+)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $directory = storage_path('pdf'); 

        if (File::isDirectory($directory)) {
            $files = File::files($directory);

            foreach ($files as $file) {
                $file_path = $file->getRealPath();
                $file_timestamp = filemtime($file_path);
                $file_date = Carbon::createFromTimestamp($file_timestamp);

                // Calculate the date 30 days ago
                $thirty_days_ago = Carbon::now()->subDays(30);

                if ($file_date->lessThan($thirty_days_ago)) {
                    unlink($file_path);
                } 
            }
        }
    }
}
