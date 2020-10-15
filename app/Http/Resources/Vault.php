<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Vault extends JsonResource
{
    public static $wrap = 'vault';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'owner' => $this->owner,
            'username' => $this->username,
            'totalValue' => $this->totalValue,
            'cashValue' => $this->cashValue,
            'digitalValue' => $this->digitalValue,
            'currentCurrency' => $this->currentCurrency,
            'currencyCode' => $this->currencyCode,
        ];
    }
}
