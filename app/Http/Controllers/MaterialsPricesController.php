<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MaterialsPrice;

use App\Models\Material;

// use App\Models\CiphersMaterial;

class MaterialsPricesController extends Controller
{
	public function __construct()
	{
		// $this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$data = [];
		$data['page'] = 'index';
		$data['title_page'] = 'Ціни на матеріальні ресурси';
		$data['content'] = 'materials_prices/index';
		$data['breadcrumb'] = [
			'not-active' => 'Довідники',
			'active' => 'Ціни на матеріальні ресурси',
		];

		$data['results'] = MaterialsPrice::select('materials_prices.*', 'materials.name')
			->join('materials', 'materials_prices.material_id', '=', 'materials.id')
			->orderBy('materials.name', 'ASC')
			->paginate(10);
		// dd($data['results']->toArray());
		return view('layouts/admin_layout', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$data = [];
		$data['page'] = 'create';
		$data['title_page'] = 'Сторінка створення ціни на матеріальний ресурс';
		$data['materials'] = Material::all();
		$data['content'] = 'materials_prices/form';
		return view('layouts/admin_layout', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$request->validate($this->rules());

		// Перевіряємо наявність запису в БД
		$prices = $this->is_price($request);

		if ($prices) {
			return redirect('materials_prices')->with([
				'type' => 'warning',
				'message' => 'Ціна в БД для цього матеріального ресурсу та року вже створена!',
			]);
		}

		$result = new MaterialsPrice();

		$this->set_data($result, $request);

		$result->save();

		return redirect('materials_prices')->with([
			'type' => 'success',
			'message' => 'Дані створено!',
		]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		echo 'show_page';
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$result = MaterialsPrice::find($id);

		$data = [];
		$data['page'] = 'edit';
		$data['title_page'] = 'Сторінка редагування ціни на матеріальний ресурс';
		$data['content'] = 'materials_prices/form';
		$data['materials'] = Material::all();

		if (!$result) {
			return redirect('materials_prices')->with([
				'type' => 'warning',
				'message' => 'Such a record does not exist!',
			]);
		}

		$data['result'] = $result;
		return view('layouts/admin_layout', $data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$request->validate($this->rules($request->method()));

		$result = MaterialsPrice::find($id);

		$this->set_data($result, $request);

		$result->save();

		return redirect('materials_prices')->with([
			'type' => 'success',
			'message' => 'Дані змінено!',
		]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$result = MaterialsPrice::find($id);

		if (!$result) {
			return redirect('materials_prices')->with([
				'type' => 'warning',
				'message' => 'Such a record does not exist!',
			]);
		}

		// $result->delete();

		return redirect('materials_prices')->with([
			'type' => 'success',
			'message' => 'Data deleted!',
		]);
	}

	private function rules($method = NULL)
	{
		if ($method === 'PUT') {
			$rules = [
				'price' => 'required|numeric',
			];
		} else {
			$rules = [
				'material_id' => 'required',
				'price' => 'required|numeric',
				'price_year' => 'required|min:4|max:4|date_format:Y',
			];
		}
		return $rules;
	}

	private function set_data($result, $request)
	{
		if ($request->method() === 'PUT') {
			$result->price = $request->price;
		} else {
			$result->material_id = $request->material_id;
			$result->price = $request->price;
			$result->price_year = $request->price_year;
		}
		if ($result->id) {
			$result->updated_by = 2;
		} else {
			$result->created_by = 1;
			$result->updated_by = 1;
		}
		return $result;
	}

	public function create_tabular()
	{
		$data = [];
		$data['page'] = 'create';
		$data['title_page'] = 'Сторінка створення цін на матеріальні ресурси';
		$data['materials'] = Material::all();
		$data['content'] = 'materials_prices/form_tabular';
		return view('layouts/admin_layout', $data);
	}

	public function store_tabular(Request $request)
	{

		$out_array = [];
		foreach ($request->except(['_token', '_method']) as $key => $value) {
			foreach ($value as $k => $v) {
				$out_array[$k][$key] = $v;
				$out_array[$k]['created_by'] = 1;
				$out_array[$k]['updated_by'] = 1;
				$out_array[$k]['created_at'] = date('Y-m-d H:i:s');
				$out_array[$k]['updated_at'] = date('Y-m-d H:i:s');
			}
		}

		$result = new MaterialsPrice();

		$result->insert($out_array);

		return redirect('materials_prices')->with([
			'type' => 'success',
			'message' => 'Дані створено!',
		]);
	}

	public function edit_tabular()
	{
		echo 'edit_tabular()';
	}

	public function update_tabular()
	{
		echo 'update_tabular()';
	}

	private function is_price($request)
	{
		$price = MaterialsPrice::where([
			['material_id', $request->material_id],
			['price_year', $request->price_year],
		])
			->get()
			->first();

		return $price;
	}

	// public function store_price(Request $request)
	// {
	// $is_price = $this->is_price($request);

	// if (count($is_price)) {
	//     return response()->json([
	//         'status' => 'ERROR',
	//         'message' =>
	//             'Дані для цього матеріального ресурсу та року ціна в БД існує!',
	//     ]);
	// }

	// $request->validate($this->rules());

	// $result = new MaterialsPrice();

	// $this->set_data($result, $request);

	// $result->save();

	// $prices = $this->get_prices($request->input('price_year'));
	// $materials = $this->get_materials();
	// $ciphers_materials = $this->get_ciphers_materials(
	//     $request->input('cipher_id')
	// );

	// $total_materials_prices = 0;
	// foreach ($materials as $key => $value) {
	//     $value->price = 0;
	//     foreach ($prices as $k => $v) {
	//         if ($v->material_id == $value->id) {
	//             $value->price = $v->price;
	//         }
	//     }

	//     foreach ($ciphers_materials as $k => $v) {
	//         if ($v->material_id == $value->id) {
	//             $value->quantity = (int) $v->quantity;
	//         }
	//     }

	//     $total_materials_prices =
	//         $total_materials_prices + $value->price * $value->quantity;
	// }

	// return response()->json([
	//     'status' => 'SUCCESS',
	//     'message' => 'Дані створено!',
	//     'result' => $materials,
	//     'total_materials_prices' => $total_materials_prices,
	// ]);
	// }

	// private function get_materials()
	// {
	//     $materials = Material::select('id', 'name')->get();

	//     return $materials;
	// }

	// private function get_ciphers_materials($cipher_id)
	// {
	//     $ciphers_materials = CiphersMaterial::where(
	//         'cipher_id',
	//         $cipher_id
	//     )->get();

	//     return $ciphers_materials;
	// }

	// private function get_prices($price_year)
	// {
	//     $prices = MaterialsPrice::where('price_year', $price_year)->get();

	//     return $prices;
	// }
}
