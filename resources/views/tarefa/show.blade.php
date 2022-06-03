@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $tarefa->tarefa }}</div>

            <fieldset disabled>
                <div class="card-body">
                   
                        <div class="mb-3">
                          <label class="form-label">data limite conclusão</label>
                          <input value="{{ $tarefa->data_limite_conclusao }}" type="date" class="form-control">
                        </div>
                    </fieldset>
                    <a href="{{ url()->previous()}}" type="submit" class="btn btn-primary">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
