<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Modules\CreateModuleAction;
use App\Data\Modules\CreateModuleData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Course\CreateModuleRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ModulesController extends Controller
{


    public function store(CreateModuleRequest $request)
    {
        $module = CreateModuleAction::run($request);

        return $module;
    }

    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
