<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Question;
use App\Segmento;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        return $request;
        $question->update($request->all());
        return back()->withInfo('Informacion Actualizada');
    }

    public function approved(Request $request, Question $question)
    {
        // return $request;
        $question->update($request->only('approved'));

        return redirect()->route('admin.segmentos.index')->withInfo('Aprovado');
    }
}
