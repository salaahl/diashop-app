<?php

namespace App\Repositories;

interface StripePaymentInterfaceRepository
{
    public function checkout();

    public function status($number, $status);

    public function webhooks();
}
