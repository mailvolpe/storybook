@extends('Blocks.layouts')

@section('content')

<div class="row justify-content-center mt-3">
    <div class="col">

        @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">Blocos</div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Texto</th>
                        <th scope="col">Imagem</th>
                        <th scope="col">Opções</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ($blocks as $block)
                        <tr>
                            <th scope="row">{{ $block->id }}</th>
                            
                            <td>{{ @$block->text }}</td>

                            <td><img src="{{ @$block->image }}" width="100px"></td>

                            <td class="text-start">
                                @foreach($block->options as $option)
                                    <div class="">
                                        <a class="small" href="{{ route('blocks.edit', $option->value) }}">
                                            {{ $option->text }} <i class="bi bi-arrow-right-circle"></i> {{ $option->value }}
                                        </a>
                                    </div>
                                @endforeach
                            </td>

                            <td nowrap>
                                <form action="{{ route('blocks.destroy', $block->id) }}" method="post" class="d-grid gap-1">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ route('blocks.show', $block->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Ver</a>

                                    <a href="{{ route('blocks.edit', $block->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Editar</a>   

                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Deletar este bloco?');"><i class="bi bi-trash"></i> Deletar</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                            <td colspan="6">
                                <span class="text-danger">
                                    <strong>Nenhum bloco encontrado</strong>
                                </span>
                            </td>
                        @endforelse
                    </tbody>
                  </table>
                  <a href="{{ route('blocks.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Novo Bloco</a>
            </div>
        </div>
    </div>    
</div>
    
@endsection