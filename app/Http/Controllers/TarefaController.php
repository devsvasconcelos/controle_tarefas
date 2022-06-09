<?php

namespace App\Http\Controllers;

use App\Exports\TarefasExport;
use App\Mail\NovaTarefaMail;
use App\Models\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class TarefaController extends Controller
{
    //ao invés de implamentamos na rota o middleware podemos fazê-lo pela o controlador
    public function __construct()
    {
        $this->middleware('auth');
    
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //para verificar se o usuario estar logado, quando as rotas ou controlador não estar protegido, não há necessidade
        // if(Auth::check()){
        //     $id = Auth::user()->id;
        //     $name = Auth::user()->name;
        //     $email = Auth::user()->email;
        //     echo "Voce está logado no sistema $id | $name | $email";
        // }else {
        //     echo "Voce não está logado no sistema";
        // }
        //outra forma 
        // if(auth()->check()){
        //     $id = auth()->user()->id;
        //     $name = auth()->user()->name;
        //     $email = auth()->user()->email;
        //     echo "Voce está logado no sistema $id | $name | $email";
        // }else {
        //     echo "Voce não está logado no sistema";
        // }

        $user_id = auth()->user()->id;
       // $tarefas = Tarefa::where('user_id', $user_id)->get(); // get() retorna um array
       $tarefas = Tarefa::where('user_id', $user_id)->paginate(10);


        return view('tarefa.index',['tarefas' => $tarefas]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('tarefa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // $regras = [

        //     'tarefa' => 'required | min:3| max:40'

        // ];

        // $feedback = [

        // ];

        // $request->validator($regras,$feedback);

        $dados = $request->all('tarefa', 'data_limite_conclusao'); // ao colocar entre os paretes podemos especificar os atribitos a serem recuperadosb
        $dados['user_id'] = auth()->user()->id;

        $tarefa = Tarefa::create($dados);
        
        $destinatario = auth()->user()->email;

        Mail::to($destinatario)->send(new NovaTarefaMail($tarefa));

        return redirect()->route('tarefa.show', ['tarefa' => $tarefa->id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function show(Tarefa $tarefa)
    {
        //



        return view('tarefa.show', ['tarefa' => $tarefa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function edit(Tarefa $tarefa)
    {
        //
        $user_id = Auth::user()->id;

        

        if ($tarefa->user_id == $user_id ) {

            return view('tarefa.edit', ['tarefa' => $tarefa]);
            
        }
        return view('acesso-negado');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarefa $tarefa)
    {
        //


        if ( !$tarefa->user_id == Auth::user()->id ) {
            return view('acesso-negado');
        }
        
        $tarefa->update($request->all());
        return redirect()->route('tarefa.show', ['tarefa' => $tarefa->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarefa $tarefa)
    {
        //
        if ( !$tarefa->user_id == Auth::user()->id ) {
            return view('acesso-negado');
        }

        $tarefa->delete();
        return redirect()->route('tarefa.index', ['tarefa' => $tarefa->id]);

    }

    public function exportacao($extensao){


        if (in_array($extensao, ['xlsx','csv','pdf'])) {
            return Excel::download(new TarefasExport, 'lista_tarefas.'.$extensao);            
        }

        return redirect()->route('tarefa.index');
    }
    
}
