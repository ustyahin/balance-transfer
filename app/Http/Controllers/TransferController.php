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
            return 'Дата не распознана. Пожалуйста, введите верную дату';
        }

        if ($fromUserId == $toUserId) {
            return 'Вы не можете отправить перевод самому себе';
        }
        if ($money <= 0) {
            return 'Вы не можете отправить сумму меньшую нуля';
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
            return 'У данного пользователя недостаточно средств для перевода';
        }

        return 'Отложенный платеж успешно создан';
    }
}
