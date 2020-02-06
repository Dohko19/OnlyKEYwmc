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
        $question->update($request->all());
        return back()->withInfo('Informacion Actualizada');
    }

    // public function approved(Request $request, Question $question)
    // {
    //     $question->update($request->only('approved'));
    //     // if($request->approved == "1")
    //     // {
    //     //     $seg = Segmento::find($question->segmento_id);
    //     //     $seg->puntuacion = "100";
    //     // }
    //     return back()->withInfo('Aprovado, no se mostrara mas en el panel de inicio');
    // }
}
