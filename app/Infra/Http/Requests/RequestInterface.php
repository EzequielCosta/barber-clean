<?php

namespace App\Infra\Http\Requests;

interface RequestInterface
{
    /**
     * Return headers from Request
     * @return array
     */
    public function getHeaders() : array;

    /**
     * Return data arrived from Request
     * @return array
     */
    public function data() : array;
}