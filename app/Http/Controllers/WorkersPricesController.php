<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\WorkersPrice;

use App\Models\Worker;

class WorkersPricesController extends Controller
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
		$data['title_page'] = 'Ціни на людські ресурси';
		$data['content'] = 'workers_prices/index';
		$data['breadcrumb'] = [
			'not-active' => 'Довідники',
			'active' => 'Ціни на людські ресурси',
		];

		$data['results'] = WorkersPrice::select('workers_prices.*', 'workers.name')
			->join('workers', 'workers_prices.worker_id', '=', 'workers.id')
			->orderBy('workers.name', 'ASC')
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
		$data['title_page'] = 'Сторінка створення ціни на людський ресурс';
		$data['workers'] = Worker::all();
		$data['content'] = 'workers_prices/form';
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
			return redirect('workers_prices')->with([
				'type' => 'warning',
				'message' => 'Ціна в БД для цього людського ресурсу та року вже створена!',
			]);
		}

		$result = new WorkersPrice();

		$this->set_data($result, $request);

		$result->save();

		return redirect('workers_prices')->with([
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
		$result = WorkersPrice::find($id);

		$data = [];
		$data['page'] = 'edit';
		$data['title_page'] = 'Сторінка редагування ціни на людський ресурс';
		$data['content'] = 'workers_prices/form';
		$data['workers'] = Worker::all();

		if (!$result) {
			return redirect('workers_prices')->with([
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

		$result = WorkersPrice::find($id);

		$this->set_data($result, $request);

		$result->save();

		return redirect('workers_prices')->with([
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
		$result = WorkersPrice::find($id);

		if (!$result) {
			return redirect('workers_prices')->with([
				'type' => 'warning',
				'message' => 'Such a record does not exist!',
			]);
		}

		// $result->delete();

		return redirect('workers_prices')->with([
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
				'worker_id' => 'required',
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
			$result->worker_id = $request->worker_id;
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

	private function is_price($request)
	{
		$price = WorkersPrice::where([
			['worker_id', $request->worker_id],
			['price_year', $request->price_year],
		])
			->get()
			->first();

		return $price;
	}
}
