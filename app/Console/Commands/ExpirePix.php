<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pix;
use Carbon\Carbon;

class ExpirePix extends Command
{
    /**
     * O nome e a assinatura do comando.
     *
     * @var string
     */
    protected $signature = 'pix:expire';

    /**
     * A descrição do comando no Artisan.
     *
     * @var string
     */
    protected $description = 'Marca automaticamente como expirados todos os PIX gerados que passaram do tempo de expiração';

    /**
     * Executa o comando no terminal.
     */
    public function handle(): void
    {
        $now = Carbon::now();

        $expiredCount = Pix::where('status', 'generated')
            ->where('expires_at', '<', $now)
            ->update(['status' => 'expired']);

        $this->info("{$expiredCount} PIX expirados automaticamente.");
    }
}
