<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CompleteRenovationObject;

use App\Models\Subdivision;

class CompleteRenovationObjectsController extends Controller
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
		$data['title_page'] = 'Довідник загальних об`єктів ремонту';
		$data['content'] = 'complete_renovation_objects/index';
		$data['breadcrumb'] = [
			'not-active' => 'Довідники',
			'active' => 'Об`єкти',
		];
		$data['results'] = CompleteRenovationObject::paginate(5);
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
		$data['title_page'] = 'Сторінка створення загального об`єкту ремонту';
		$data['content'] = 'complete_renovation_objects/form';
		$data['subdivisions'] = Subdivision::all('id', 'name');
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

		$result = new CompleteRenovationObject();

		$this->set_data($result, $request);

		$result->save();

		return redirect('complete_renovation_objects')->with([
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
		$result = CompleteRenovationObject::find($id);

		$data = [];
		$data['page'] = 'show';
		$data['title_page'] = 'Перегляд запису';
		$data['content'] = 'complete_renovation_objects/show';

		if (!$result) {
			return redirect('complete_renovation_objects')->with([
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
		$result = CompleteRenovationObject::find($id);

		$data = [];
		$data['page'] = 'edit';
		$data['title_page'] = 'Сторінка редагування загального об`єкту ремонту';
		$data['content'] = 'complete_renovation_objects/form';
		$data['subdivisions'] = Subdivision::all('id', 'name');

		if (!$result) {
			return redirect('complete_renovation_objects')->with([
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

		$result = CompleteRenovationObject::find($id);

		$this->set_data($result, $request);

		$result->save();

		return redirect('complete_renovation_objects')->with([
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
		$result = CompleteRenovationObject::find($id);

		if (!$result) {
			return redirect('complete_renovation_objects')->with([
				'type' => 'warning',
				'message' => 'Such a record does not exist!',
			]);
		}

		// $result->delete();

		return redirect('complete_renovation_objects')->with([
			'type' => 'success',
			'message' => 'Data deleted!',
		]);
	}

	private function rules()
	{
		$rules = [
			'subdivision_id' => 'required',
			'name' => 'required|min:2|max:255',
			'year_commissioning' => 'nullable|min:4|max:4|date_format:Y',
		];
		return $rules;
	}

	private function set_data($result, $request)
	{
		$result->subdivision_id = $request->subdivision_id;
		$result->name = $request->name;
		$result->year_commissioning = $request->year_commissioning;
		if ($result->id) {
			$result->updated_by = 2;
		} else {
			$result->created_by = 1;
			$result->updated_by = 1;
		}
		return $result;
	}
}
