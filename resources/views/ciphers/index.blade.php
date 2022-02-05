<div class="row">
	<div class="col-lg-12">
		<div class="card mb-3">
			<h3 class="card-header text-primary">Шифри ремонту
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
							<a href="/ciphers/create" class="btn btn-primary mb-1">
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
										<th>Шифр ремонту</th>
										<th>Обладнання</th>
										<th>Тип обслуговування</th>
										<th>Запис створив</th>
										<th>Час створення запису</th>
										<th>Запис змінив</th>
										<th>Час зміни запису</th>
										<th style="width: 15%;">Дія</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($results as $item)
										<tr class="text-center" data-id="{{ $item->id }}">
											<td class="py-1">{{ $item->id }}</td>
											<td>{{ $item->cipher }}</td>
											<td>{{ $item->name }}</td>
											<td>{{ $item->type_service->name }}</td>
											<td>{{ $item->created_by }}</td>
											<td>{{ $item->created_at }}</td>
											<td>{{ $item->updated_by }}</td>
											<td>{{ $item->updated_at }}</td>
											<td>
												<form action="/ciphers/{{ $item->id }}" method="POST">
													<a href="/ciphers/{{ $item->id }}" class="btn btn-outline-warning btn-sm my-1" title="Додати кошториси" onClick="getResourcesAjax(event)">
														<i class="mdi mdi-clipboard-list-outline"></i>
													</a>
													<a href="/ciphers/{{ $item->id }}" class="btn btn-outline-info btn-sm my-1 disabled">
														<i class="mdi mdi-eye"></i>
													</a>
													<a href="/ciphers/{{ $item->id }}/edit" class="btn btn-outline-success btn-sm my-1">
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

{{-- Modal --}}
<div id="resourcesModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="resourcesModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="resourcesModalLabel">Ресурси</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
			</div>
			<div class="modal-body">
				<div class="text-center">
					<i class="mdi mdi-spin mdi-loading mdi-48px"></i>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
							<li class="nav-item">
								<a href="#tabMaterials" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0 active">
									<i class="mdi mdi-nut d-md-none d-block"></i>
									<span class="d-none d-md-block">Матеріальні</span>
								</a>
							</li>
							<li class="nav-item">
								<a href="#tabWorkers" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0">
									<i class="mdi mdi-account-multiple d-md-none d-block"></i>
									<span class="d-none d-md-block">Людські</span>
								</a>
							</li>
							<li class="nav-item">
								<a href="#tabTechnics" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
									<i class="mdi mdi-train-car d-md-none d-block"></i>
									<span class="d-none d-md-block">Технічні</span>
								</a>
							</li>
						</ul>

						<div class="tab-content">
							<div class="tab-pane show active" id="tabMaterials">
								<h3 class="text-center">Матеріальні ресурси</h3>
								<div class="table-responsive">
									<table class="table table-centered table-hover table-bordered table-sm">
										<thead>
											<tr class="text-center">
												<th>Матеріал</th>
												<th>Кількість</th>
												<th>Одиниця виміру</th>
												<th>Ціна без НДС, грн</th>
												<th>Заг. ціна без НДС, грн</th>
											</tr>
										</thead>
										<tbody>
											<tr>
											</tr>
										</tbody>
										<thead>
											<tr>
												<th colspan="4">Загальна сума без НДС, грн</th>
												<th class="text-center text-success total-price"></th>
											</tr>
											<tr>
												<th colspan="4">Загальна сума з НДС, грн</th>
												<th class="text-center text-danger total-price"></th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
							<div class="tab-pane" id="tabWorkers">
								<h3 class="text-center">Людські ресурси</h3>
								<div class="table-responsive">
									<table class="table table-centered table-hover table-bordered table-sm">
										<thead>
											<tr class="text-center">
												<th>Працівник</th>
												<th>Кількість</th>
												<th>Одиниця виміру</th>
												<th>Ціна без НДС, грн</th>
												<th>Заг. ціна без НДС, грн</th>
											</tr>
										</thead>
										<tbody>
											<tr>
											</tr>
										</tbody>
										<thead>
											<tr>
												<th colspan="4">Загальна сума без НДС, грн</th>
												<th class="text-center text-success total-price"></th>
											</tr>
											<tr>
												<th colspan="4">Загальна сума з НДС, грн</th>
												<th class="text-center text-danger total-price"></th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
							<div class="tab-pane" id="tabTechnics">
								<h3 class="text-center">Технічні ресурси</h3>
								<div class="table-responsive">
									<table class="table table-centered table-hover table-bordered table-sm">
										<thead>
											<tr class="text-center">
												<th>Техніка</th>
												<th>Кількість</th>
												<th>Одиниця виміру</th>
												<th>Ціна без НДС, грн</th>
												<th>Заг. ціна без НДС, грн</th>
											</tr>
										</thead>
										<tbody>
											<tr>
											</tr>
										</tbody>
										<thead>
											<tr>
												<th colspan="4">Загальна сума без НДС, грн</th>
												<th class="text-center text-success total-price"></th>
											</tr>
											<tr>
												<th colspan="4">Загальна сума з НДС, грн</th>
												<th class="text-center text-danger total-price"></th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-light" data-bs-dismiss="modal">Закрити</button>
				{{-- <button type="button" class="btn btn-primary">Зберегти</button> --}}
			</div>
		</div>
	</div>
</div>
