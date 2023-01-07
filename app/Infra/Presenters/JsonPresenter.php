<?php

namespace App\Infra\Presenters;

use App\Infra\Http\Controllers\PresenterInterface;

class JsonPresenter implements PresenterInterface
{
    /**
     * @param array $data
     * @return string
     */
    public function handle(array $data): string
    {
        return json_encode($data);
    }

}