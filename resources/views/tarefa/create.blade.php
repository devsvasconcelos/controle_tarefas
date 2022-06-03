@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Adicionar tarefa</div>

                <div class="card-body">
                    <form method="post" action="{{ route('tarefa.store') }}">
                      @csrf
                        <div class="mb-3">
                          <label  class="form-label">Tarefa</label>
                          <input name="tarefa" type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                          <label class="form-label">data limite conclusão</label>
                          <input name="data_limite_conclusao" type="date" class="form-control">
                        </div>
                       
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
