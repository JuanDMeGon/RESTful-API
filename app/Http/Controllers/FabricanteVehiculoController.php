<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Fabricante;
use App\Vehiculo;

class FabricanteVehiculoController extends Controller {

	public function __construct()
	{
		$this->middleware('auth.basic', ['only' => ['store', 'update', 'destroy']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id)
	{
		$fabricante = Fabricante::find($id);

		if(!$fabricante)
		{
			return response()->json(['mensaje' => 'No se encuentra este fabricante', 'codigo' => 404],404);
		}

		return response()->json(['datos' => $fabricante->vehiculos],200);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id)
	{
		return 'mostrando formulario para agregar vehiculo al fabricante '. $id;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request, $id)
	{
		//fabricante_id
		//serie (auntoincrement) no se necesita
		//color
		//cilindraje
		//potencia
		//peso
		if(!$request->input('color') || !$request->input('cilindraje') || !$request->input('potencia') || !$request->input('potencia') || !$request->input('peso'))
		{
			return response()->json(['mensaje' => 'No se pudieron procesar los valores', 'codigo' => 422],422);
		}

		$fabricante = Fabricante::find($id);

		if(!$fabricante)
		{
			return response()->json(['mensaje' => 'No existe el fabricante asociado', 'codigo' => 404],404);
		}

		$fabricante->vehiculos()->create($request->all());

		return response()->json(['mensaje' => 'Vehiculo insertado'],201);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($idFabricante, $idVehiculo)
	{
		return "mostrando el vehiculo $idVehiculo del fabricante $idFabricante";
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($idFabricante, $idVehiculo)
	{
		return "Mostrando formulario para editar el vahiculo $idVehiculo del fabricante $idFabricante";
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($idFabricante, $idVehiculo)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($idFabricante, $idVehiculo)
	{
		//
	}

}
