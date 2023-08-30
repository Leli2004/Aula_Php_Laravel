<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\CategoriaAluno;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    /**
     * Carrega a listagem de dados
     */
    public function index()
    {
        $alunos = Aluno::all();

        return view('aluno.list')->with(['alunos'=> $alunos]);
    }

    /**
     * Carrega o formulário
     */
    public function create()
    {
        $categorias = CategoriaAluno::orderBy('nome')->get();

        return view('aluno.form')->with(['categorias'=> $categorias]); //listagem pelas categorias
    }

    /**
     * Salva os dados do formulário
     */
    public function store(Request $request) //request: métodos enviados no formulário (get ou post)
    {

        $request->validate([
            'nome'=>'required|max:100',
            'cpf'=>'required|max:14'
        ],[
            'nome.required'=>"O :attribute é obrigatorio!",
            'nome.max'=>" Só é permitido 120 caracteres no :attribute !",
            'cpf.required'=>"O :attribute é obrigatorio!",
            'cpf.max'=>" Só é permitido 14 caracteres no :attribute !",
        ]);

        $dados = ['nome'=> $request->nome,
            'data_nascimento'=> $request->data_nascimento,
            'cpf'=> $request->cpf,
            'email'=> $request->email,
            'telefone'=>$request->telefone,
            'categoria_aluno_id'=>$request->categoria_aluno_id,
            'imagem'=>$request->imagem,
        ];

        $imagem = $request->file('imagem');

        if($imagem){
            $nome_arquivo = date('YmdHis').'.'.$imagem->getClientOriginalExtension();

            $diretorio = "imagem/aluno";
            $imagem->storeAs($diretorio,$nome_arquivo, 'public'); //salva em uma pasta do sistema

            $dados['imagem'] = $diretorio.$nome_arquivo; //salva apenas o nome no BD, quando for requisitada será resgatada do diretório
        }

        Aluno::create($dados); //ou  $request->all()

        return redirect('aluno')->with('success', "Cadastrado com sucesso!");
    }

    /**
     * Carrega apenas 1 registro da tabela
     */
    public function show(Aluno $aluno)
    {
        //
    }

    /**
     * Carrega o formulário para edição
     */
    public function edit($id)
    {
        $aluno = Aluno::find($id); // select * from aluno where id = $id
        // dois pontos (::) indica que find é um método estático, não necessita instanciar

        $categorias = CategoriaAluno::orderBy('nome')->get();

        return view('aluno.form')->with([
            'aluno'=> $aluno,
            'categorias'=> $categorias]); //listagem pelas categorias
    }

    /**
     * Atualiza os dados do formulário
     */
    public function update(Request $request, Aluno $aluno)
    {
        $request->validate([
            'nome'=>'required|max:100',
            'cpf'=>'required|max:14'
        ],[
            'nome.required'=>"O :attribute é obrigatorio!",
            'nome.max'=>" Só é permitido 120 caracteres no :attribute !",
            'cpf.required'=>"O :attribute é obrigatorio!",
            'cpf.max'=>" Só é permitido 14 caracteres no :attribute !",
        ]);

        $dados = ['nome'=> $request->nome,
            'data_nascimento'=> $request->data_nascimento,
            'cpf'=> $request->cpf,
            'email'=> $request->email,
            'telefone'=>$request->telefone,
            'categoria_aluno_id'=>$request->categoria_aluno_id,
            'imagem'=>$request->imagem,
        ];

        $imagem = $request->file('imagem');
        //verifica se existe imagem no formulário
        if($imagem){
            $nome_arquivo = date('YmdHis').'.'.$imagem->getClientOriginalExtension();

            $diretorio = "imagem/aluno/";
            $imagem->storeAs($diretorio,$nome_arquivo, 'public'); //salva em uma pasta do sistema

            $dados['imagem'] = $diretorio.$nome_arquivo; //salva apenas o nome no BD, quando for requisitada será resgatada do diretório
        }

        Aluno::UpdateOrCreate(
            ['id'=>$request->id],
            $dados);

        return redirect('aluno')->with('success', "Atualizado com sucesso!");
    }

    /**
     * Remove o registro do banco de dados
     */
    public function destroy($id)
    {
        $aluno = Aluno::findOrFail($id);

        $aluno->delete();

        return redirect('aluno')->with('success', "Deletado com sucesso!");
    }

    /**
     * Pesquisa e filtra o registro do banco de dados
     */
    public function search(Request $request)
    {
        if(!empty($request->valor)){
            $alunos = Aluno::where($request->tipo, 'like', "%". $request->valor."%")->get();
        } else {
            $alunos = Aluno::all();
        }

        return view('aluno.list')->with(['alunos'=> $alunos]);
    }
}
