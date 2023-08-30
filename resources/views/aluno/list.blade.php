@extends('base.app')

@section('titulo', 'Listagem de Alunos') <!-- <h3>Listagem de Alunos</h3> -->

@section('content')

    <form action="{{ route('aluno.search') }}" method="post">
        @csrf
        <select name="tipo">
            <option value="nome">Nome</option>
            <option value="data_nascimento">Data de Nascimento</option>
            <option value="email">E-mail</option>
            <option value="cpf">CPF</option>
            <option value="telefone">Telefone</option>
            <!--<option value="categoria">Categoria</option>-->
        </select>
        <input type="text" name="valor">
        <button type="submit" class="rounded-full bg-gray-300 px-4 py-2 font-bold hover:bg-gray-200">Buscar</button>
        <a href="{{ route('aluno.create') }}"><button type="submit" class="rounded-full bg-green-400 px-4 py-2 font-bold hover:bg-green-300">Cadastrar</button></a><br>
    </form>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Imagem</th>
            <th>Nome</th>
            <th>Data Nascimento</th>
            <th>Email</th>
            <th>CPF</th>
            <th>Telefone</th>
            <th>Categoria</th>
            <th>Ações</th>
        </tr>
        @foreach ($alunos as $item)
        @php
            $nome_imagem = !empty($item->imagem) ?
            $item->imagem : 'sem_imagem.jpeg'
        @endphp
            <tr>
                <td>{{$item->id}}</td>
                <td> <img src="/storage/{{$nome_imagem}}" width="60px" alt="imagem"> </td>
                <td>{{$item->nome}}</td>
                <td>{{$item->data_nascimento}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->cpf}}</td>
                <td>{{$item->telefone}}</td>
                <td>{{$item->categoria->nome ?? ""}}</td> <!-- função categoria de model > aluno -->
                <td><a href="{{route('aluno.edit', $item->id)}}">Editar</a></td>
                <td><a href="{{route('aluno.destroy', $item->id)}}"
                    onclick="return confirm('Deseja excluir o registro?')">Deletar</a></td>
            </tr>
        @endforeach
    </table>

@endsection
