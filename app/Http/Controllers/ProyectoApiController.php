<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class ProyectoApiController extends Controller
{    
    #[OA\Get(
        path: '/api/proyectos',
        summary: 'Obtener lista de todos los proyectos',
        tags: ['Proyectos'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Lista de proyectos obtenida con exito'
            )
        ]
    )]
    public function index(){
        $proyectos = Proyecto::orderBy('created_at', 'desc')->get();
        return response()->json($proyectos, 200);
    }
    #[OA\Post(
        path: '/api/proyectos',
        summary: 'Crear un nuevo proyecto',
        tags: ['Proyectos'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['nombre', 'fecha_inicio', 'estado', 'responsable', 'monto'],
                properties: [
                    new OA\Property(property: 'nombre', type: 'string', example: 'Sistema de Inventario'),
                    new OA\Property(property: 'fecha_inicio', type: 'string', format: 'date', example: '2026-08-20'),
                    new OA\Property(property: 'estado', type: 'string', example: 'Pendiente'),
                    new OA\Property(property: 'responsable', type: 'string', example: 'Keyla Mendoza'),
                    new OA\Property(property: 'monto', type: 'integer', example: 750000),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'Proyecto creado exitosamente'
            ),
            new OA\Response(
                response: 422,
                description: 'Datos de validacion incorrectos'
            )
        ]
    )]
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:150|regex:/^[\pL\s]+$/u',
            'fecha_inicio' => 'required|date|after_or_equal:2020-01-01|before_or_equal:2035-12-31',
            'estado' => 'required|string|in:Pendiente,En curso,Finalizado',
            'responsable' => 'required|string|max:150|regex:/^[\pL\s]+$/u',
            'monto' => 'required|integer|min:1',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.',
            'responsable.required' => 'El responsable es obligatorio.',
            'responsable.regex' => 'El responsable solo puede contener letras y espacios.',
            'monto.required' => 'El monto es obligatorio.',
            'monto.integer' => 'El monto debe ser un numero.',
            'monto.min' => 'El monto debe ser mayor que cero.',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_inicio.date' => 'La fecha de inicio debe ser una fecha valida.',
            'fecha_inicio.after_or_equal' => 'La fecha de inicio no puede ser anterior a 2020.',
            'fecha_inicio.before_or_equal' => 'La fecha de inicio no puede ser posterior a 2035.',
            'estado.required' => 'El estado es obligatorio.',
            'estado.in' => 'El estado debe ser Pendiente, En curso o Finalizado (La primera letra en mayusculas).',
        ]);
        $validated['created_by'] = auth('api')->id();
        $proyecto = Proyecto::create($validated);
        return response()->json($proyecto, 201);
    }
    #[OA\Get(
        path: '/api/proyectos/{id}',
        summary: 'Obtener un proyecto por ID',
        tags: ['Proyectos'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                description: 'ID del proyecto',
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Detalle del proyecto'
            ),
            new OA\Response(
                response: 404,
                description: 'Proyecto no encontrado'
            )
        ]
    )]
    public function show($id)
    {
        $proyecto = Proyecto::find($id);
        if (!$proyecto) {
            return response()->json([
                'message' => 'Proyecto no encontrado',
            ], 404);
        }
        return response()->json($proyecto, 200);
    }
    #[OA\Put(
        path: '/api/proyectos/{id}',
        summary: 'Actualizar un proyecto existente',
        tags: ['Proyectos'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                description: 'ID del proyecto a actualizar',
                schema: new OA\Schema(type: 'integer')
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['nombre', 'fecha_inicio', 'estado', 'responsable', 'monto'],
                properties: [
                    new OA\Property(property: 'nombre', type: 'string', example: 'Sistema de Inventario Actualizado'),
                    new OA\Property(property: 'fecha_inicio', type: 'string', format: 'date', example: '2026-08-20'),
                    new OA\Property(property: 'estado', type: 'string', example: 'En curso'),
                    new OA\Property(property: 'responsable', type: 'string', example: 'Keyla Mendoza'),
                    new OA\Property(property: 'monto', type: 'integer', example: 900000),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Proyecto actualizado exitosamente'
            ),
            new OA\Response(
                response: 404,
                description: 'Proyecto no encontrado'
            ),
            new OA\Response(
                response: 422,
                description: 'Datos de validacion incorrectos'
            )
        ]
    )]
    public function update(Request $request, $id)
    {
        $proyecto = Proyecto::find($id);
        if (!$proyecto) {
            return response()->json([
                'message' => 'Proyecto no encontrado',
            ], 404);
        }
        $validated = $request->validate([
            'nombre' => 'required|string|max:150|regex:/^[\pL\s]+$/u',
            'fecha_inicio' => 'required|date|after_or_equal:2020-01-01|before_or_equal:2035-12-31',
            'estado' => 'required|string|in:Pendiente,En curso,Finalizado',
            'responsable' => 'required|string|max:150|regex:/^[\pL\s]+$/u',
            'monto' => 'required|integer|min:1',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.',
            'responsable.required' => 'El responsable es obligatorio.',
            'responsable.regex' => 'El responsable solo puede contener letras y espacios.',
            'monto.required' => 'El monto es obligatorio.',
            'monto.integer' => 'El monto debe ser un numero.',
            'monto.min' => 'El monto debe ser mayor que cero.',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_inicio.date' => 'La fecha de inicio debe ser una fecha valida.',
            'fecha_inicio.after_or_equal' => 'La fecha de inicio no puede ser anterior a 2020.',
            'fecha_inicio.before_or_equal' => 'La fecha de inicio no puede ser posterior a 2035.',
            'estado.required' => 'El estado es obligatorio.',
            'estado.in' => 'El estado debe ser Pendiente, En curso o Finalizado (La primera letra en mayusculas).',
        ]);
        $proyecto->update($validated);
        return response()->json($proyecto, 200);
    }
    #[OA\Delete(
        path: '/api/proyectos/{id}',
        summary: 'Eliminar un proyecto por ID',
        tags: ['Proyectos'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                description: 'ID del proyecto a eliminar',
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(
                response: 204,
                description: 'Proyecto eliminado exitosamente'
            ),
            new OA\Response(
                response: 404,
                description: 'Proyecto no encontrado'
            )
        ]
    )]
    public function destroy($id)
    {
        $proyecto = Proyecto::find($id);
        if (!$proyecto) {
            return response()->json([
                'message' => 'Proyecto no encontrado',
            ], 404);
        }
        $proyecto->delete();
        return response()->noContent();
    }
}