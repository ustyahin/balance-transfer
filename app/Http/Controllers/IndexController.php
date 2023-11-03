<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        $users = DB::table('users AS u')->select([
                'u.id AS id',
                'u.name AS name',
                'u.balance AS balance',
                'transactions.created_at AS transactions_created_at'
            ])
            ->leftJoin('transactions', function($q) {
                    $q->on('transactions.from_user_id', '=', 'u.id')
                    ->whereRaw('transactions.success = 1 AND transactions.id = (SELECT MAX(id) FROM transactions WHERE from_user_id = u.id)');
            })

            ->get();


        return view('index', ['users' => $users]);
    }
}
