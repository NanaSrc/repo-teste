<?php

namespace App\Http\Controllers;

use App\Models\To_do;
use Illuminate\Http\Request;

class To_doController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $to_do = To_do::latest()->paginate(5);

        return view('to_do.index', compact('to_do'))

            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'Titulo' => 'required',
        ]);

        To_do::create($request->all());

        return redirect()->route('to_do.index')
            ->with('success', 'Nova tarefa inserida.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\To_do  $to_do
     * @return \Illuminate\Http\Response
     */
    public function show(To_do $to_do)
    {
        return view('to_do.show', compact('to_do'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\To_do  $to_do
     * @return \Illuminate\Http\Response
     */
    public function edit(To_do $to_do)
    {
        return view('to_do.edit', compact('to_do'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\To_do  $to_do
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, To_do $to_do)
    {
        $request->validate([

            'Titulo' => 'required',

        ]);

        $to_do->update($request->all());

        return redirect()->route('to_do.index')->with('success', 'Tarefa atualizada.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\To_do  $to_do
     * @return \Illuminate\Http\Response
     */
    public function destroy(To_do $to_do)
    {
        $to_do->delete();
        
        return redirect()->route('to_do.index')->with('success', 'Tarefa eliminada!');
    }
}
