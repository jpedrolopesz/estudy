<?php

namespace App\Actions\Comment;

use App\Data\Comment\CommentFilterData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Pipeline;
use Illuminate\Support\Facades\Request;
use App\Models\Comment;




class GetAllCommentsAction
{

    public static function run(array $filters = [])
    {

        $isAdmin = Auth::check() && Auth::user()->owner == '1';

        $data = CommentFilterData::from([
            'builder' => Comment::query(),
            'filters' => $filters,
        ]);

        return Pipeline::send($data)
            ->then(fn($data) => $data->builder)
            ->when(!$isAdmin, function ($query) {
                $query->where(function ($subquery) {
                    $subquery->where('user_id', Auth::id())
                        ->whereDoesntHave('user', function ($userQuery) {
                            $userQuery->where('owner', '1');
                        });
                });
            })

            ->filter(Request::only('search', 'reply'))
            ->with(['lesson', 'user', 'replies.user']) // Modificação aqui

            ->orderBy('created_at', 'desc')
            ->get();
    }

}
