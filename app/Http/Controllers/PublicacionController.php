<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicacion;
use App\Models\ImagenMascota;
use App\Models\Usuario;
use Illuminate\Support\Facades\Storage;


class PublicacionController extends Controller
{

    public function listarMascotasDisponibles(Request $request)
    {
        $especieId = $request->query('especie');
        $query = Publicacion::where('estado', true);

        if ($especieId !== null) {
            $query->where('especie_id', $especieId);
        }

        $publicaciones = $query->get(['id', 'titulo', 'edad', 'raza', 'ciudad_id', 'estado', 'especie_id'])
            ->map(function ($publicacion) {
                $imagen = ImagenMascota::where('id_publicacion', $publicacion->id)
                    ->pluck('urlIMG')
                    ->first();

                return [
                    'id' => $publicacion->id,
                    'titulo' => $publicacion->titulo,
                    'edad' => $publicacion->edad,
                    'raza' => $publicacion->raza,
                    'ciudad' => $publicacion->ciudad ? $publicacion->ciudad->nombre : 'Desconocido',
                    'imagen' => $imagen ? ['urlIMG' => $imagen] : ['urlIMG' => 'https://via.placeholder.com/150'],
                    'disponible' => $publicacion->estado,
                    'especie' => $publicacion->especie_id,
                ];
            });

        return response()->json([
            'transaction' => true,
            'message' => 'mascotas disponibles',
            'data' => $publicaciones
        ], 200);
    }



    //funcion para mostrar una publicacion en especifico
    public function mostrarPublicacion($id)
    {
        // Recuperamos la publicación junto con las relaciones necesarias
        $publicacion = Publicacion::with(['ciudad', 'usuario', 'especie'])
            ->find($id, [
                'id',
                'titulo',
                'descripcion',
                'raza',
                'edad',
                'cantidad_machos',
                'cantidad_hembras',
                'telefono',
                'fecha_publicacion',
                'ciudad_id',
                'estado',
                'usuario_id',
                'especie_id'
            ]);

        // Verificamos si la publicación no existe
        if (!$publicacion) {
            return response()->json([
                'transaction' => false,
                'message' => 'Publicación no encontrada'
            ], 404);
        }

        // Obtenemos todas las imágenes asociadas a la publicación
        $imagenes = ImagenMascota::where('id_publicacion', $publicacion->id)
            ->pluck('urlIMG');

        // Formamos los datos de la respuesta
        $publicacionData = [
            'titulo' => $publicacion->titulo,
            'descripcion' => $publicacion->descripcion,
            'raza' => $publicacion->raza,
            'edad' => $publicacion->edad,
            'cantidad_machos' => $publicacion->cantidad_machos,
            'cantidad_hembras' => $publicacion->cantidad_hembras,
            'telefono' => $publicacion->telefono,
            'fecha_publicacion' => $publicacion->fecha_publicacion,
            'ciudad' => $publicacion->ciudad ? $publicacion->ciudad->nombre : 'Sin ciudad',
            'estado' => $publicacion->estado,
            'usuario' => $publicacion->usuario ? $publicacion->usuario->nombre : 'Sin usuario',
            'especie' => $publicacion->especie ? $publicacion->especie->nombre : 'Sin especie',
            'imagenes' => $imagenes, // Devolvemos todas las imágenes
        ];

        // Retornamos la respuesta en formato JSON
        return response()->json([
            'transaction' => true,
            'data' => $publicacionData
        ]);
    }


