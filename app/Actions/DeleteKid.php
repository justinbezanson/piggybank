<?php

namespace App\Actions;

use App\Models\Kid;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Auth;

class DeleteKid
{
    public function handle(Kid $kid) : void
    {
        $kid->delete();
    }
}