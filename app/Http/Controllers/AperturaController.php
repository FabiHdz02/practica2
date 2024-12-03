<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
class AperturaController extends Controller
{
    // Obtener el estado actual desde el archivo de configuración
    public function getEstado()
    {
        $estado = config('apertura.estado'); // Leer el estado del archivo
        return response()->json(['estado' => $estado]);
    }
 
    // Actualizar el estado en el archivo de configuración
    public function updateEstado(Request $request)
    {
        $request->validate([
            'estado' => 'required|in:opened,closed',
        ]);
 
        // Escribir el nuevo estado en el archivo de configuración
        $this->updateConfigFile($request->estado);
 
        return response()->json(['success' => true, 'estado' => $request->estado]);
    }
 
    // Función para actualizar el archivo de configuración
    private function updateConfigFile($estado)
    {
        $configPath = config_path('apertura.php');
        $configContent = "<?php\n\nreturn [\n    'estado' => '{$estado}',\n];\n";
        file_put_contents($configPath, $configContent);
    }
}