<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Modules\CreateModuleAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Course\CreateModuleRequest;
use Illuminate\Http\Request;

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
