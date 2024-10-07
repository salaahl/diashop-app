<?php

namespace App\Repositories;

interface StripePaymentInterfaceRepository
{
    public function checkout();

    public function confirmation($stripe_session_id, $session);

    public function webhooks();
}
