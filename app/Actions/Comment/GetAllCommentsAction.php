<?php

namespace App\Actions\Comment;

use App\Data\Comment\CommentFilterData;
use Illuminate\Support\Facades\Pipeline;
use Illuminate\Support\Facades\Request;
use App\Models\Comment;




class GetAllCommentsAction
{

    public static function run(array $filters = [])
    {
        $data = CommentFilterData::from([
            'builder' => Comment::query(),
            'filters' => $filters,
        ]);

        return Pipeline::send($data)
            ->then(fn($data) => $data->builder)
            ->filter(Request::only('search'))
            ->with(['lesson', 'user', 'replies' => function ($query) {
                $query->with('user');
            }])
            ->orderBy('created_at', 'desc')
            ->get();
    }

}
