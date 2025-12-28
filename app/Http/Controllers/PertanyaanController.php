<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pertanyaan;
use App\Models\Quiz;
use Illuminate\Http\Request;

class PertanyaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($quiz_id)
    {
        $quiz = Quiz::findOrFail($quiz_id);
        return view('pertanyaan.create', compact('quiz'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required',
            'opsi_a' => 'required',
            'opsi_b' => 'required',
            'opsi_c' => 'required',
            'opsi_d' => 'required',
            'jawaban_benar' => 'required|in:A,B,C,D'
        ]);

        Pertanyaan::create(array_merge($request->all(), ['quiz_id' => $quiz_id]));
        return redirect()->route('quiz.show', $quiz_id)->with('success', 'Pertanyaan ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }
}
