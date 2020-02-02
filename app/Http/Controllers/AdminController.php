<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use Auth;
use Carbon\Carbon;

use App\Caixa;
use App\User;
use App\ControleCaixa;
use App\FluxoCaixa;

class AdminController extends Controller
{

  public function cadastro_caixa()
  {
    return view('cadastro-caixa');
  }

  public function cadastro_salvar(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'cod' => 'required|max:255',
      'description' => 'required|max:255',
    ]);

    if (($validator->fails())) {
      return redirect('/cadastro')
        ->withErrors($validator)
        ->withInput();
    }

    $c = \DB::select('SELECT COUNT(caixas.cod) as cod FROM caixas WHERE cod = ' . $request->cod);

    if ($c[0]->cod > 0) {
      $validator->errors()->add('errors', 'Codigo já existe!');
      return redirect('/cadastro')
        ->withErrors($validator)
        ->withInput();
    }

    $caixa = new Caixa;

    $caixa->cod = $request->cod;
    $caixa->description = $request->description;
    $caixa->user_id = Auth::user()->id;

    $caixa->save();

    return redirect()->route('home');
  }

  public function cadastro_editar(Request $request)
  {
    $caixa = \DB::table('caixas')->where('id', $request->id)->get();

    return view('cadastro-caixa', compact('caixa'));
  }

  public function cadastro_alterado(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'cod' => 'required|max:255',
      'description' => 'required|max:255',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    \DB::table('caixas')
      ->where('id', '=', $request->id)
      ->update([
        'cod' => $request->cod,
        'description' => $request->description,
        'user_id' => \Auth::user()->id,
      ]);
    $status = 'Caixa alterado!';
    return redirect()->route('home')->with('status', $status);
  }

  public function deletar_caixa(Request $request)
  {
    $user = User::find(\Auth::user()->id);
    $id = $request->id;

    if (empty($id)) {
      return back()->with('error', 'ID de caixa nulo!');
    }

    if (Hash::check($request->password, $user->password)) {
      $caixa = Caixa::find($id);

      $caixa->delete();

      return redirect('home')->with('status', 'Caixa Excluido!');
    } else {

      return redirect('home')->with('error', 'Senha Incorreta!');
    }
  }

  public function abrir_caixa(Request $request)
  {
    $id = $request->id;

    if (empty($id)) {
      return back()->with('error', 'ID de caixa nulo!');
    } else {
      $fechado = \DB::select("SELECT TOP 1 controle_caixas.caixa_id as aberturaCaixaId, controle_caixas.action, controle_caixas.time, controle_caixas.balance, users.name as userName, users.id as userId, caixas.description as caixaName
      FROM controle_caixas
      INNER JOIN users ON (controle_caixas.user_id = users.id)
      INNER JOIN caixas ON (controle_caixas.caixa_id = caixas.id)
      WHERE controle_caixas.caixa_id = $id
      ORDER BY controle_caixas.[time] DESC");

      $b = \DB::select("SELECT TOP 1 fluxo_caixas.balance, fluxo_caixas.caixa_id, fluxo_caixas.time
      FROM fluxo_caixas
      WHERE fluxo_caixas.caixa_id = " . $id . "
      ORDER BY fluxo_caixas.time DESC");

      if ((empty($fechado[0])) or ($fechado[0]->action == 'closed')) {
        $abCaixa = new ControleCaixa;

        $abCaixa->caixa_id = $id;
        $abCaixa->action = 'open';
        $abCaixa->time = date('Y-m-d H:i:s.v');
        $abCaixa->user_id = \Auth::user()->id;
        if ($b !== []) {
          $abCaixa->balance = $b[0]->balance;
        } else {
          $abCaixa->balance = 0;
        }
        $abCaixa->ip = \Request::ip();
        $abCaixa->browser = $request->header('User-Agent');

        $abCaixa->save();
      } /* else {
        return back()->with('error', 'Caixa ' . $fechado[0]->caixaName .  ' já foi aberto!');
      } */
    }

    $caixa = Caixa::join('users', 'users.id', 'caixas.user_id')
      ->join('controle_caixas', 'controle_caixas.caixa_id', 'caixas.id')
      ->where('caixas.id', $id)
      ->select(
        'caixas.id as caixaId',
        'caixas.description as caixaDescription',
        'caixas.cod as caixaCod',
        'users.id as userId',
        'users.name as userName',
        'controle_caixas.balance as aberturaCaixaBalance',
        'controle_caixas.time as aberturaCaixaTime'
      )
      ->orderBy('controle_caixas.time', 'desc')
      ->get()->first();

    $fCaixa = \DB::select("SELECT fluxo_caixas.id as controleCaixaId, FORMAT(fluxo_caixas.[time], 'hh:mm') as controleCaixaTime, fluxo_caixas.description as controleCaixaDescription, fluxo_caixas.action as fluxoCaixaAct, fluxo_caixas.cash as controleCaixaCash, fluxo_caixas.credit as controleCaixaCredit, fluxo_caixas.debit as controleCaixaDebit, fluxo_caixas.balance as controleCaixaBalance
    FROM fluxo_caixas 
    WHERE fluxo_caixas.caixa_id = " . $id . "
    ORDER BY fluxo_caixas.time DESC");

    $fCaixa = \App\FluxoCaixa::where('caixa_id', '=', $id)->orderBy('time', 'desc')->paginate(4);
    $fCaixaTransacoes = \App\FluxoCaixa::where('caixa_id', $id)->where('action', 'rem')->orderBy('time', 'desc')->paginate(4);

    return view('caixa-aberto', compact('caixa', 'fCaixa', 'fCaixaTransacoes'));
  }

  public function fechar_caixa(Request $request)
  {
    $id = $request->caixaId;

    if (empty($id)) {
      return back()->with('error', 'ID de caixa nulo!');
    } else {
      $aberto = \DB::select("SELECT TOP 1 controle_caixas.caixa_id as aberturaCaixaId, controle_caixas.action, controle_caixas.time, controle_caixas.balance, users.name as userName, users.id as userId, caixas.description as caixaName
      FROM controle_caixas
      INNER JOIN users ON (controle_caixas.user_id = users.id)
      INNER JOIN caixas ON (controle_caixas.caixa_id = caixas.id)
      WHERE controle_caixas.caixa_id = $id
      ORDER BY controle_caixas.[time] DESC");

      $b = \DB::select("SELECT TOP 1 fluxo_caixas.balance, fluxo_caixas.caixa_id, fluxo_caixas.time
      FROM fluxo_caixas
      WHERE fluxo_caixas.caixa_id = " . $id . "
      ORDER BY fluxo_caixas.time DESC");

      if ($aberto[0]->action == 'open') {
        $abCaixa = new ControleCaixa;

        $abCaixa->caixa_id = $id;
        $abCaixa->action = 'closed';
        $abCaixa->time = now();
        $abCaixa->user_id = \Auth::user()->id;

        if ($b !== []) {
          $abCaixa->balance = $b[0]->balance;
        } else {
          $abCaixa->balance = 0;
        }

        $abCaixa->ip = \Request::ip();
        $abCaixa->browser = $request->header('User-Agent');

        $abCaixa->save();

        return redirect('home')->with('status', 'Caixa ' . $aberto[0]->caixaName . ' fechado!');
      } /* else {
        return back()->with('error', 'Caixa ' . $aberto[0]->caixaName .  ' já foi fechado!');
      } */
    }
  }

  public function adicionar_dinheiro(Request $request)
  {
    $caixaId = $request->caixaId;
    $caixaDescription = $request->caixaDescription;
    $type = $request->type;
    $value = str_replace('-', '', $request->value);

    if (empty($caixaId)) {
      return back()->with('error', 'ID de caixa nulo!');
    }

    $validator = Validator::make($request->all(), [
      'type' => 'required',
      'value' => 'required|numeric',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $b = \DB::select("SELECT TOP 1 *
    FROM fluxo_caixas
    WHERE fluxo_caixas.caixa_id = " . $caixaId . "
    ORDER BY fluxo_caixas.time DESC");
    if (!empty($b)) {
      $balance = $b[0]->balance + $value;
    } else {
      $balance = $value;
    }
    $caixaAberto = \DB::select("SELECT TOP 1 controle_caixas.caixa_id as aberturaCaixaId, controle_caixas.action, controle_caixas.time, controle_caixas.balance, users.name as userName, users.id as userId, caixas.description as caixaName
      FROM controle_caixas
      INNER JOIN users ON (controle_caixas.user_id = users.id)
      INNER JOIN caixas ON (controle_caixas.caixa_id = caixas.id)
      WHERE controle_caixas.caixa_id = $caixaId
      ORDER BY controle_caixas.[time] DESC");

    if ($caixaAberto[0]->action == 'open') {
      $fluxoCaixa = new FluxoCaixa;

      $fluxoCaixa->time = now();
      $fluxoCaixa->description = $caixaDescription;
      $fluxoCaixa->action = 'add';
      switch ($type) {
        case 'cash':
          $fluxoCaixa->cash = $value;
          break;
        case 'credit':
          $fluxoCaixa->credit = $value;
          break;
        case 'debit':
          $fluxoCaixa->debit = $value;
          break;
      }

      $fluxoCaixa->balance = $balance;
      $fluxoCaixa->caixa_id = $caixaId;

      $fluxoCaixa->save();
      $id = $caixaId;
      return redirect()->route('abrir_caixa', $id);
    }
  }

  public function remover_dinheiro(Request $request)
  {
    $caixaId = $request->caixaId;
    $caixaDescription = $request->caixaDescription;
    $type = $request->type;
    $value = str_replace('-', '', $request->value);

    if (empty($caixaId)) {
      return back()->with('error', 'ID de caixa nulo!');
    }

    $validator = Validator::make($request->all(), [
      'type' => 'required',
      'value' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $b = \DB::select("SELECT TOP 1 *
    FROM fluxo_caixas
    WHERE fluxo_caixas.caixa_id = " . $caixaId . "
    ORDER BY fluxo_caixas.time DESC");

    if (!empty($b)) {
      $balance = $b[0]->balance - $value;
    } else {
      $balance = $value;
    }
    if ($balance < 0) {
      $id = $caixaId;
      $validator->errors()->add('errors', 'Impossivel remover a quantia desejada, saldo negativo! ' . $balance);
      return redirect('/caixa-aberto/' . $id)
        ->withErrors($validator)
        ->withInput();
    }
    $caixaAberto = \DB::select("SELECT TOP 1 controle_caixas.caixa_id as aberturaCaixaId, controle_caixas.action, controle_caixas.time, controle_caixas.balance, users.name as userName, users.id as userId, caixas.description as caixaName
      FROM controle_caixas
      INNER JOIN users ON (controle_caixas.user_id = users.id)
      INNER JOIN caixas ON (controle_caixas.caixa_id = caixas.id)
      WHERE controle_caixas.caixa_id = $caixaId
      ORDER BY controle_caixas.[time] DESC");

    if ($caixaAberto[0]->action == 'open') {
      $fluxoCaixa = new FluxoCaixa;

      $fluxoCaixa->time = now();
      $fluxoCaixa->description = $caixaDescription;
      $fluxoCaixa->action = 'rem';

      switch ($type) {
        case 'cash':
          $fluxoCaixa->cash = $value;
          break;
        case 'credit':
          $fluxoCaixa->credit = $value;
          break;
        case 'debit':
          $fluxoCaixa->debit = $value;
          break;
      }

      $fluxoCaixa->balance = $balance;
      $fluxoCaixa->caixa_id = $caixaId;

      $fluxoCaixa->save();
      $id = $caixaId;
      return redirect()->route('abrir_caixa', $id);
    }
  }

  public function transacoes($id)
  {
    $userId = \Auth::user()->id;
    $userName = \Auth::user()->name;
    $cCaixa = \App\ControleCaixa::where('caixa_id', $id)->orderBy('time', 'desc')->select('caixa_id as id', 'action', 'time', 'user_id', 'balance')->first();
    $fCaixa = \App\FluxoCaixa::where('caixa_id', $id)->where('action', 'rem')->orderBy('time', 'desc')->paginate(4);

    $fDeb = \App\FluxoCaixa::where('caixa_id', $id)->where('action', 'rem')->get();

    if (count($fDeb) == 0) {
      $fDeb = \App\FluxoCaixa::where('caixa_id', '=', $id)->get();
    }

    foreach ($fDeb as $f) {
      if ($f->action == 'rem') {
        $totalDeb[] = $f->cash;
        $totalDeb[] = $f->credit;
        $totalDeb[] = $f->debit;
      } else {
        $totalDeb[] = 0;
      }
    }

    if (!empty($totalDeb)) {
      $tDeb = array_sum($totalDeb);
    } else {
      $tDeb = 0;
    }

    return view('transacoes', compact('userName', 'cCaixa', 'fCaixa', 'tDeb'));
  }

  public function resumo_financeiro($id)
  {
    $userId = \Auth::user()->id;
    $userName = \Auth::user()->name;
    $cCaixa = \App\ControleCaixa::where('caixa_id', $id)->orderBy('time', 'desc')->select('caixa_id as id', 'action', 'time', 'user_id', 'balance')->first();
    $fCaixa = \App\FluxoCaixa::where('caixa_id', $id)->select('time', 'description', 'action', 'cash', 'credit', 'debit', 'balance', 'caixa_id')->get();
    foreach ($fCaixa as $f) {
      if ($f->action == 'add') {
        $totalRec[] = $f->cash;
        $totalRec[] = $f->credit;
        $totalRec[] = $f->debit;
      } else {
        $totalRec[] = 0;
      }
      if ($f->action == 'rem') {
        $totalDesp[] = $f->cash;
        $totalDesp[] = $f->credit;
        $totalDesp[] = $f->debit;
      } else {
        $totalDesp[] = 0;
      }
    }
    $tRec = array_sum($totalRec);
    $tDesp = array_sum($totalDesp);
    $pRec = 100 * $tRec / ($tRec + $tDesp);
    $pDesp = 100 - $pRec;

    function round_up($number, $precision = 1)
    {
      $fig = (int) str_pad('1', $precision, '0');
      return (ceil($number * $fig) / $fig);
    }

    function round_down($number, $precision = 1)
    {
      $fig = (int) str_pad('1', $precision, '0');
      return (floor($number * $fig) / $fig);
    }
    $r = round_up($pRec) . '%';
    $d = round_down($pDesp) . '%';
    return view('resumo-financeiro', compact('userName', 'cCaixa', 'fCaixa', 'tRec', 'tDesp', 'r', 'd'));
  }

  /*** END ***/
}
