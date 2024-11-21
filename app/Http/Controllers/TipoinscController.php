<?php

namespace App\Http\Controllers;

use App\Models\Tipoinsc;
use App\Models\Periodo;
use Illuminate\Http\Request;

class TipoinscController extends Controller
{
    protected $val;

    public function __construct()
    {
        $this->val = [
            'tipo' => ['required', 'string', 'in:Inscripción,Reinscripción', 'max:45'],
            'fecha' => ['required', 'date'],
            'periodo_id' => ['required', 'exists:periodos,id'] // Cambiado de periodos_id a periodo_id
        ];
    }

    public function index()
    {
        $tipoinscs = Tipoinsc::with('periodo')->paginate(8);
        return view("tipoinscs.index", compact("tipoinscs"));
    }

    public function create()
    {
        $tipoinsc = new Tipoinsc;
        $accion = "C";
        $txtbtn = "Guardar";
        $des = "";

        $periodos = Periodo::all();

        return view("tipoinscs.frm", compact("tipoinsc", "accion", "txtbtn", "des", "periodos"));
    }

    public function store(Request $request)
    {
        $val = $request->validate($this->val);
        try {
            Tipoinsc::create($val);
            return redirect()->route("tipoinscs.index")->with("mensaje", "Tipo de inscripción registrado correctamente.");
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }
    

    public function show(Tipoinsc $tipoinsc)
    {
        $accion = "D";
        $txtbtn = "";
        $des = "disabled";

        $periodos = Periodo::all();

        return view("tipoinscs.frm", compact("tipoinsc", "accion", "txtbtn", "des", "periodos"));
    }

    public function edit(Tipoinsc $tipoinsc)
    {
        $accion = "E";
        $txtbtn = "Actualizar";
        $des = "";

        $periodos = Periodo::all();

        return view("tipoinscs.frm", compact("tipoinsc", "accion", "txtbtn", "des", "periodos"));
    }

    public function update(Request $request, Tipoinsc $tipoinsc)
    {
        $val = $request->validate($this->val);

        try {
            $tipoinsc->update($val);
            return redirect()->route("tipoinscs.index")->with("mensaje", "Tipo de inscripción actualizado correctamente.");
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'No se pudo actualizar el tipo de inscripción.'])->withInput();
        }
    }

    public function destroy(Tipoinsc $tipoinsc)
    {
        try {
            $tipoinsc->delete();
            return redirect()->route("tipoinscs.index")->with("mensaje", "Tipo de inscripción eliminado correctamente.");
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'No se pudo eliminar el tipo de inscripción.']);
        }
    }
}
