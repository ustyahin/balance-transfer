<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransferCreateRequest;
use App\Jobs\TransferMoneyJob;
use App\Transaction;
use App\User;
use Carbon\Carbon;

class TransferController extends Controller
{
    public function create(TransferCreateRequest $request)
    {
        $fromUserId = $request->input('from_user_id');
        $toUserId = $request->input('to_user_id');
        $money = $request->input('money');
        $date = $request->input('date');

        $delayDate = Carbon::parse($date);
        if (is_null($delayDate)) {
            return 'false';
        }

        if ($fromUserId == $toUserId) {
            return 'false';
        }
        if ($money <= 0) {
            return 'false';
        }

        $fromUser = User::find($fromUserId);

        if ($fromUser->balance >= $money) {
            $fromUser->decrement('balance', $money);

            $transaction = Transaction::create([
                'from_user_id' => $fromUserId,
                'to_user_id' => $toUserId,
                'money' => $money
            ]);
            $transactionId = $transaction->id;

            // Выполняем задачу перевода денег
            dispatch(new TransferMoneyJob($transactionId))
                ->delay($delayDate);
        } else {
            return 'false';
        }

        return 'true';
    }
}
