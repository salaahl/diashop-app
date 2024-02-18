<?php

namespace App\Repositories;

interface ProductInterfaceRepository
{
    public function index();

    public function create();

    public function store($request);

    public function show($request);

    public function getQuantity($request);

    public function edit();

    public function update($product_id, $request);

    public function destroy();
}
