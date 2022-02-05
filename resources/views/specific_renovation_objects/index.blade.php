<div class="row">
	<div class="col-lg-12">
		<div class="card mb-3">
			<h3 class="card-header text-primary">Об`єкти ремонту
				<div class="card-widgets">
					<a href="javascript:;" data-bs-toggle="reload"><i class="mdi mdi-refresh"></i></a>
					<a data-bs-toggle="collapse" href="#cardCollpase" role="button" aria-expanded="false" aria-controls="cardCollpase1"><i class="mdi mdi-minus"></i></a>
					<a href="#" data-bs-toggle="remove"><i class="mdi mdi-close"></i></a>
				</div>
			</h3>
			<div class="card-body">
				<div id="cardCollpase" class="collapse show">
					<div class="row mb-2">
						<div class="col-lg-12">
							<a href="/specific_renovation_objects/create" class="btn btn-primary mb-1">
								<i class="mdi mdi-database-plus"></i> Додати
							</a>
						</div>
					</div>
					@if (count($results))
						<div class="table-responsive">
							<table class="table table-centered table-hover table-bordered table-sm mb-0">
								<thead>
									<tr class="text-center">
										<th>ID</th>
										<th>Підрозділ</th>
										<th>Загальний об`єкт ремонту</th>
										<th>Вид обладнання</th>
										<th>Об`єкт ремонту</th>
										<th>Тип</th>
										<th>Номер</th>
										<th>Рік випуску</th>
										<th>Місце встановлення</th>
										<th>Наявність в графіках</th>
										{{-- <th>Запис створив</th>
										<th>Час створення запису</th>
										<th>Запис змінив</th>
										<th>Час зміни запису</th> --}}
										<th style="width: 15%;">Дія</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($results as $item)
										<tr class="text-center" data-id="{{ $item->id }}">
											<td class="py-1">{{ $item->id }}</td>
											<td>{{ $item->subdivision->name }}</td>
											<td>{{ $item->complete_renovation_object->name }}</td>
											<td>{{ $item->equipment->name }}</td>
											<td>{{ $item->name }}</td>
											<td>
												@foreach ($item->places as $key => $value)
													<span class="badge bg-{{ $value['place_color'] }}">{{ $value['type'] }}</span>
													<br />
												@endforeach
											</td>
											<td>
												@foreach ($item->places as $key => $value)
													<span class="badge bg-{{ $value['place_color'] }}">{{ $value['number'] }}</span>
													<br />
												@endforeach
											</td>
											<td>
												@foreach ($item->places as $key => $value)
													<span class="badge bg-{{ $value['place_color'] }}">{{ date('Y', strtotime($value['production_date'])) }}</span>
													<br />
												@endforeach
											</td>
											<td>
												@foreach ($item->places as $key => $value)
													<span class="badge bg-{{ $value['place_color'] }}">{{ $value['place_name'] }}</span>
													<br />
												@endforeach
											</td>
											<td>
												@foreach ($item->type_service as $key => $value)
													<span class="badge badge-{{ $value['type_service_color'] }}-lighten">{{ $value['type_service_full'] }}</span>
													<br />
												@endforeach
											</td>
											{{-- <td>{{ $item->created_by }}</td>
											<td>{{ $item->created_at }}</td>
											<td>{{ $item->updated_by }}</td>
											<td>{{ $item->updated_at }}</td> --}}
											<td>
												<form action="/specific_renovation_objects/{{ $item->id }}" method="POST">
													<a href="/specific_renovation_objects/{{ $item->id }}" class="btn btn-outline-info btn-sm my-1">
														<i class="mdi mdi-eye"></i>
													</a>
													<a href="/specific_renovation_objects/{{ $item->id }}/edit" class="btn btn-outline-success btn-sm my-1">
														<i class="mdi mdi-pencil"></i>
													</a>
													@csrf
													@method('DELETE')
													<button type="submit" class="btn btn-outline-danger btn-sm my-1" onclick="return confirm('Вы уверены?');">
														<i class="mdi mdi-delete"></i>
													</button>
												</form>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<div class="float-start mt-2">Показано {{ $results->count() }} з {{ $results->total() }} записів</div>
						<div class="float-end mt-2">{{ $results->links() }}</div>
					@else
						<div class="alert alert-info bg-info text-white border-0" role="alert">
							<i class="mdi mdi-information-outline"></i> Необхідно додати дані.
						</div>
					@endif

				</div>
			</div>
		</div>
	</div>
</div>
