Site da aplicação 


@auth
<h1> Usuário uutenticado</h1>
<p>{{Auth::user()->id}}</p>
<p>{{Auth::user()->name}}</p>
<p>{{Auth::user()->email}}</p>
@endauth

{{-- guest quando conteudo apresentado é para usuario não autenticado  --}}

@guest 
olá visitante , tudo bem ?
<br>...
<br>...
@endguest
