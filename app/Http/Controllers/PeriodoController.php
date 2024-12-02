<?php

namespace App\Http\Controllers;

use App\Models\Periodo;
use Illuminate\Http\Request;

class PeriodoController extends Controller
{
    protected $val;

    public function __construct()
    {
        $this->val = [
            'periodo' => ['required', 'string', 'max:100'],
            'desccorta' => ['required', 'string', 'max:50'],
            'fechaini' => ['required', 'date'],
            'fechafin' => ['required', 'date'],
            'fechaapertura' => ['required', 'date'],
            'fechacierre' => ['required', 'date'],
        ];
    }

    public function index()
    {
        $periodos = Periodo::paginate(8);
        return view("periodos.index", compact("periodos"));
    }

    public function create()
    {
        $periodo = new Periodo;
        $accion = "C";
        $txtbtn = "Guardar";
        $des = "";
        return view("periodos.frm", compact("periodo", "accion", "txtbtn", "des"));
    }

    public function store(Request $request)
    {
        $val = $request->validate($this->val);
        Periodo::create($val);
        return redirect()->route("periodos.index")->with("mensaje", "Periodo registrado correctamente.");
    }

    public function show(Periodo $periodo)
    {
        $accion = "D";
        $txtbtn = "";
        $des = "disabled";
        return view("periodos.frm", compact("periodo", "accion", "txtbtn", "des"));
    }

    public function edit(Periodo $periodo)
    {
        $accion = "E";
        $txtbtn = "Actualizar";
        $des = "";
        return view("periodos.frm", compact("periodo", "accion", "txtbtn", "des"));
    }

    public function update(Request $request, Periodo $periodo)
    {
        $val = $request->validate($this->val);
        $periodo->update($val);
        return redirect()->route("periodos.index")->with("mensaje", "Periodo actualizado correctamente.");
    }

    public function destroy(Periodo $periodo)
    {
        $periodo->delete();
        return redirect()->route("periodos.index")->with("mensaje", "Periodo eliminado correctamente.");
    }
}
