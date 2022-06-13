<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateAct;
use App\Models\Act;
use App\Models\User;
use Illuminate\Http\Request;

class ActController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Act $act)
    {
        $this->middleware('auth');
        $this->repositorio = $act;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {        
        $acts = $this->repositorio->orderBy('TX_ORGAO')->get();
        return view('act.index', compact('acts'));
    }

    public function create()
    {
        return view('act.create');
    }

    public function store(StoreUpdateAct $request){
        $dados = $request->all();
        $sit = $this->verificarSituacao($dados);
        $dados = array_merge($dados, $sit);
        $user = new User();
        $user = $user->getUserNameAd();
        $dados = array_merge($dados, ['TX_USUARIO' => $user]);
        
        // dd($dados);
        $this->repositorio->create($dados);

        return redirect()->route('act.index')->with('sucesso', 'Acordo gravado com sucesso.');
    }

    public function edit($id){
        $act = $this->repositorio->where('ID_ACORDO_COOP_ORGAO_ART', $id)->first();
        return view('act.edit', compact('act'));
    }

    public function update(Request $request, $id){
        //dd($request);
        $act = $this->repositorio->where('ID_ACORDO_COOP_ORGAO_ART', $id)->first();
        if (!$act)
            return redirect()->back()->with('erro', 'ACT não encontrado.');
        
        $dados = $request->except('_token', '_method');
        $sit = $this->verificarSituacao($request->all());
        $dados = array_merge($dados, $sit);
        $user = new User();
        $user = $user->getUserNameAd();
        //dd($dados);
        $act->where('ID_ACORDO_COOP_ORGAO_ART', $id)->update($dados);
        return redirect()->back()->with('sucesso', 'Acordo alterado com sucesso.');
    }

    /**
     * Verifica se a situação foi ativada
     */
    public function verificarSituacao(array $dados)
    {
        if (!array_key_exists('NR_SITUACAO_ACORDO_COOP', $dados))
            return ['NR_SITUACAO_ACORDO_COOP' => '0'];
        else
            return ['NR_SITUACAO_ACORDO_COOP' => '1'];
    }

}
