<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CompleteRenovationObject;
use Illuminate\Http\Request;

use App\Http\Resources\CompleteRenovationObjectResource;


class CompleteRenovationObjectsController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return CompleteRenovationObjectResource::collection(CompleteRenovationObject::paginate());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
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

		$result = new CompleteRenovationObject;

		$this->set_data($result, $request);

		$result->save();

		return new CompleteRenovationObjectResource($result);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		return new CompleteRenovationObjectResource(CompleteRenovationObject::findOrFail($id));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
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

		return $result;
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

		$result->delete();

		return $result;
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
