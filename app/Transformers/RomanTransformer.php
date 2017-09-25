<?php

namespace RomanAPI\Transformers;

use RomanAPI\RomanConversion;
use League\Fractal\TransformerAbstract;

class RomanTransformer extends TransformerAbstract
{
    public function transform(RomanConversion $roman)
    {
        return [
            'integer' => $roman->integer,
            'roman' => $roman->roman
        ];
    }
}