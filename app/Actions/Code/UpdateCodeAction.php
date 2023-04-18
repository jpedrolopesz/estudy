<?php

namespace App\Actions\Code;

use App\Data\Code\UpdateCodeData;
use App\Models\Code;

class UpdateCodeAction
{
    public static function run(UpdateCodeData $data, Code $code)
    {
        $code->update([
            'type' => $data->type,
            'display' => $data->name,
            'color' => $data->color,
            'description' => $data->description,
            'is_active' => $data->is_active,
            'available_in_subtask' => $data->available_in_subtask,
        ]);
    }
}
