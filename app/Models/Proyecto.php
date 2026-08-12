<?php

namespace App\Models;
use Illuminate\Support\Facades\Session;

class Proyecto {

    //Datos estaticos de ejemplo pa ver el funcionamiento 
    public static array $proyectosBase = [
        ['id' => 1, 'nombre' => 'Sistema Web', 'fecha_inicio' => '2026-01-10', 'estado' => 'En curso', 'responsable' => 'Ana Karen', 'monto' => 2800000],
        ['id' => 2, 'nombre' => 'App Movil', 'fecha_inicio' => '2026-02-15', 'estado' => 'Finalizado', 'responsable' => 'Matias Carrasco', 'monto' => 1000000],
        ['id' => 3, 'nombre' => 'Portal Interno', 'fecha_inicio' => '2026-03-01', 'estado' => 'Pendiente', 'responsable' => 'Martina Olmos', 'monto' => 750000],
    ];

    //Se cargan los datos y obtenemos todos los proyectos
    public static function all(): array {
        if (!Session::has('proyectos')) {
            Session::put('proyectos', self::$proyectosBase);
        }
        return Session::get('proyectos');
    }

    // funcion para buscar un proyecto por su id 
    public static function find(int $id): ?array {
        foreach (self::all() as $p) {
            if ($p['id'] === $id) {
                return $p;
            }
        }
        return null;
    }

    // funcion para agg un nuevo proyecto al array
    public static function create(array $datos): void {
        $proyectos = self::all();
        //calculamos el id nuevo segun el numero de id mas grande q exista en el arrray
        $datos['id'] = count($proyectos) > 0 ? max(array_column($proyectos, 'id')) + 1 : 1;
        $proyectos[] = $datos;
        Session::put('proyectos', $proyectos);
    }

    //actualizamos un proyecto que ya existe por su id 
    public static function update(int $id, array $datos): void {
        $proyectos = self::all();
        foreach ($proyectos as $key => $p) {
            if ($p['id'] === $id) {
                $proyectos[$key] = array_merge($p, $datos);
            }
        }
        Session::put('proyectos', $proyectos);
    }

    //funcion para eliminar un proyecto de la lista por su id
    public static function delete(int $id): void
    {
        $proyectos = array_values(array_filter(self::all(), fn($p) => $p['id'] !== $id));
        Session::put('proyectos', $proyectos);
    }
}
