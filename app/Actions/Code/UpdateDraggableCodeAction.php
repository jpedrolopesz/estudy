<?php

namespace App\Actions\Code;

use App\Models\Code;

class UpdateDraggableCodeAction
{
    public static function run(array $payload)
    {
        foreach ($payload as $code) {
            Code::findOrFail($code['id'])
                ->update([
                    'sort_order' => $code['sort_order'],
                ]);
        }
    }
}
