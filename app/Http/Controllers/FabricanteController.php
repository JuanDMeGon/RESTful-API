<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Fabricante;

class FabricanteController extends Controller {

	public function __construct()
	{
		$this->middleware('auth.basic', ['only' => ['store', 'update', 'destroy']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return response()->json(['datos' => Fabricante::all()],200);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(!$request->input('nombre') || ! $request->input('telefono'))
		{
			return response()->json(['mensaje' => 'No se pudieron procesar los valores', 'codigo' => 422],422);
		}
		Fabricante::create($request->all());
		return response()->json(['mensaje' => 'Fabricante insertado'],201);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$fabricante = Fabricante::find($id);

		if(!$fabricante)
		{
			return response()->json(['mensaje' => 'No se encuentra este fabricante', 'codigo' => 404],404);
		}

		return response()->json(['datos' => $fabricante],200);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$metodo = $request->method();
		$fabricante = Fabricante::find($id);

		if(!$fabricante)
		{
			return response()->json(['mensaje' => 'No se encuentra este fabricante', 'codigo' => 404],404);
		}

		if($metodo === 'PATCH')
		{
			$bandera = false;
			$nombre = $request->input('nombre');

			if($nombre != null && $nombre != '')
			{
				$fabricante->nombre = $nombre;
				$bandera = true;
			}

			$telefono = $request->input('telefono');

			if($telefono != null && $telefono != '')
			{
				$fabricante->telefono = $telefono;
				$bandera = true;
			}

			if($bandera)
			{
				$vehiculo->save();

				return response()->json(['mensaje' => 'Vehiculo editado'],200);
			}

			return response()->json(['mensaje' => 'No se modificó ningun vehiculo'],200);
		}

		$nombre = $request->input('nombre');
		$telefono = $request->input('telefono');
		if(!$nombre || !$telefono)
		{
			return response()->json(['mensaje' => 'No se pudieron procesar los valores', 'codigo' => 422],422);
		}
		$fabricante->nombre = $nombre;
		$fabricante->telefono = $telefono;

		$fabricante->save();


		return response()->json(['mensaje' => 'Fabricante editado'],200);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$fabricante = Fabricante::find($id);

		if(!$fabricante)
		{
			return response()->json(['mensaje' => 'No se encuentra este fabricante', 'codigo' => 404],404);
		}

		$vehiculos = $fabricante->vehiculos;

		if(sizeof($vehiculos) > 0)
		{
			return response()->json(['mensaje' => 'Este fabricante posee vehiculos asociados y no puede ser eliminado. Eliminar primero sus vehiculos.', 'codigo' => 409],409);
		}

		$fabricante->delete();

		return response()->json(['mensaje' => 'Fabricante eliminado'],200);
	}


}
