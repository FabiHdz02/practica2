<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\TipoPago;
use App\Models\Alumno;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function index()
    {
        $tipoPagos = TipoPago::all();
        $alumnos = Alumno::all();
        $pagos = Pago::with('tipoPago', 'alumno')->paginate(8);
        return view('pagos.index', compact('pagos', 'alumnos', 'tipoPagos'));
    }

    public function create()
    {
        $tipoPagos = TipoPago::all();
        $alumnos = Alumno::all();
        return view('pagos.frm', compact('tipoPagos', 'alumnos'))->with('accion', 'C');
    }

    public function store(Request $request)
    {
        $request->validate([
            'monto' => 'required|numeric',
            'fechapago' => 'required|date',
            'comprobante' => 'nullable|file|mimes:pdf,png|max:2048',
            'tipo_pago_id' => 'required|exists:tipo_pagos,id',
            'alumno_id' => 'required|exists:alumnos,id',
        ]);

        $data = $request->all();

        if ($request->hasFile('comprobante')) {
            $filePath = $request->file('comprobante')->store('comprobantes', 'public');
            logger('Archivo guardado en: ' . $filePath); // Registro para depuración
            $data['comprobante'] = $filePath;
        } else {
            $data['comprobante'] = null;
        }
        

        Pago::create($data);
        return redirect()->route('pagos.index')->with('mensaje', 'Pago registrado con éxito.');
    }

    public function edit(Pago $pago)
    {
        $tipoPagos = TipoPago::all();
        $alumnos = Alumno::all();
        return view('pagos.frm', compact('pago', 'tipoPagos', 'alumnos'))->with('accion', 'E');
    }

    public function update(Request $request, Pago $pago)
    {
        $request->validate([
            'monto' => 'required|numeric',
            'fechapago' => 'required|date',
            'comprobante' => 'nullable|file|mimes:pdf,png|max:2048',
            'tipo_pago_id' => 'required|exists:tipo_pagos,id',
            'alumno_id' => 'required|exists:alumnos,id',
        ]);

        $data = $request->all();

        if ($request->hasFile('comprobante')) {
            $filePath = $request->file('comprobante')->store('comprobantes', 'public');
            $data['comprobante'] = $filePath;
        }

        $pago->update($data);
        return redirect()->route('pagos.index')->with('mensaje', 'Pago actualizado con éxito.');
    }

    public function destroy(Pago $pago)
    {
        $pago->delete();
        return redirect()->route('pagos.index')->with('mensaje', 'Pago eliminado con éxito.');
    }

    public function show(Pago $pago)
    {
        return view('pagos.show', compact('pago'));
    }
}
