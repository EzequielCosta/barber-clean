<?php

namespace App\Infra\Http\Requests;

use Pecee\Http\Request;

class SimpleRouterRequest implements RequestInterface
{


    public function __construct(private Request $request){}

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->request->getHeaders();
    }

    /**
     * @return array
     */
    public function data(): array
    {
        return $this->request->getInputHandler()->all();
    }
}