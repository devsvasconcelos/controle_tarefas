<?php

namespace App\Exports;

use App\Models\Tarefa;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TarefasExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return Tarefa::all();
                return auth()->user()->tarefas()->get();
    }

    public function headings():array
    {
        return [
            'Id tarefa',
            'Tarefa',
            'Data limite'
        ];
    }
    public function map($linha):array{
        return[
            $linha->id,
            $linha->tarefa,
            date('d/m/Y', strtotime($linha ->data_limite_conclusao))
        ];

    }
}

