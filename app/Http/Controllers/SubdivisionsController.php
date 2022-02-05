<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Subdivision;

class SubdivisionsController extends Controller
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
		$data['title_page'] = 'Довідник підрозділів';
		$data['content'] = 'subdivisions/index';
		$data['breadcrumb'] = [
			'not-active' => 'Довідники',
			'active' => 'Підрозділи',
		];
		$data['results'] = Subdivision::paginate(5);
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
		$data['title_page'] = 'Сторінка створення підрозділу';
		$data['content'] = 'subdivisions/form';
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

		$result = new Subdivision();

		$this->set_data($result, $request);

		$result->save();

		return redirect('subdivisions')->with([
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
		$result = Subdivision::find($id);

		$data = [];
		$data['page'] = 'show';
		$data['title_page'] = 'Перегляд запису';
		$data['content'] = 'subdivisions/show';

		if (!$result) {
			return redirect('subdivisions')->with([
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
		$result = Subdivision::find($id);

		$data = [];
		$data['page'] = 'edit';
		$data['title_page'] = 'Сторінка редагування підрозділу';
		$data['content'] = 'subdivisions/form';

		if (!$result) {
			return redirect('subdivisions')->with([
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

		$result = Subdivision::find($id);

		$this->set_data($result, $request);

		$result->save();

		return redirect('subdivisions')->with([
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
		$result = Subdivision::find($id);

		if (!$result) {
			return redirect('subdivisions')->with([
				'type' => 'warning',
				'message' => 'Such a record does not exist!',
			]);
		}

		// $result->delete();

		return redirect('subdivisions')->with([
			'type' => 'success',
			'message' => 'Data deleted!',
		]);
	}

	private function rules()
	{
		$rules = [
			'name' => 'required|min:2|max:255',
		];
		return $rules;
	}

	private function set_data($result, $request)
	{
		$result->name = $request->name;
		if ($result->id) {
			$result->updated_by = 2;
		} else {
			$result->created_by = 1;
			$result->updated_by = 1;
		}
		return $result;
	}
}
