@extends('base.app')
@section('titulo', 'Formulário de Alunos')
@section('content')

    @if($errors->any())
        <ul>
            @foreach ($errors->all() as $error )
                <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif
    @php
        //dd($aluno); igual ao var_dump;

        if(!empty($aluno->id)){
            $route = route('aluno.update', $aluno->id);
        } else{
            $route = route('aluno.store');
        }
    @endphp

<div class="mx-auto py-12 devide-y md:max-w-4xl">
<div class="py-12">
    <h3 class="pt-4 text2xl font-medium">Formulário de Alunos</h3>
    <form action="{{ $route }}" method="post" enctype="multipart/form-data"
    class="bg-white shadow-md rounded px-8 pt-6 pb-6 mb-4">
        @csrf <!-- cria um hash de segurança -->

        @if (!empty($aluno->id))
            @method('PUT')
        @endif

        <input type="hidden" name="id" value="@if (!empty($aluno->id)){{$aluno->id}}@elseif(!empty(old('id'))){{old('id')}}@else{{''}}@endif"><br><br>

        <label class="block">
            <span class="text-gray-700">Nome</span>
            <input type="text" name="nome"
            class="mt-0 block w-full px-0.5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-black"
            value="@if(!empty($aluno->nome)){{$aluno->nome}}@elseif(!empty(old('nome'))){{old('nome')}}@else{{''}}@endif">
        </label>
        <br><br>

        <div class="mb-4 md:flex md:justify-between">
            <div class="md-4 md:mr-2 md:mb-0">
                <label class="block">
                    <span>Data Nascimento</span>
                    <input type="date" name="data_nascimento"
                    class="mt-0 block w-full px-0.5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-black"
                    value="@if(!empty($aluno->data_nascimento)){{$aluno->data_nascimento}}@elseif(!empty(old('data_nascimento'))){{old('data_nascimento')}}@else{{''}}@endif">
                </label>
            </div>
            <div class="md-4 md:mr-2 md:mb-0">
                <label class="block">
                    <span>CPF</span>
                    <input type="text" name="cpf"
                    class="mt-0 block w-full px-0.5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-black"
                    value="@if(!empty($aluno->cpf)){{$aluno->cpf}}@elseif(!empty(old('cpf'))){{old('cpf')}}@else{{''}}@endif">
                </label>
            </div>
        </div>
        <br><br>

        <label class="block">
            <span>Email</span>
            <input type="email" name="email"
            class="mt-0 block w-full px-0.5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-black"
            value="@if(!empty($aluno->email)){{$aluno->email}}@elseif(!empty(old('email'))){{old('email')}}@else{{''}}@endif">
        </label><br><br>

        <label class="block">
            <span>Telefone</span>
            <input type="text" name="telefone"
            class="mt-0 block w-full px-0.5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-black"
            value="@if(!empty($aluno->telefone)){{$aluno->telefone}}@elseif(!empty(old('telefone'))){{old('telefone')}}@else{{''}}@endif">
        </label><br><br>

        <label class="block">
            <span>Categoria</span>
            <select name="categoria_aluno_id" id="" class="mt-0 block w-full px-0.5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-black">
                @foreach ($categorias as $item)
                    <option value="{{$item->id}}">{{$item->nome}}</option>
                @endforeach
            </select>
        </label><br><br>

        @php
            $nome_imagem = !empty($aluno->imagem) ?
            $aluno->imagem : 'sem_imagem.jpeg'
        @endphp
        <div>
            <img src="/storage/{{$nome_imagem}}" width="200px" alt="imagem"><br>
            <input type="file" name="imagem" class="block w-full text-sm text-slate-500
                file:mr-4 file:py-2 file:px-4
                file:rounded-full file:border-0
                file:text-sm file:font-semibold
                file:bg-violet-50 file:text-violet-700
                hover:file:bg-violet-100
            "/>
        </div> <br>

        <button type="submit" class="rounded-full bg-green-500 px-4 py-2 font-bold hover:bg-green-300">Salvar</button>
        <a href="{{ route('aluno.index') }}"><button class="rounded-full bg-gray-400 px-4 py-2 font-bold hover:bg-gray-300">Voltar</button></a>
    </form>
</div>
</div>

    @endsection

