<?php

namespace App\Actions\Module;

use App\Models\Module;

class UpdateDraggableModuleAction
{
    public static function run(array $payload)
    {
        foreach ($payload as $module) {
            Module::findOrFail($module['id'])
                ->update([
                    'sort_order' => $module['sort_order'],
                ]);
        }
    }
}
