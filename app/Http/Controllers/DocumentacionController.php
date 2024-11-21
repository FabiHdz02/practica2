<?php

namespace App\Http\Controllers;

use App\Models\Documentacion;
use App\Models\Tipoinsc;
use App\Models\Alumno;
use Illuminate\Http\Request;

class DocumentacionController extends Controller
{
    protected $val;

    public function __construct()
    {
        $this->val = [
            'curp' => ['file', 'mimes:pdf,jpg,jpeg,png', 'max:45000'],
            'certificado' => [ 'file', 'mimes:pdf,jpg,jpeg,png', 'max:45000'],
            'cdomi' => [ 'file', 'mimes:pdf,jpg,jpeg,png', 'max:45000'],
            'actanac' => ['file', 'mimes:pdf,jpg,jpeg,png', 'max:45000'],
            'tipoinsc_id' => ['required', 'exists:tipoinscs,id'],
            'alumnos_id' => ['required', 'exists:alumnos,id'],
        ];
    }

    public function index()
    {
        $documentacions = Documentacion::with(['tipoinsc', 'alumno'])->paginate(8);
        return view("documentacions.index", compact("documentacions"));
    }

    public function create()
    {
        $documentacion = new Documentacion;
        $accion = "C";
        $txtbtn = "Guardar";
        $des = "";

        $tipoinscs = Tipoinsc::all();
        $alumnos = Alumno::all();

        return view("documentacions.frm", compact("documentacion", "accion", "txtbtn", "des", "tipoinscs", "alumnos"));
    }

    public function store(Request $request)
    {
        $val = $request->validate($this->val);

        try {
            // Guardar los archivos con su nombre original
            $uploadedFiles = [];
            $fileFields = ['curp', 'certificado', 'cdomi', 'actanac'];

            foreach ($fileFields as $field) {
                if ($request->hasFile($field)) {
                    $file = $request->file($field);
                    
                    // Generar un nombre único pero conservando la extensión original
                    $originalName = $file->getClientOriginalName();
                    $fileName = time() . '_' . $originalName;
                    
                    // Guardar el archivo
                    $path = $file->storeAs('documentaciones', $fileName, 'public');
                    $uploadedFiles[$field] = $fileName;
                } else {
                    return back()->withErrors(["$field" => "El archivo $field es requerido."])->withInput();
                }
            }

            // Combinar los archivos guardados con los otros datos de validación
            $val = array_merge($val, $uploadedFiles);

            Documentacion::create($val);

            return redirect()->route("documentacions.index")->with("mensaje", "Documentación registrada correctamente.");
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'No se pudo guardar la documentación: ' . $e->getMessage()])->withInput();
        }
    }

    public function show(Documentacion $documentacion)
    {
        $accion = "D";
        $txtbtn = "";
        $des = "disabled";

        $tipoinscs = Tipoinsc::all();
        $alumnos = Alumno::all();

        return view("documentacions.frm", compact("documentacion", "accion", "txtbtn", "des", "tipoinscs", "alumnos"));
    }

    public function edit(Documentacion $documentacion)
    {
        $accion = "E";
        $txtbtn = "Actualizar";
        $des = "";

        $tipoinscs = Tipoinsc::all();
        $alumnos = Alumno::all();

        return view("documentacions.frm", compact("documentacion", "accion", "txtbtn", "des", "tipoinscs", "alumnos"));
    }

    public function update(Request $request, Documentacion $documentacion)
    {
        $val = $request->validate($this->val);

        try {
            // Actualizar los archivos subidos (si se proporcionan nuevos)
            $fileFields = ['curp', 'certificado', 'cdomi', 'actanac'];

            foreach ($fileFields as $field) {
                if ($request->hasFile($field)) {
                    $file = $request->file($field);
                    
                    // Generar un nombre único pero conservando la extensión original
                    $originalName = $file->getClientOriginalName();
                    $fileName = time() . '_' . $originalName;
                    
                    // Guardar el archivo
                    $path = $file->storeAs('documentaciones', $fileName, 'public');
                    $val[$field] = $fileName;
                } else {
                    // Si no se sube un nuevo archivo, mantener el archivo existente
                    $val[$field] = $documentacion->$field;
                }
            }

            $documentacion->update($val);

            return redirect()->route("documentacions.index")->with("mensaje", "Documentación actualizada correctamente.");
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'No se pudo actualizar la documentación: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy(Documentacion $documentacion)
    {
        try {
            $documentacion->delete();
            return redirect()->route("documentacions.index")->with("mensaje", "Documentación eliminada correctamente.");
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'No se pudo eliminar la documentación.']);
        }
    }
}