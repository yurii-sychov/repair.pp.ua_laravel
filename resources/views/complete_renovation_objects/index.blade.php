<div class="row">
	<div class="col-lg-12">
		<div class="card mb-3">
			<h3 class="card-header text-primary">Загальні об`єкти ремонту
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
							<a href="/complete_renovation_objects/create" class="btn btn-primary mb-1">
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
										<th>Рік вводу в експлуатацію</th>
										{{-- <th>Запис створив</th>
										<th>Час створення запису</th>
										<th>Запис змінив</th>
										<th>Час зміни запису</th> --}}
										<th style="width: 10%;">Дія</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($results as $item)
										<tr class="text-center">
											<td class="py-1">{{ $item->id }}</td>
											<td>{{ $item->subdivision->name }}</td>
											<td>{{ $item->name }}</td>
											<td>{{ $item->year_commissioning ? $item->year_commissioning : 'NULL' }}</td>
											{{-- <td>{{ $item->created_by }}</td>
											<td>{{ $item->created_at }}</td>
											<td>{{ $item->updated_by }}</td>
											<td>{{ $item->updated_at }}</td> --}}
											<td>
												<form action="/complete_renovation_objects/{{ $item->id }}" method="POST">
													<a href="/complete_renovation_objects/{{ $item->id }}" class="btn btn-outline-info btn-sm my-1">
														<i class="mdi mdi-eye"></i>
													</a>
													<a href="/complete_renovation_objects/{{ $item->id }}/edit" class="btn btn-outline-success btn-sm my-1">
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
