<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cipher;

use App\Models\Material;
use App\Models\MaterialsPrice;

use App\Models\Worker;
use App\Models\WorkersPrice;

use App\Models\Technic;
use App\Models\TechnicsPrice;

use App\Models\CiphersMaterial;

use App\Models\CiphersWorker;

use App\Models\CiphersTechnic;

use App\Models\TypeService;

class CiphersController extends Controller
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
		$data['title'] = 'Довідник шифрів ремонту';
		$data['page'] = 'index';
		$data['title_page'] = 'Довідник шифрів ремонту';
		$data['content'] = 'ciphers/index';
		$data['script_js'] = 'ciphers/index.js';
		$data['results'] = Cipher::paginate(5);
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
		$data['title_page'] = 'Сторінка шифру ремонту';
		$data['content'] = 'ciphers/form';
		$data['materials'] = Material::all();
		$data['type_services'] = TypeService::all();
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

		$result = new Cipher();

		$this->set_data($result, $request);

		$result->save();

		// $id = $result->getKey();
		// if ($id) {
		//     $this->createCiphersMaterials($id, $request->materials);
		// }

		return redirect('ciphers')->with([
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
		$result = Cipher::find($id);

		$data = [];
		$data['page'] = 'show';
		$data['title_page'] = 'Перегляд запису';
		$data['content'] = 'ciphers/show';

		if (!$result) {
			return redirect('ciphers')->with([
				'type' => 'warning',
				'message' => 'Such a record does not exist!',
			]);
		}

		$data['result'] = $result;
		return view('layouts/admin_layout', $data);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$result = Cipher::find($id);

		$data = [];
		$data['page'] = 'edit';
		$data['title_page'] = 'Сторінка редагування шифру ремонту';
		$data['content'] = 'ciphers/form';

		if (!$result) {
			return redirect('ciphers')->with([
				'type' => 'warning',
				'message' => 'Such a record does not exist!',
			]);
		}

		// Block Of Materials
		$materials = Material::orderBy('name', 'asc')->get();
		$materials_prices = MaterialsPrice::where(
			'price_year',
			date('Y') + 1
		)->get();
		$ciphers_materials = CiphersMaterial::where('cipher_id', $id)->get();

		$total_materials_prices = 0;
		foreach ($materials as $key => $value) {
			$materials[$key]->checked = '';
			$value->quantity = 0;
			foreach ($ciphers_materials as $k => $v) {
				if ($v->material_id == $value->id) {
					$value->checked = 'checked';
					$value->quantity = $v->quantity;
				}
			}

			foreach ($materials_prices as $k => $v) {
				if ($v->material_id == $value->id) {
					$value->price = $v->price;
				}
			}

			$total_materials_prices =
				$total_materials_prices + $value->price * $value->quantity;
		}

		$data['total_materials_prices'] = $total_materials_prices;
		$data['materials'] = $materials;
		// End Block Of Materials

		// Block Of Workers
		$workers = Worker::orderBy('name', 'asc')->get();
		$ciphers_workers = CiphersWorker::where('cipher_id', $id)->get();
		foreach ($workers as $key => $value) {
			$workers[$key]->checked = '';
			$value->quantity = '';
			foreach ($ciphers_workers as $k => $v) {
				if ($v->worker_id == $value->id) {
					$value->checked = 'checked';
					$value->quantity = $v->quantity;
				}
			}
		}
		$data['workers'] = $workers;
		// End Block Of Workers

		// Block Of Technics
		$technics = Technic::orderBy('name', 'asc')->get();
		$ciphers_technics = CiphersTechnic::where('cipher_id', $id)->get();
		foreach ($technics as $key => $value) {
			$technics[$key]->checked = '';
			$value->quantity = '';
			foreach ($ciphers_technics as $k => $v) {
				if ($v->technic_id == $value->id) {
					$value->checked = 'checked';
					$value->quantity = $v->quantity;
				}
			}
		}
		$data['technics'] = $technics;
		// End Block Of Technics

		$data['type_services'] = TypeService::all();
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
		$request->validate($this->rules());

		$result = Cipher::find($id);

		$this->set_data($result, $request);

		$result->save();

		return redirect('ciphers')->with([
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
		$result = Cipher::find($id);

		if (!$result) {
			return redirect('ciphers')->with([
				'type' => 'warning',
				'message' => 'Such a record does not exist!',
			]);
		}

		// $result->delete();

		return redirect('ciphers')->with([
			'type' => 'success',
			'message' => 'Data deleted!',
		]);
	}

	private function is_price($request)
	{
		$price = MaterialsPrice::where([
			['material_id', $request->input('material_id')],
			['price_year', $request->input('price_year')],
		])->get();

		return $price;
	}

	private function get_materials()
	{
		$materials = Material::select('id', 'name')->get();

		return $materials;
	}

	private function get_list_materials($cipher_id)
	{
		$materials = Material::orderBy('name', 'asc')->get();
		$materials_prices = MaterialsPrice::where('price_year', date('Y') + 1)->get();
		$ciphers_materials = CiphersMaterial::where('cipher_id', $cipher_id)->get();

		$total_materials_prices = 0;
		$total_materials_prices_vat = 0;
		foreach ($materials as $key => $value) {
			$value->quantity = 0;
			foreach ($ciphers_materials as $k => $v) {
				if ($v->material_id == $value->id) {
					$value->quantity = (float) $v->quantity;
				}
			}

			$value->price = 0;
			$value->price_vat = 0;
			foreach ($materials_prices as $k => $v) {
				if ($v->material_id == $value->id) {
					$value->price = (float) $v->price;
					$value->price_vat = $v->price * 1.2;
				}
			}

			$value->price_total = $value->price * $value->quantity;

			$total_materials_prices = $total_materials_prices + $value->price * $value->quantity;
			$total_materials_prices_vat = $total_materials_prices_vat + $value->price * $value->quantity * 1.2;


			$value->quantity = number_format($value->quantity, 2, ',', '');
			$value->price = number_format($value->price, 2, ',', ' ');
			$value->price_vat = number_format($value->price_vat, 2, ',', ' ');
			$value->price_total = number_format($value->price_total, 2, ',', ' ');
		}

		$total_materials_prices = number_format($total_materials_prices, 2, ',', ' ');
		$total_materials_prices_vat = number_format($total_materials_prices_vat, 2, ',', ' ');

		return [
			'materials' => $materials,
			'total_materials_prices' => $total_materials_prices,
			'total_materials_prices_vat' => $total_materials_prices_vat
		];
	}

	private function get_list_workers($cipher_id)
	{
		$workers = Worker::orderBy('name', 'asc')->get();
		$workers_prices = WorkersPrice::where('price_year', date('Y') + 1)->get();
		$ciphers_workers = CiphersWorker::where('cipher_id', $cipher_id)->get();

		$total_workers_prices = 0;
		$total_workers_prices_vat = 0;
		foreach ($workers as $key => $value) {
			$value->quantity = 0;
			foreach ($ciphers_workers as $k => $v) {
				if ($v->worker_id == $value->id) {
					$value->quantity = (float) $v->quantity;
				}
			}

			$value->price = 0;
			$value->price_vat = 0;
			foreach ($workers_prices as $k => $v) {
				if ($v->worker_id == $value->id) {
					$value->price = (float) $v->price;
					$value->price_vat = $v->price * 1.2;
				}
			}

			$value->price_total = $value->price * $value->quantity;

			$total_workers_prices = $total_workers_prices + $value->price * $value->quantity;
			$total_workers_prices_vat = $total_workers_prices_vat + $value->price * $value->quantity * 1.2;


			$value->quantity = number_format($value->quantity, 2, ',', '');
			$value->price = number_format($value->price, 2, ',', ' ');
			$value->price_vat = number_format($value->price_vat, 2, ',', ' ');
			$value->price_total = number_format($value->price_total, 2, ',', ' ');
		}

		$total_workers_prices = number_format($total_workers_prices, 2, ',', ' ');
		$total_workers_prices_vat = number_format($total_workers_prices_vat, 2, ',', ' ');

		return [
			'workers' => $workers,
			'total_workers_prices' => $total_workers_prices,
			'total_workers_prices_vat' => $total_workers_prices_vat
		];
	}

	private function get_list_technics($cipher_id)
	{
		$technics = Technic::orderBy('name', 'asc')->get();
		$technics_prices = TechnicsPrice::where('price_year', date('Y') + 1)->get();
		$ciphers_technics = CiphersTechnic::where('cipher_id', $cipher_id)->get();

		$total_technics_prices = 0;
		$total_technics_prices_vat = 0;
		foreach ($technics as $key => $value) {
			$value->quantity = 0;
			foreach ($ciphers_technics as $k => $v) {
				if ($v->technic_id == $value->id) {
					$value->quantity = (float) $v->quantity;
				}
			}

			$value->price = 0;
			$value->price_vat = 0;
			foreach ($technics_prices as $k => $v) {
				if ($v->technic_id == $value->id) {
					$value->price = (float) $v->price;
					$value->price_vat = $v->price * 1.2;
				}
			}

			$value->price_total = $value->price * $value->quantity;

			$total_technics_prices = $total_technics_prices + $value->price * $value->quantity;
			$total_technics_prices_vat = $total_technics_prices_vat + $value->price * $value->quantity * 1.2;


			$value->quantity = number_format($value->quantity, 2, ',', '');
			$value->price = number_format($value->price, 2, ',', ' ');
			$value->price_vat = number_format($value->price_vat, 2, ',', ' ');
			$value->price_total = number_format($value->price_total, 2, ',', ' ');
		}

		$total_technics_prices = number_format($total_technics_prices, 2, ',', ' ');
		$total_technics_prices_vat = number_format($total_technics_prices_vat, 2, ',', ' ');

		return [
			'technics' => $technics,
			'total_technics_prices' => $total_technics_prices,
			'total_technics_prices_vat' => $total_technics_prices_vat
		];
	}

	private function get_ciphers_materials($cipher_id)
	{
		$ciphers_materials = CiphersMaterial::where(
			'cipher_id',
			$cipher_id
		)->get();

		return $ciphers_materials;
	}

	private function get_prices($price_year)
	{
		$prices = MaterialsPrice::where('price_year', $price_year)->get();

		return $prices;
	}

	private function rules()
	{
		$rules = [
			'cipher' => 'required|min:2|max:255',
			'name' => 'required|min:2|max:255',
			'type_service_id' => 'required',
		];
		return $rules;
	}

	private function set_data($result, $request)
	{
		$result->cipher = $request->cipher;
		$result->name = $request->name;
		$result->type_service_id = $request->type_service_id;
		if ($result->id) {
			$result->updated_by = 2;
		} else {
			$result->created_by = 1;
			$result->updated_by = 1;
		}
		return $result;
	}

	public function get_resources_ajax(Request $request)
	{
		if (!$request->all()) {
			return response()->json([
				'status' => 'ERROR',
				'message' => 'Дані не прийшли!',
			]);
		}

		// Block Of Materials
		$result_materials = $this->get_list_materials($request->id);
		// End Block Of Materials

		// Block Of Workers
		$result_workers = $this->get_list_workers($request->id);
		// End Block Of Workers

		// Block Of Technics
		$result_technics = $this->get_list_technics($request->id);
		// End Block Of Technics

		return response()->json([
			'status' => 'SUCCESS',
			'message' => 'Дані отримані!',
			'response' => [
				'result_materials' => $result_materials,
				'result_workers' => $result_workers,
				'result_technics' => $result_technics,
			],
		]);
	}

	public function create_ciphers_materials_ajax(Request $request)
	{
		if (!$request->all()) {
			return response()->json([
				'status' => 'ERROR',
				'message' => 'Дані не прийшли!',
			]);
		}

		$deletedRows = CiphersMaterial::where(
			'cipher_id',
			$request->input('data.0')['cipher_id']
		)->delete();

		foreach ($request->data as $key => $value) {
			$data = new CiphersMaterial();
			$data->cipher_id = $value['cipher_id'];
			$data->material_id = $value['material_id'];
			$data->quantity = $value['quantity'];
			$data->save();
		}
		$materials = $this->get_materials();
		$ciphers_materials = $this->get_ciphers_materials(
			$request->data[0]['cipher_id']
		);
		$prices = $this->get_prices(date('Y') + 1);

		$total_materials_prices = 0;

		foreach ($materials as $key => $value) {
			$value->price = 0;
			$value->quantity = 0;
			foreach ($prices as $k => $v) {
				if ($v->material_id == $value->id) {
					$value->price = $v->price;
				}
			}

			foreach ($ciphers_materials as $k => $v) {
				if ($v->material_id == $value->id) {
					$value->quantity = (int) $v->quantity;
				}
			}

			$total_materials_prices =
				$total_materials_prices + $value->price * $value->quantity;
		}

		return response()->json([
			'status' => 'SUCCESS',
			'message' => 'Дані оновлено!',
			'response' => $materials,
			'total_materials_prices' => $total_materials_prices,
		]);
	}

	public function create_ciphers_workers_ajax(Request $request)
	{
		if (!$request->all()) {
			return response()->json([
				'status' => 'ERROR',
				'message' => 'Дані не прийшли!',
			]);
		}

		$deletedRows = CiphersWorker::where(
			'cipher_id',
			$request->input('data.0')['cipher_id']
		)->delete();

		foreach ($request->input('data') as $key => $value) {
			$data = new CiphersWorker();
			$data->cipher_id = $value['cipher_id'];
			$data->worker_id = $value['worker_id'];
			$data->quantity = $value['quantity'];
			$data->save();
		}

		return response()->json([
			'status' => 'SUCCESS',
			'message' => 'Дані оновлено!',
		]);
	}

	public function create_ciphers_technics_ajax(Request $request)
	{
		if (!$request->all()) {
			return response()->json([
				'status' => 'ERROR',
				'message' => 'Дані не прийшли!',
			]);
		}

		$deletedRows = CiphersTechnic::where(
			'cipher_id',
			$request->input('data.0')['cipher_id']
		)->delete();

		foreach ($request->input('data') as $key => $value) {
			$data = new CiphersTechnic();
			$data->cipher_id = $value['cipher_id'];
			$data->technic_id = $value['technic_id'];
			$data->quantity = $value['quantity'];
			$data->save();
		}

		return response()->json([
			'status' => 'SUCCESS',
			'message' => 'Дані оновлено!',
		]);
	}
}
