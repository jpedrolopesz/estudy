<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $comments = Comment::with('user', 'replies', 'replies.user')
            ->filter(\Illuminate\Support\Facades\Request::only('search', 'role', 'trashed'))
            ->get();

        return Inertia::render('Admin/Comments/Index',[
            'filters' => \Illuminate\Support\Facades\Request::all('search', 'role', 'trashed'),
            'comments' => $comments
        ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        // Valide os dados do formulário, se necessário
        $validatedData = $request->validate([
            'title' => 'nullable|string',
            'comment' => 'required|string',
            'lesson_id' => 'required|exists:lessons,id',
            'user_id' => 'required|exists:users,id',
        ]);

        // Crie o novo comentário
        $comment = Comment::create([
            'lesson_id' => $validatedData['lesson_id'],
            'user_id' => $validatedData['user_id'],
            'title' => $validatedData['title'],
            'comment' => $validatedData['comment'],
        ]);

        // Retorne uma resposta ou redirecione, conforme necessário
        return redirect()->back()->with('success', 'Commented ok');

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


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id): Response
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id): Response
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
