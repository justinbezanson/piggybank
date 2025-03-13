<?php

namespace App\Actions;

use App\Models\Kid;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateKidRequest;

class CreateKid
{
    public function handle(CreateKidRequest $request) : Kid
    {
        $user = Auth::user();

        $kid = Kid::create([
            'name' => $request['name'],
            'amount' => $request['amount'],
            'interval' => $request['interval'],
            'user_id' => $user->id,
        ]);

        return $kid;
    }
}