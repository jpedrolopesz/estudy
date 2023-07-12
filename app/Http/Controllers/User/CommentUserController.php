<?php

namespace App\Http\Controllers\User;

use App\Actions\Comment\GetAllCommentsAction;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Http\Request;
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

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validatedData = $request->validate([
            'title' => 'nullable|string',
            'comment' => 'required|string',
            'lesson_id' => 'required|exists:lessons,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $comment = Comment::create([
            'lesson_id' => $validatedData['lesson_id'],
            'user_id' => $validatedData['user_id'],
            'title' => $validatedData['title'],
            'comment' => $validatedData['comment'],
        ]);

        return redirect()->back()->with('success', 'Commented');

    }

    public function storeReply(Request $request, $comment)
    {

        $validatedData = $request->validate([
            'reply' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'comment_id' => 'required|exists:users,id',
        ]);


        $reply = new Reply();
        $reply->comment_id = $validatedData['comment_id'];
        $reply->user_id = $validatedData['user_id'];
        $reply->reply = $validatedData['reply'];
        $reply->save();

        return redirect()->back()->with('success', 'Commented Success');
    }



}
