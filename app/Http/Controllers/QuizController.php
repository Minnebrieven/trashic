<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arrayQuiz = Quiz::all();
        return view('private.quiz.index', compact('arrayQuiz'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('private.quiz.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['judul' => 'required']);
        Quiz::create($request->all());
        return redirect()->route('quiz.index')->with('success', 'Quiz berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $quiz = Quiz::with('pertanyaan')->findOrFail($id);
        return view('quiz.show', compact('quiz'));
    } 

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Quiz::findOrFail($id)->delete();
        return redirect()->route('quiz.index')->with('success', 'Quiz berhasil dihapus!');
    }
}
