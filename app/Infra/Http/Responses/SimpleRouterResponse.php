<?php
declare(strict_types=1);
namespace App\Infra\Http\Responses;

use Pecee\Http\Response;

class SimpleRouterResponse implements ResponseInterface
{
    public function __construct(private Response $response)
    {
    }

    public function setStatusCode(int $statusCode): void
    {
        $this->response->httpCode($statusCode);
    }

    public function setHeaders(array $options): void
    {
        $this->response->headers($options);
    }

    public function json(array $value): void
    {
        $this->response->json($value);
    }
}