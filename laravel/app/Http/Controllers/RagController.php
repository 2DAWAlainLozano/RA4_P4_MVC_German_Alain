<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RagService;

class RagController extends Controller
{
    protected $ragService;

    public function __construct(RagService $ragService)
    {
        $this->ragService = $ragService;
    }

    public function index()
    {
        return view('rag.index');
    }

    public function ask(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:1000',
        ]);

        $question = $request->input('question');
        $answer = $this->ragService->generateAnswer($question);

        return response()->json(['answer' => $answer]);
    }
}
