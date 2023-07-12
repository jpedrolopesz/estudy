<?php

namespace App\Http\Controllers\User;

use App\Actions\Comment\GetAllCommentsAction;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class CommentUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {

        $comments = GetAllCommentsAction::run(['perPage' => 10000]);

        return Inertia::render('User/Support/Index',[
            'comments' => $comments
        ] );
    }

}
