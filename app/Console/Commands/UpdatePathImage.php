<?php

namespace App\Console\Commands;

use App\Models\Penduduk;
use Illuminate\Console\Command;

class UpdatePathImage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:path_image';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update path_image for existing records';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Updating path_image for existing records...');

        Penduduk::all()->each(function ($record) {
            // Periksa jenis_kelamin dan atur path_image sesuai
            if ($record->jenis_kelamin === 'laki-laki') {
                $record->path_image = 'img/man.png';
            } else {
                $record->path_image = 'img/woman.png';
            }

            $record->save();
        });

        $this->info('Updated path_image for existing records.');
    }
}
