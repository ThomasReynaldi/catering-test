<?php

namespace App\Policies;

use App\Models\User;

class OrderPolicy
{
   public function view(User $user, Order $order)
    {
        return $user->id === $order->merchant_id;
    }

    public function delete(User $user, Order $order)
    {
        return $user->id === $order->merchant_id;
    }

}
