@extends('blocks.layouts')

@section('content')

<div class="row justify-content-center mt-3">
    <div class="col">

        @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Editar Bloco
                </div>
                <div class="float-end">
                    <a href="{{ route('blocks.index') }}" class="btn btn-primary btn-sm">&larr; Voltar</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('blocks.update', $block->id) }}" method="post">
                    @csrf
                    @method("PUT")
                    
                    <div class="mb-3 row">
                        <label for="body" class="col-12 col-form-label text-start">Texto</label>
                        <div class="col-12">
                            <textarea class="form-control" id="text" onchange="updateBlockJson();"></textarea>
                        </div>
                    </div>
                    
                    <div class="fieldOptions">
                        <div class="font-weight-bold my-1 text-start">Opções</div>    
                        <div class="fieldOptionsList">
                            <div class="row no-gutters mb-2 originalFieldOption d-none field_options">
                                <div class="col-6">
                                    <input type="text" class="form-control field_option_text" onchange="updateBlockJson();">
                                </div>                     
                                <div class="col-5">
                                    <select class="form-select field_option_select" onchange="updateBlockJson();">
                                        @foreach ($block_options as $option_block)
                                            <option value="{{ $option_block->id }}">{{ $option_block->id }} - {{ $option_block->text }}</option>
                                        @endforeach
                                    </select>
                                </div>               
                                <div class="col-1 pt-2">
                                    <a class=" removeOptionButton" href="javascript:void(0);" onclick="removeOption(this);">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="text-start"><a href="javascript:void(0);" class="addOptionbutton" onclick="addOption(this);">
                            <i class="fa fa-plus"></i> Adicionar opção</a>
                        </div>
                    </div>

                    <div class="mt-2 row">
                        <label for="body" class="col-12 col-form-label text-start">Imagem</label>
                        <div class="col-12">
                            <input class="form-control" id="image" onchange="updateBlockJson();"></textarea>
                        </div>
                    </div>

                    <textarea class="d-none" id="body" name="body">{{ $block->body }}</textarea>
                    
                    <div class="my-3 row">
                        <div class="col d-grid">
                        <input type="submit" class="btn-block btn  btn-primary" value="Salvar">
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>    
</div>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        startForm();
    });

    function startForm(){
            
        block = <?=$block->body?>;

        $(block.options).each( function(optionIndex, option){
            newFormOptionClass = addOption();
            $('.'+newFormOptionClass+' .field_option_text').val(option.text); 
            $('.'+newFormOptionClass+' .field_option_select').val(option.value); 
        });

        document.getElementById('text').value = block.text;
        document.getElementById('image').value = block.image;

    }
</script>


@endsection