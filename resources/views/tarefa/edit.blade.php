@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Atualizar tarefa</div>

                <div class="card-body">
                    <form method="post" action="{{ route('tarefa.update', ['tarefa' => $tarefa->id]) }}">
                      @csrf
                      @method('PUT')
                        <div class="mb-3">
                          <label  class="form-label">Tarefa</label>
                          <input name="tarefa" type="text" class="form-control" value="{{ $tarefa->tarefa }}">
                        </div>
                        <div class="mb-3">
                          <label class="form-label">data limite conclusão</label>
                          <input name="data_limite_conclusao" type="date" class="form-control" value="{{ $tarefa->data_limite_conclusao}}">
                        </div>
                       
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
