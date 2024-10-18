<?php

namespace App\Http\Controllers;

use App\Models\Depto; // Asegúrate de que esto sea 'Depto'
use Illuminate\Http\Request;

class DeptoController extends Controller
{
    public function index()
    {
        $departamentos = Depto::paginate(8);
        return view("deptos.index", compact("departamentos"));
    }

    public function create()
    {
        $departamento = new Depto;
        $accion = "C";
        $txtbtn = "Guardar";
        $des = "";
        return view("deptos.frm", compact("departamento", "accion", "txtbtn", "des"));
    }

    public function store(Request $request)
    {
        $val = $request->validate([
            'iddepto' => ['required', 'max:2', 'unique:depto,iddepto'],
            'nombredepto' => ['required', 'max:100', 'unique:depto,nombredepto'],
            'nombremediano' => ['required', 'max:15', 'unique:depto,nombremediano'],
            'nombrecorto' => ['required', 'max:5', 'unique:depto,nombrecorto'],
        ]); 

        Depto::create($val); 
        return redirect()->route("deptos.index")->with("mensaje", "Departamento registrado correctamente.");
    }

    public function show(Depto $departamento) 
    {
        $accion = "D";
        $txtbtn = "Confirmar Eliminación";
        $des = "disabled";
        return view("deptos.frm", compact("departamento", "accion", "txtbtn", "des"));
    }

    public function edit(Depto $departamento) 
    {
        $accion = "E"; 
        $txtbtn = "Actualizar";
        $des = ""; 
        return view("deptos.frm", compact("departamento", "accion", "txtbtn", "des"));
    }

    public function update(Request $request, Depto $departamento) 
    {
        $val = $request->validate([
            'iddepto' => ['required', 'max:2', 'unique:depto,iddepto,' . $departamento->id],
            'nombredepto' => ['required', 'max:100', 'unique:depto,nombredepto,' . $departamento->id],
            'nombremediano' => ['required', 'max:15', 'unique:depto,nombremediano,' . $departamento->id],
            'nombrecorto' => ['required', 'max:5', 'unique:depto,nombrecorto,' . $departamento->id],
        ]); 

        $departamento->update($val); 
        return redirect()->route("deptos.index")->with("mensaje", "Departamento actualizado correctamente.");
    }

    public function destroy(Depto $departamento) 
    {
        $departamento->delete(); 
        return redirect()->route("deptos.index")->with("mensaje", "Departamento eliminado correctamente.");
    }
}