    public function publicar(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'raza' => 'required|string|max:255',
            'edad' => 'required|integer|min:0',
            'cantidad_machos' => 'required|integer|min:0',
            'cantidad_hembras' => 'required|integer|min:0',
            'telefono' => 'required|string|max:20',
            'usuario_id' => 'required|exists:usuarios,id',
            'ciudad_id' => 'required|exists:ciudades,id',
            'especie_id' => 'required|exists:especies,id',
            'imagenes' => 'nullable|array', // Validación para el array de imágenes
            'imagenes.*' => 'required|string', // Validación para cada imagen en Base64
        ]);

        $publicacion = Publicacion::create($validated);

        if (!empty($validated['imagenes'])) {
            foreach ($validated['imagenes'] as $imagenBase64) {
                // Decodificar la imagen y guardarla
                $imageData = base64_decode($imagenBase64);
                $fileName = uniqid() . '.jpg'; // Cambia la extensión si necesitas otro formato
                $path = public_path('/uploads/mascotas/' . $fileName);
                file_put_contents($path, $imageData);

                // Generar la ruta relativa
                $relativePath = 'http://192.168.100.123:8000/uploads/mascotas/' . $fileName;

                ImagenMascota::create([
                    'id_publicacion' => $publicacion->id,
                    'urlIMG' => $relativePath,
                ]);
            }
        }

        return response()->json(['message' => 'Publicación creada exitosamente.', 'publicacion' => $publicacion], 201);
    }


    public function cambiarEstado($id)
    {
        $publicacion = Publicacion::find($id);

        if (!$publicacion) {
            return response()->json(['message' => 'Publicación no encontrada'], 404);
        }

        // Cambiar el estado (true <-> false)
        $publicacion->estado = !$publicacion->estado;
        $publicacion->save();

        return response()->json([
            'message' => 'Estado actualizado',
            'estado' => $publicacion->estado,
        ]);
    }
  
    public function eliminarPublicacion($id)
    {
        $publicacion = Publicacion::find($id);
    
        if (!$publicacion) {
            return response()->json(['message' => 'Publicación no encontrada'], 404);
        }
    
        // Eliminar las imágenes asociadas a la publicación
        $imagenes = ImagenMascota::where('id_publicacion', $publicacion->id)->get();
    
        foreach ($imagenes as $imagen) {
            // Eliminar el archivo de imagen del servidor
            $filePath = public_path(parse_url($imagen->urlIMG, PHP_URL_PATH));
            if (file_exists($filePath)) {
                unlink($filePath); // Elimina el archivo físico
            }
            // Eliminar el registro de la base de datos
            $imagen->delete(); // Elimina el registro de la tabla `imagen_mascotas`
        }
    
        // Ahora elimina la publicación
        $publicacion->delete();
    
        return response()->json(['message' => 'Publicación eliminada correctamente']);
    }
    

    public function obtenerPublicacionesPorUsuario($usuario_id)
    {
     
        $usuario = Usuario::find($usuario_id);
        if (!$usuario) {
            return response()->json([
                'transaction' => false,
                'message' => 'Usuario no encontrado'
            ], 404);
        }
    
       
        $publicaciones = Publicacion::where('usuario_id', $usuario_id)
            ->get(['id', 'titulo', 'edad', 'raza', 'ciudad_id', 'estado', 'especie_id'])
            ->map(function ($publicacion) {
               
                $imagen = ImagenMascota::where('id_publicacion', $publicacion->id)
                    ->pluck('urlIMG')
                    ->first();
    
                return [
                    'id' => $publicacion->id,
                    'titulo' => $publicacion->titulo,
                    'edad' => $publicacion->edad,
                    'raza' => $publicacion->raza,
                    'ciudad' => $publicacion->ciudad ? $publicacion->ciudad->nombre : 'Desconocido',
                    'imagen' => $imagen ? ['urlIMG' => $imagen] : ['urlIMG' => 'https://via.placeholder.com/150'],
                    'disponible' => $publicacion->estado,
                    'especie' => $publicacion->especie_id,
                ];
            });
    
      
        if ($publicaciones->isEmpty()) {
            return response()->json([
                'transaction' => true,
                'message' => 'El usuario no tiene publicaciones',
                'publicaciones' => []
            ], 200);
        }
    
     
        return response()->json([
            'transaction' => true,
            'message' => 'Publicaciones obtenidas exitosamente',
            'data' => $publicaciones
        ], 200);
    }


    public function index()
    {
        $publicaciones = Publicacion::all();
        return response()->json($publicaciones, 200);
    }

    public function store(Request $request)
    {
        $publicacion = Publicacion::create($request->all());
        return response()->json($publicacion, 201);
    }

    public function show($id)
    {
        $publicacion = Publicacion::find($id);
        if ($publicacion) {
            return response()->json($publicacion, 200);
        } else {
            return response()->json('Publicacion no encontrada', 404);
        }
    }

    public function update(Request $request, $id)
    {
        $publicacion = Publicacion::find($id);
        if ($publicacion) {
            $publicacion->update($request->all());
            return response()->json($publicacion, 200);
        } else {
            return response()->json('Publicacion no encontrada', 404);
        }
    }

    public function destroy($id)
    {
        $publicacion = Publicacion::find($id);
        if ($publicacion) {
            $publicacion->delete();
            return response()->json('Publicacion eliminada', 200);
        } else {
            return response()->json('Publicacion no encontrada', 404);
        }
    }
}
