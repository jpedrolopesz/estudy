<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Comment\GetAllCommentsAction;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        $comments = GetAllCommentsAction::run(['perPage' => 10000]);


        return Inertia::render('Admin/Comments/Index',[
            'comments' => $comments
        ] );
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     */
    public function storeComment(Request $request): \Illuminate\Http\RedirectResponse
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

        return redirect()->back()->with('success', 'Commented Success');

    }

    public function storeReply(Request $request, $comment)
    {
        $validatedData = $request->validate([
            'reply' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'comment_id' => 'required|exists:comments,id',
        ]);

        $reply = new Reply();
        $reply->comment_id = $validatedData['comment_id'];
        $reply->user_id = $validatedData['user_id'];
        $reply->reply = $validatedData['reply'];
        $reply->save();

        return redirect()->back()->with('success', 'Commented Success');
    }


}
