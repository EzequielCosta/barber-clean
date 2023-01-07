<?php

namespace App\Infra\Http\Responses;

interface ResponseInterface
{
    public function setStatusCode(int $statusCode) : void;
    public function setHeaders(array $options): void;
    public function json(array $value): void;
}