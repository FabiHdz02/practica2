<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use Illuminate\Http\Request;

class CarreraController extends Controller
{
    public $val;

    public function __construct()
    {
        $this->val = [
            'idcarrera' => ['required', 'max:15', 'unique:carreras,idcarrera'],
            'nombrecarrera' => ['required', 'min:3', 'max:200', 'unique:carreras,nombrecarrera'],
            'nombremediano' => ['required', 'max:50', 'unique:carreras,nombremediano'],
            'nombrecorto' => ['required', 'max:5', 'unique:carreras,nombrecorto'],
            'depto_id' => ['required', 'exists:departamentos,id']
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carreras = Carrera::paginate(8);  // Obtiene las carreras con paginación
        return view("tabla", compact("carreras"));  // Cambia "carreras.index" por "tabla" si ese es el nombre correcto de la vista
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $carreras = Carrera::paginate(8);
        $carrera = new Carrera;
        $accion = "C";
        $txtbtn = "Guardar";
        $des = "";
        return view("carreras.frm", compact("carrera", "carreras", "accion", "txtbtn", "des"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $val = $request->validate($this->val);
        Carrera::create($val);
        return redirect()->route("carreras.index")->with("mensaje", "Carrera registrada correctamente.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Carrera $carrera)
    {
        $accion = "D";
        $txtbtn = "Confirmar Eliminación";
        $des = "disabled";
        return view("carreras.frm", compact("carrera", "accion", "txtbtn", "des"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carrera $carrera)
    {
        $accion = "E";
        $txtbtn = "Actualizar";
        $des = "";
        return view("carreras.frm", compact('carrera', "accion", "txtbtn", "des"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Carrera $carrera)
    {
        $val = $request->validate($this->val);

        $carrera->update($val);
        return redirect()->route("carreras.index")->with("mensaje", "Carrera actualizada correctamente.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carrera $carrera)
    {
        $carrera->delete();
        return redirect()->route("carreras.index")->with("mensaje", "Carrera eliminada correctamente.");
    }
}