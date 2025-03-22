<?php

namespace App\Actions;

use App\Models\Kid;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateKidRequest;

class UpdateKid
{
    public function handle(array $data, Kid $kid) : Kid
    {
        $user = Auth::user();

        $kid->update([
            'name' => $data['name'],
            'amount' => $data['amount'],
            'interval' => $data['interval'],
            'user_id' => $user->id,
        ]);

        return $kid;
    }
}