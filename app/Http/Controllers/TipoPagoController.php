<?php

namespace App\Http\Controllers;

use App\Models\TipoPago;
use Illuminate\Http\Request;

class TipoPagoController extends Controller
{
    public function index()
    {
        $tipopagos = TipoPago::paginate(8);
        return view('tipopagos.index', compact('tipopagos'));
    }

    public function create()
    {
        return view('tipopagos.frm', ['accion' => 'C', 'tipoPago' => new TipoPago()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipopago' => 'required|string|max:255',
        ]);

        TipoPago::create($request->all());
        return redirect()->route('tipopagos.index')->with('mensaje', 'Tipo de Pago registrado con éxito.');
    }

    public function edit(TipoPago $tipopago)
    {
        return view('tipopagos.frm', ['accion' => 'E', 'tipoPago' => $tipopago]);
    }

    public function update(Request $request, TipoPago $tipopago)
    {
        $request->validate([
            'tipopago' => 'required|string|max:255',
        ]);

        $tipopago->update($request->all());
        return redirect()->route('tipopagos.index')->with('mensaje', 'Tipo de Pago actualizado con éxito.');
    }

    public function destroy(TipoPago $tipopago)
    {
        $tipopago->delete();
        return redirect()->route('tipopagos.index')->with('mensaje', 'Tipo de Pago eliminado con éxito.');
    }
    
}
