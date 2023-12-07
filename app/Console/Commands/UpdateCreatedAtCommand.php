<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\KartuKeluarga;

class UpdateCreatedAtCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:created_at';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update created_at for existing records';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Updating created_at for existing records...');

        KartuKeluarga::all()->each(function ($record) {
            $record->created_at = now();
            $record->save();
        });

        $this->info('Updated created_at for existing records.');
    }
}
