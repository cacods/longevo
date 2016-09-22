<?php

namespace App\Http\Controllers;

use App\Chamado;
use App\Cliente;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

use App\Http\Requests;

class ChamadosController extends Controller
{
    /**
     * Retorna view com todos os chamados.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $chamados = Chamado::latest('updated_at')->get();

        return view('chamados.index', compact('chamados'));
    }

    /**
     * Retorna view com os dados de um chamado.
     *
     * @param Chamado $chamado
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Chamado $chamado)
    {
        return view('chamados.chamado', compact($chamado));
    }

    /**
     * Filtra chamados por pedido ou email.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse |
     * \Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function filter(Request $request)
    {
        $chamados = new Chamado;

        if ($request->has('pedido')) {
            $chamados = $chamados->where('pedido_id', $request->get('pedido'));
        }
        if ($request->has('email')) {
            $cliente = Cliente::where('email', $request->get('email'))->first();
            if ( !is_null($cliente) ) {
                $pedidos = $cliente->pedidos;
                foreach ($pedidos as $pedido) {
                    $chamados = $chamados->push($pedido->chamados);
                }
            }
        }

        $chamados = $chamados->get();

        if ($chamados->isEmpty()) {
            //flash message
            return redirect()->route('chamados');
        }

        return view('chamados.index', compact('chamados'));
    }
}
