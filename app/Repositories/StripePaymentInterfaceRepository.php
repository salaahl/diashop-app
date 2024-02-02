<?php

namespace App\Repositories;

interface StripePaymentInterfaceRepository
{
    public function checkout();

    public function status();

    public function webhooks();
}
