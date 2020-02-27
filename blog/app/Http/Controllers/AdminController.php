<?php

namespace App\Http\Controllers;

use App\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function criar()
    {
        return view('create');
    }

    public function salvar(Request $request)
    {
        //recebe os valores e verifica cada input, da pra deixar bastante estrito conforme o nivel dos dados a serem tratados
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'age' => 'required|numeric|max:100',
            'phone' => 'required|numeric|digits:11',
            'email' => 'required',
            'address' => 'required',
        ]);

        //ele criou a variavel validator e verificou, caso alguma tiver error, ele volta pra pagina anterior com o erro e os inputs
        if (($validator->fails())) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        /*Agora, caso todos os dados tiverem corretos, iremos salvar-los na sua respectiva tabela
        Aqui criamos um novo model Usuarios*/
        $usuario = new Usuarios;

        $usuario->name = $request->name;
        $usuario->age = $request->age;
        $usuario->phone = $request->phone;
        $usuario->email = $request->email;
        $usuario->address = $request->address;
        $usuario->created_at = date('Y-m-d H:i:s.v');
        $usuario->updated_at = date('Y-m-d H:i:s.v');

        $usuario->save();

        $msg = 'O cadastro de ' . $request->name . ' foi realizado com sucesso!';
        session()->flash('message', $msg);

        return redirect()->route('list');
    }

    public function editar(Request $request)
    {
        $usuario = \DB::table('usuarios')->where('id', $request->id)->get();

        return view('edit', compact('usuario'));
    }

    public function editarSalvar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'age' => 'required|numeric|max:100',
            'phone' => 'required|numeric|digits:11',
            'email' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        \DB::table('usuarios')
            ->where('id', $request->id)
            ->update([
                'name' => $request->name,
                'age' => $request->age,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'updated_at' => date('Y-m-d H:i:s.v'),
            ]);

        $msg = 'O Usuario ' . $request->name . ' foi alterado!';
        session()->flash('message', $msg);

        return redirect()->route('list');
    }

    public function excluir($id)
    {
        $usuario = Usuarios::find($id);

        $usuario->delete();

        return redirect('/')->with('message', 'Contato Excluido!');
    }
}
