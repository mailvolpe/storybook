<?php

namespace App\Http\Controllers;

use App\Models\Block;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreBlockRequest;
use App\Http\Requests\UpdateBlockRequest;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $blocks = $this->getAllBlocks();

        return view('blocks.index', [
            'blocks' => $blocks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('blocks.create', [
            'block_options' => $this->makeOptionsArray(Block::all())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlockRequest $request) : RedirectResponse
    {
        Block::create($request->all());
        return redirect()->route('blocks.index')
                ->withSuccess('Bloco criado.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Block $block) : View
    {
        $decoded_body = json_decode($block->body);
        $block = (object) array_merge((array) $block->getAttributes(), (array) $decoded_body);

        return view('blocks.show', [
            'block' => $block,
            'all_blocks' => $this->getAllBlocks(true)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Block $block) : View
    {
        return view('blocks.edit', [
            'block' => $block,
            'block_options' => $this->makeOptionsArray(Block::all()->where('id', '!=', $block->id))
        ]);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlockRequest $request, Block $block) : RedirectResponse
    {
        $block->update($request->all());
        return redirect()->route('blocks.index')
                ->withSuccess('Bloco atualizado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Block $block) : RedirectResponse
    {
        $block->delete();
        return redirect()->route('blocks.index')
                ->withSuccess('Bloco removido.');
    }

    public function makeOptionsArray($blocks){
        $block_options = [];
        //Monta as opções
        foreach($blocks as $option_block){
            $block_body = json_decode($option_block->body);
            $text = isset($block_body->text) ? $block_body->text : $option_block->body; //SERA REMOVIDO
            $block_options[] =(object)  ["id" => $option_block->id, "text" => $text];
        }
        return $block_options;
    }

    public function getAllBlocks($json = false){
        $blocks=[];
        foreach(Block::all() as $block){
            $decoded_body = json_decode($block->body);
            $block = (object) array_merge((array) $block->getAttributes(), (array) $decoded_body);
            $blocks[$block->id]=$block;
        }
        return $json ? json_encode($blocks) : $blocks;
    }
}