<?php

namespace App\Http\Transformers;

use App\Models\Rtm;
use League\Fractal\TransformerAbstract;

class RtmTransformer extends TransformerAbstract
{
    public function transform(Rtm $rtm)
    {
        return $rtm->toArray();
    }
}
