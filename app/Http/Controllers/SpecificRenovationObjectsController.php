<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SpecificRenovationObject;

use App\Models\Subdivision;

use App\Models\CompleteRenovationObject;

use App\Models\Equipment;

use App\Models\TypeService;

use App\Models\Schedule;

use App\Models\Place;

use App\Models\Passport;

class SpecificRenovationObjectsController extends Controller
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
		$data['title'] = 'Довідник об`єктів ремонту';
		$data['page'] = 'index';
		$data['title_page'] = 'Довідник об`єктів ремонту';
		$data['content'] = 'specific_renovation_objects/index';
		$specific_renovation_objects = SpecificRenovationObject::select(
			'specific_renovation_objects.*'
		)
			// ->join('subdivisions', 'subdivisions.id', '=', 'specific_renovation_objects.subdivision_id')
			->join(
				'complete_renovation_objects',
				'complete_renovation_objects.id',
				'=',
				'specific_renovation_objects.complete_renovation_object_id'
			)
			->join(
				'equipments',
				'equipments.id',
				'=',
				'specific_renovation_objects.equipment_id'
			)
			// ->orderBy('subdivisions.name', 'ASC')
			->orderBy('complete_renovation_objects.name', 'ASC')
			->orderBy('equipments.name', 'ASC')
			->orderBy('name', 'ASC')
			->paginate(7);

		foreach ($specific_renovation_objects as $key => $value) {
			$schedules = Schedule::select(
				'schedules.*',
				'type_services.name',
				'type_services.short_name'
			)
				->join(
					'type_services',
					'type_services.id',
					'=',
					'schedules.type_service_id'
				)
				->where('specific_renovation_object_id', $value->id)
				->where('status', 1)
				->orderBy('type_service_id')
				->get();

			$type_service = [];
			$value->type_service = $type_service;
			foreach ($schedules as $k => $v) {
				if ($value->id == $v->specific_renovation_object_id) {
					if ($v->type_service_id == 1) {
						$type_service_color = 'success';
					} elseif ($v->type_service_id == 2) {
						$type_service_color = 'primary';
					} elseif ($v->type_service_id == 3) {
						$type_service_color = 'warning';
					}
					array_push($type_service, [
						'type_service_full' => $v->name,
						'type_service_short' => $v->short_name,
						'type_service_color' => $type_service_color,
					]);
					$value->type_service = $type_service;
				}
			}

			$passports = Passport::select('passports.*', 'places.name')
				->join('places', 'places.id', '=', 'passports.place_id')
				->where('specific_renovation_object_id', $value->id)
				->orderBy('places.name')
				->get();

			$places = [];
			$value->places = $places;
			foreach ($passports as $k => $v) {
				if ($value->id == $v->specific_renovation_object_id) {
					if ($v->place_id == 1) {
						$place_color = 'warning';
					} elseif ($v->place_id == 2) {
						$place_color = 'success';
					} elseif ($v->place_id == 3) {
						$place_color = 'danger';
					} else {
						$place_color = 'primary';
					}
					array_push($places, [
						'place_name' => $v->name,
						'place_color' => $place_color,
						'type' => $v->type,
						'number' => $v->number,
						'production_date' => $v->production_date,
					]);
					$value->places = $places;
				}
			}
		}

		$data['results'] = $specific_renovation_objects;
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
		$data['title_page'] = 'Сторінка створення об`єкту ремонту';
		$data['content'] = 'specific_renovation_objects/form';
		$data['subdivisions'] = Subdivision::all('id', 'name');
		$data['complete_renovation_objects'] = CompleteRenovationObject::all(
			'id',
			'name'
		);
		$data['equipments'] = Equipment::all('id', 'name');
		$data['places'] = Place::all('id', 'name');
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

		$result = new SpecificRenovationObject();

		$this->set_data($result, $request);

		$result->save();

		$specific_renovation_object_id = $result->getKey();

		if (!$specific_renovation_object_id) {
			return redirect('specific_renovation_objects')->with([
				'type' => 'danger',
				'message' => 'Щось пішло не так!',
			]);
		}

		$type_services = TypeService::all();

		foreach ($type_services as $item) {
			$result = new Schedule();
			$result->specific_renovation_object_id = $specific_renovation_object_id;
			$result->type_service_id = $item->id;
			$result->created_by = 1;
			$result->updated_by = 1;

			$result->save();
		}

		foreach ($request->place as $item) {
			$result = new Passport();
			$result->subdivision_id = $request->subdivision_id;
			$result->complete_renovation_object_id =
				$request->complete_renovation_object_id;
			$result->specific_renovation_object_id = $specific_renovation_object_id;
			$result->place_id = $item;
			$result->created_by = 1;
			$result->updated_by = 1;

			$result->save();
		}

		return redirect('specific_renovation_objects')->with([
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
		$result = SpecificRenovationObject::find($id);

		$data = [];
		$data['page'] = 'edit';
		$data['title_page'] = 'Сторінка редагування об`єкту ремонту';
		$data['content'] = 'specific_renovation_objects/form';
		$data['script_js'] = 'specific_renovation_objects/edit.js';
		$data['subdivisions'] = Subdivision::all('id', 'name');
		$data['complete_renovation_objects'] = CompleteRenovationObject::all(
			'id',
			'name'
		);

		$equipments = Equipment::all('id', 'name');

		$type_services = TypeService::all();
		$schedules = Schedule::where(
			'specific_renovation_object_id',
			$id
		)->get();
		foreach ($type_services as $key => $value) {
			$value->checked = '';
			$value->periodicity = null;
			$value->date_last_service = null;
			$value->schedule_id = '';
			$value->specific_renovation_object_id = '';
			$value->type_service_id = '';
			$value->is_schedule = false;
			foreach ($schedules as $k => $v) {
				if ($value->id == $v->type_service_id) {
					$value->schedule_id = $v->id;
					$value->specific_renovation_object_id =
						$v->specific_renovation_object_id;
					$value->type_service_id = $v->type_service_id;
					$value->periodicity = $v->periodicity;
					$value->date_last_service = $v->date_last_service;
					$value->is_schedule = true;
				}

				if ($value->id == $v->type_service_id && $v->status == 1) {
					$value->checked = 'checked';
				}
			}
		}
		$places = Place::all();
		$passports = Passport::where(
			'specific_renovation_object_id',
			$id
		)->get();
		foreach ($places as $key => $value) {
			$value->checked = '';
			$value->passport_id = '';
			foreach ($passports as $k => $v) {
				if ($value->id == $v->place_id) {
					$value->checked = 'checked';
					$value->passport_id = $v->id;
				}
			}
		}

		$data['equipments'] = $equipments;
		$data['type_services'] = $type_services;
		$data['places'] = $places;
		if (!$result) {
			return redirect('specific_renovation_objects')->with([
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

		$result = SpecificRenovationObject::find($id);

		$this->set_data($result, $request);

		$result->save();

		return redirect('specific_renovation_objects')->with([
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
		$result = SpecificRenovationObject::find($id);

		if (!$result) {
			return redirect('specific_renovation_objects')->with([
				'type' => 'warning',
				'message' => 'Such a record does not exist!',
			]);
		}

		// $result->delete();

		return redirect('specific_renovation_objects')->with([
			'type' => 'success',
			'message' => 'Data deleted!',
		]);
	}

	private function rules()
	{
		$rules = [
			'subdivision_id' => 'required',
			'complete_renovation_object_id' => 'required',
			'name' => 'required|min:2|max:255',
			'year_commissioning' => 'nullable|min:4|max:4|date_format:Y',
			'equipment_id' => 'required',
		];
		return $rules;
	}

	private function set_data($result, $request)
	{
		$result->subdivision_id = $request->subdivision_id;
		$result->complete_renovation_object_id =
			$request->complete_renovation_object_id;
		$result->name = $request->name;
		$result->year_commissioning = $request->year_commissioning;
		$result->equipment_id = $request->equipment_id;
		if ($result->id) {
			$result->updated_by = 2;
		} else {
			$result->created_by = 1;
			$result->updated_by = 1;
		}
		return $result;
	}

	public function add_schedule_ajax(Request $request)
	{
		if (!$request->all()) {
			return response()->json([
				'status' => 'ERROR',
				'message' => 'Дані не прийшли!',
				'color' => 'error',
			]);
		}

		if ($request->checked === 'true') {
			// $result = new Schedule();
			// $result->specific_renovation_object_id = $request->specific_renovation_object_id;
			// $result->type_service_id = $request->type_service_id;
			// $result->created_by = 1;
			// $result->updated_by = 1;
			// $result->save();

			return response()->json([
				'status' => 'SUCCESS',
				'message' => 'Дані додані!',
				'color' => 'success',
			]);
		} else {
			// $result = new Schedule();
			// $result->where('specific_renovation_object_id', $request->specific_renovation_object_id)->where('type_service_id', $request->type_service_id)->delete();

			return response()->json([
				'status' => 'SUCCESS',
				'message' => 'Дані видалені!',
				'color' => 'error',
			]);
		}
	}

	public function add_passport_ajax(Request $request)
	{
		if (!$request->all()) {
			return response()->json([
				'status' => 'ERROR',
				'message' => 'Дані не прийшли!',
				'color' => 'error',
			]);
		}

		$result = new Passport();
		$result->subdivision_id = $request->subdivision_id;
		$result->complete_renovation_object_id =
			$request->complete_renovation_object_id;
		$result->specific_renovation_object_id =
			$request->specific_renovation_object_id;
		$result->place_id = $request->place_id;
		$result->created_by = 1;
		$result->updated_by = 1;
		$result->save();

		$passport_id = $result->getKey();

		if ($passport_id) {
			return response()->json([
				'status' => 'SUCCESS',
				'message' => 'Дані додані!',
				'color' => 'success',
			]);
		}
	}

	public function update_status_schedule_ajax(Request $request)
	{
		if (!$request->all()) {
			return response()->json([
				'status' => 'ERROR',
				'message' => 'Дані не прийшли!',
				'color' => 'error',
			]);
		}

		$result = Schedule::find($request->schedule_id);
		$result->status = $request->status;
		$result->updated_by = 2;
		$result->save();

		if ($result) {
			return response()->json([
				'status' => 'SUCCESS',
				'message' => 'Дані змінено!',
				'color' => 'success',
			]);
		} else {
			return response()->json([
				'status' => 'ERROR',
				'message' => 'Щось пішло не так!',
				'color' => 'error',
			]);
		}
	}
}
