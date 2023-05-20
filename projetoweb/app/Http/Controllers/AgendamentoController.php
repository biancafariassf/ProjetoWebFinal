<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Agendamento;
class AgendamentoController extends Controller
{
    function create(Request $request){
        $request->validate([
            'nome'=>'required',
            'telefone'=>'required',
            'origem'=>'required',
            'data_contato'=>'required',
            'observacao'=>'required'
        ]);
        $query = DB::table('agendamentos')->insert([
            'nome'=>$request->input('nome'),
            'telefone'=>$request->input('telefone'),
            'origem'=>$request->input('origem'),
            'data_contato'=>$request->input('data_contato'),
            'observacao'=>$request->input('observacao')
        ]);
        return redirect()->to('/');
        
    }

    public function listar()
    {
        $data = array(
            'listar' =>DB::table('agendamentos')->get()

        );
        return view('consultar', $data);
    }


function excluir($id){
    $query = DB::table('agendamentos')
    ->where('id', $id)
    ->delete();
    if ($query) {
        return back()->with('success', 'Dados deletados com sucesso!');
    } else {
        return back()->with('fail', 'Algo deu errado!');
    }
}

function atualizar(Request $request){
    $request->validate([
        'nome' => 'required',
        'telefone' => 'required',
        'origem' => 'required',
        'data_contato' => 'required',
        'observacao' => 'required',
    ]);
    $query = DB::table('agendamentos')
    ->where('id', $request->input('cid'))
    ->update([
        'nome' => $request->input('nome'),
        'telefone' => $request->input('telefone'),
        'origem' => $request->input('origem'),
        'data_contato' => $request->input('data_contato'),
        'observacao' => $request->input('observacao'),
    ]);
    return redirect()->to('consultar');

    if ($query) {
        return back()->with('success', 'Dados atualizados com sucesso!');
    } else {
        return back()->with('fail', 'Algo deu errado!');
      
    }  
}

function editar($id){
    $row = DB::table('agendamentos')
    ->where('id', $id)
    ->first();
    $data = [
        'info' => $row,
        'Title'=>'Editando'
    ];
    return view('editar', $data);
}

}
