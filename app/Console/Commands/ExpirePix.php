<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pix;
use Carbon\Carbon;

class ExpirePix extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pix:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Marca todos os PIX vencidos como expired';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        $count = Pix::where('status', 'generated')
            ->where('expires_at', '<', $now)
            ->update(['status' => 'expired']);

        $this->info("$count PIX expirados automaticamente.");
    }
}
