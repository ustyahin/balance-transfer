<?php

namespace App\Jobs;

use App\User;
use App\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;

class TransferMoneyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $transactionId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $transactionId)
    {
        $this->transactionId = $transactionId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            DB::beginTransaction();
            // Получаем сумму перевода и отдаем деньги пользователю и
            // также делаем транзакцию успешной
            $transaction = Transaction::find($this->transactionId);
            User::where('id', $transaction->to_user_id)
                ->increment('balance', $transaction->money);
            $transaction->success = 1;
            $transaction->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }
}
