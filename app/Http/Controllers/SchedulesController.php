<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Schedule;

class SchedulesController extends Controller
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
		$data['title_page'] = 'Графіки ремонтів';
		$data['content'] = 'schedules/index';
		$data['breadcrumb'] = [
			'active' => 'Графіки ремонтів',
		];
		$data['results'] = Schedule::select('schedules.*', 'specific_renovation_objects.name as specific_renovation_object_name', 'type_services.name as type_service_name')
			->join('specific_renovation_objects', 'specific_renovation_objects.id', '=', 'schedules.specific_renovation_object_id')
			->join('type_services', 'type_services.id', '=', 'schedules.type_service_id')
			// ->where('schedules.type_service_id', 1)
			->orderBy('specific_renovation_objects.name', 'ASC')
			->orderBy('type_services.name', 'ASC')
			->paginate(5);
		// ->get();
		return view('layouts/admin_layout', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return;
		$data = [];
		$data['page'] = 'create';
		$data['title_page'] = 'Сторінка створення графіку ремонтів';
		$data['content'] = 'schedules/form';
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

		$result = new Schedule();

		$this->set_data($result, $request);

		$result->save();

		return redirect('schedules')->with([
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
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$result = Schedule::find($id);

		$data = [];
		$data['page'] = 'edit';
		$data['title_page'] = 'Сторінка редагування графіку ремонтів';
		$data['content'] = 'schedules/form';

		if (!$result) {
			return redirect('schedules')->with([
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
		$request->validate($this->rules());

		$result = Schedule::find($id);

		$this->set_data($result, $request);

		$result->save();

		return redirect('schedules')->with([
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
		$result = Schedule::find($id);

		if (!$result) {
			return redirect('schedules')->with([
				'type' => 'warning',
				'message' => 'Such a record does not exist!',
			]);
		}

		// $result->delete();

		return redirect('schedules')->with([
			'type' => 'success',
			'message' => 'Data deleted!',
		]);
	}

	private function rules()
	{
		$rules = [
			'periodicity' => 'required|integer',
			'date_last_service' => 'required',
		];
		return $rules;
	}

	private function set_data($result, $request)
	{
		$result->periodicity = $request->periodicity;
		$result->date_last_service = $request->date_last_service;
		$result->status = $request->status === 'on' ? 1 : 0;
		if ($result->id) {
			$result->updated_by = 2;
		} else {
			$result->created_by = 1;
			$result->updated_by = 1;
		}
		return $result;
	}
}
