<?php

namespace App\Actions\User;


use App\Models\Course;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ShowSubscribedCourseAction
{
    public function execute(int $id): array|Builder|Collection|Model
    {
        $user = Auth::user();

        // Verifique se o usuário está autenticado e se comprou o curso
        if ($user  &&  $user->subscribed('default')) {

            //dd($user->subscribed('default'));
            // O usuário tem acesso ao curso, retorne os dados

            return Course::with(['modules' => function ($query) {
                $query->orderBy('sort_order')->with(['lessons' => function ($query) {
                    $query->orderBy('sort_order');
                }]);
            }])->findOrFail($id);
        }

        // Caso o usuário não tenha acesso, você pode retornar um erro, redirecionar para uma página de erro ou tomar outra ação adequada ao seu aplicativo.

        // Por exemplo, retornar uma resposta vazia ou lançar uma exceção
        return [];
    }

}


