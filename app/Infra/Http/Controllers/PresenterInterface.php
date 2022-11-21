<?php

namespace App\Infra\Http\Controllers;

interface PresenterInterface
{

    public function handle(array $data) : string;
}