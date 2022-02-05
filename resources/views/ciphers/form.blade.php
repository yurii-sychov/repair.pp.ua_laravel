<div class="row">
	<div class="col-lg-4">
		<div class="card mb-3">
			<h3 class="card-header text-{{ isset($page) && $page === 'create' ? 'primary' : 'success' }}">
				{{ isset($page) && $page === 'create' ? 'Форма створення шифру ремонту' : 'Форма редагування шифру ремонту' }}
			</h3>
			<div class="card-body">
				{{-- @if ($errors->any())
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<h5><i class="mdi mdi-information-outline"></i> Увага!</h5>
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				@endif --}}
				<form action="@if (isset($result)) /ciphers/{{ $result->id }} @else /ciphers @endif" method="POST" id="form">
					@csrf
					@if (isset($result)) @method('PUT') @else @method('POST') @endif
					<h4 class="header-title">Заголовок</h4>
					<p class="text-muted font-14">Підзаголовок</p>
					<div class="mb-3">
						<label for="inputCipher" class="form-label">Шифр ремонту</label>
						<input type="text" id="inputCipher" class="form-control @error('cipher') is-invalid @enderror @if (old('cipher')) is-valid @endif" name="cipher" placeholder="Введить шифр ремонту" value="{{ isset($result) && !$errors->any() ? $result->cipher : old('cipher') }}">
						<div class="invalid-feedback">{{ $errors->first('cipher') }}</div>
					</div>
					<div class="mb-3">
						<label for="inputName" class="form-label">Назва шифру
							ремонту</label>
						<input type="text" id="inputName" class="form-control @error('name') is-invalid @enderror @if (old('name')) is-valid @endif" name="name" placeholder="Введить назву об`єкту ремонту" value="{{ isset($result) && !$errors->any() ? $result->name : old('name') }}">
						<div class="invalid-feedback">{{ $errors->first('name') }}</div>
					</div>
					<div class="mb-3">
						<label for="selectTypeService" class="form-label">Тип обслуговування</label>
						<select class="form-select @error('type_service_id') is-invalid @enderror @if (old('type_service_id')) is-valid @endif" name="type_service_id" id="selectTypeService">
							<option value="" selected>Оберіть тип обслуговування</option>
							@isset($type_services)
								@foreach ($type_services as $type_service)
									<option value="{{ $type_service->id }}" @if (isset($result) && $result->type_service_id == $type_service->id && !$errors->any()) selected @elseif (old('type_service_id') == $type_service->id) selected @else {{ null }} @endif>{{ $type_service->name }}</option>
								@endforeach
							@endisset
						</select>
						<div class="invalid-feedback">{{ $errors->first('type_service_id') }}</div>
					</div>
					<button type="submit" class="btn btn-{{ isset($page) && $page === 'create' ? 'primary' : 'success' }}">
						{{ isset($page) && $page === 'create' ? 'Створити' : 'Редагувати' }}
					</button>
					<a href="/ciphers" class="btn btn-info">Назад</a>
				</form>
			</div>
		</div>
	</div>
	@if (isset($page) && $page === 'edit')
		<div class="col-lg-8">
			<div class="card mb-3">
				<h3 class="card-header text-{{ isset($page) && $page === 'create' ? 'primary' : 'success' }}">
					Ресурси
				</h3>
				<div class="card-body">
					<h4 class="header-title">Заголовок</h4>
					<p class="text-muted font-14">Підзаголовок</p>
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
							@if (isset($materials))
								<form action="" method="POST" id="formMaterials">
									@csrf
									<div class="table-responsive">
										<table class="table table-sm table-bordered table-hover">
											<thead>
												<tr class="text-center">
													<th style="width: 40%;">Матеріал</th>
													<th style="width: 20%;">Кількість</th>
													<th style="width: 20%;">Одиниця виміру</th>
													<th style="width: 20%;">Ціна без НДС, грн</th>
												</tr>
											</thead>
											<tbody>
												@foreach ($materials as $key => $item)
													<tr data-id="{{ $item->id }}">
														<input type="hidden" name="cipher_id[]" value="{{ request()->segment(2) }}" />
														<td class="td-material_id">
															<div class="form-check form-checkbox-success">
																<input type="checkbox" class="form-check-input" id="checkMaterial_{{ $item->id }}" name="material_id[]" value="{{ $item->id ? $item->id : 0 }}" {{ $item->checked ? $item->checked : null }} tabindex="-1" />&nbsp;
																<label class="form-check-label" for="checkMaterial_{{ $item->id }}">{{ $item->name }}</label>
															</div>
														</td>
														<td class="text-center td-quantity">
															<input type="text" class="form-control text-center" name="quantity[]" value="{{ $item->quantity ? $item->quantity : null }}" placeholder="Введіть кількість" />
														</td>
														<td class="text-center td-unit">{{ $item->unit }}</td>
														<td class="text-center td-price {{ !$item->quantity ? 'text-danger' : null }}">
															{{ number_format($item->price, 2, ',', ' ') }}
														</td>
													</tr>
												@endforeach
												<tr>
													<td colspan="3"><strong>Загальна сума без НДС, грн</strong></td>
													<td class="text-center text-success"><strong id="totalPrice">{{ number_format($total_materials_prices, 2, ',', ' ') }}</strong></td>
												</tr>
											</tbody>
										</table>
									</div>
									<button type="submit" class="btn btn-warning mb-1" onClick="createCiphersMaterialsAjax(event)">
										Змінити перелік матеріалів
									</button>
									<a href="/materials/create" class="btn btn-info mb-1">Додати матеріал</a>
								</form>
							@else
								<div class="alert alert-warning" role="alert">
									<i class="mdi mdi-information-outline"></i> Необхідно додати матеріали. <a href="/materials/create"><strong>Додати</strong></a>
								</div>
							@endif
						</div>

						<div class="tab-pane show" id="tabWorkers">
							@if (isset($workers))
								<form action="" method="POST" id="formWorkers">
									@csrf
									<div class="table-responsive">
										<table class="table table-sm table-bordered table-hover">
											<thead>
												<tr class="text-center">
													<th style="width: 50%;">Ресурс</th>
													<th style="width: 20%;">Кількість</th>
													<th style="width: 30%;">Одиниця виміру</th>
												</tr>
											</thead>
											<tbody>
												@foreach ($workers as $key => $item)
													<tr>
														<input type="hidden" name="cipher_id[]" value="{{ request()->segment(2) }}" />
														<td>
															<div class="form-check form-checkbox-success mb-2">
																<input type="checkbox" class="form-check-input" id="checkWorker_{{ $item->id }}" name="worker_id[]" value="{{ $item->id ? $item->id : 0 }}" {{ $item->checked ? $item->checked : null }} tabindex="-1" />&nbsp;
																<label class="form-check-label" for="checkWorker_{{ $item->id }}">{{ $item->name }}</label>
															</div>
														</td>
														<td class="text-center">
															<input type="text" class="form-control text-center" name="quantity[]" value="{{ $item->quantity ? $item->quantity : null }}" placeholder="Введіть кількість" />
														</td>
														<td class="text-center">{{ $item->unit }}</td>
													</tr>
												@endforeach
												<tr>
													<td colspan="2"><strong>Сума без НДС, грн</strong></td>
													<td class="text-center text-success"><strong>2 000</strong></td>
												</tr>
											</tbody>
										</table>
									</div>
									<button type="submit" class="btn btn-warning mb-1" onClick="createCiphersWorkersAjax(event)">
										Змінити перелік ресурсів
									</button>
									<a href="/workers/create" class="btn btn-info mb-1">Додати ресурс</a>
								</form>
							@else
								<div class="alert alert-warning" role="alert">
									<i class="mdi mdi-information-outline"></i> Необхідно додати ресурси. <a href="/workers/create"><strong>Додати</strong></a>
								</div>
							@endif
						</div>

						<div class="tab-pane show" id="tabTechnics">
							@if (isset($technics))
								<form action="" method="POST" id="formTechnics">
									@csrf
									<div class="table-responsive">
										<table class="table table-sm table-bordered table-hover">
											<thead>
												<tr class="text-center">
													<th style="width: 50%;">Техніка</th>
													<th style="width: 20%;">Кількість</th>
													<th style="width: 30%;">Одиниця виміру</th>
												</tr>
											</thead>
											<tbody>
												@foreach ($technics as $key => $item)
													<tr>
														<input type="hidden" name="cipher_id[]" value="{{ request()->segment(2) }}" />
														<td>
															<div class="form-check form-checkbox-success mb-2">
																<input type="checkbox" class="form-check-input" id="checkTechnic_{{ $item->id }}" name="technic_id[]" value="{{ $item->id ? $item->id : 0 }}" {{ $item->checked ? $item->checked : null }} tabindex="-1" />&nbsp;
																<label class="form-check-label" for="checkTechnic_{{ $item->id }}">{{ $item->name }}</label>
															</div>
														</td>
														<td class="text-center">
															<input type="text" class="form-control text-center" name="quantity[]" value="{{ $item->quantity ? $item->quantity : null }}" placeholder="Введіть кількість" />
														</td>
														<td class="text-center">{{ $item->unit }}</td>
													</tr>
												@endforeach
												<tr>
													<td colspan="2"><strong>Сума без НДС, грн</strong></td>
													<td class="text-center text-success"><strong>3 000</strong></td>
												</tr>
											</tbody>
										</table>
									</div>
									<button type="submit" class="btn btn-warning mb-1" onClick="createCiphersTechnicsAjax(event)">
										Змінити перелік техніки
									</button>
									<a href="/technics/create" class="btn btn-info mb-1">Додати техніку</a>
								</form>
							@else
								<div class="alert alert-warning" role="alert">
									<i class="mdi mdi-information-outline"></i> Необхідно додати техніку. <a href="/technics/create"><strong>Додати</strong></a>
								</div>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	@endif
</div>

{{-- <div id="materialsPricesModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="materialsPricesModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="materialsPricesModalLabel">Додавання ціни матеріалу</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
			</div>
			<div class="modal-body">
				<input type="hidden" name="cipher_id" value="{{ request()->segment(2) }}" />
				<div class="row">
					<div class="col-lg-12">
						<div class="mb-3">
							<label for="inputMaterial" class="form-label">Назва матеріалу</label>
							<input type="text" id="inputMaterial" class="form-control" name="name" readonly />
							<input type="hidden" name="material_id" />
						</div>
						<div class="mb-3">
							<label for="inputPriceYear" class="form-label">Актуальний рік</label>
							<input type="text" id="inputPriceYear" class="form-control" name="price_year" readonly />
						</div>
						<div class="mb-3">
							<label for="inputPrice" class="form-label">Ціна без НДС, грн</label>
							<input type="text" id="inputPrice" class="form-control" name="price" />
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-light" data-bs-dismiss="modal">Закрити</button>
				<button type="button" class="btn btn-primary" onClick="addPrice(event)">Зберегти</button>
			</div>
		</div>
	</div>
</div> --}}

<script>
 function fullMaterialsPricesModal(event) {
  // const material_id = $(event.target).parents('tr').attr('data-id');
  // const name = $(event.target).parents('tr').find('label').html();
  // const price_year = new Date().getFullYear() + 1;
  // const modal = $('#materialsPricesModal');

  // modal.find('[name="name"]').val(name);
  // modal.find('[name="material_id"]').val(material_id);
  // modal.find('[name="price_year"]').val(price_year);
  // modal.find('[name="price"]').val('');
  // modal.on('shown.bs.modal', function () {
  //     modal.find('[name="price"]').focus();
  // });
 }

 function addPrice(event) {
  // const modal = $('#materialsPricesModal');

  // const cipher_id = modal.find('[name="cipher_id"]').val();
  // const material_id = modal.find('[name="material_id"]').val();
  // const price = modal.find('[name="price"]').val();
  // const price_year = modal.find('[name="price_year"]').val();

  // $.ajax({
  //     url: "/materials_prices/store/price",
  //     method: "POST",
  //     headers: {
  //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //     },
  //     dataType: 'json',
  //     data: { cipher_id, material_id, price_year, price }
  // })
  //     .done(function (data, textStatus, jqXHR) {

  //         if (data.result) {
  //             const tr = $('#formMaterials tbody tr');
  //             let total_materials_prices = 0;

  //             $(data.result).each(function (index, item) {
  //                 index++;
  //                 if (item.price > 0) {
  //                     $('#formMaterials tbody [data-id="' + index + '"]').find('[data-bs-target="#materialsPricesModal"]').parent().html(item.price);
  //                 }
  //             });

  //             $('#formMaterials tbody tr .total').html(data.total_materials_prices);
  //         }

  //         // modal.modal('hide');

  //         $.NotificationApp.send('Увага', data.message, 'top-center', 'rgba(0,0,0,0.2)', data.status === 'SUCCESS' ? 'success' : 'error');
  //         console.log(data.message);
  //     })
  //     .fail(function (data, textStatus, jqXHR) {
  //         modal.find('input').removeClass('is-invalid');
  //         const messages = [];
  //         $.each(data.responseJSON.errors, function (index, value) {
  //             $('[name="' + index + '"').addClass('is-invalid');
  //             messages.push(value);
  //         });
  //         $.NotificationApp.send('Увага', messages, 'top-center', 'rgba(0,0,0,0.2)', 'error');
  //         console.log('Щось пішло не так! Можливо не має зв`язку з сервером.');
  //     })
  //     .always(function (data, textStatus, jqXHR) {
  //         console.log('Запит закінчено успішно!');
  //     });
 }

 function createCiphersMaterialsAjax(event) {
  event.preventDefault();

  const form = $("#formMaterials");

  const ciphers = form.find('input[name="cipher_id[]"]');
  const materials = form.find('input[name="material_id[]"]');
  const quantities = form.find('input[name="quantity[]"]');

  const data = [];

  for (let i = 0; i < ciphers.length; i++) {
   if (materials[i].checked && quantities[i].value != '') {
    let cipher_id = ciphers[i].value
    let material_id = materials[i].value
    let quantity = quantities[i].value
    data.push({
     cipher_id,
     material_id,
     quantity
    });
   } else {
    materials[i].checked = false;
    quantities[i].value = '';
   }
  }

  $.ajax({
    url: "/ciphers/store/create_ciphers_materials_ajax",
    method: "POST",
    headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    dataType: 'json',
    data: {
     'data': data
    }
   })
   .done(function(data, textStatus, jqXHR) {
    const formatter = new Intl.NumberFormat('ru-RU', {
     minimumFractionDigits: 2,
     maximumFractionDigits: 2,
    });
    $('#totalPrice').html(formatter.format(data.total_materials_prices));

    const td_price = $('#formMaterials tr .td-price');
    $(data.response).each(function(index, value) {
     console.log(value)
     if (value.quantity == 0) {
      $(td_price[index]).addClass('text-danger');
     } else {
      $(td_price[index]).removeClass('text-danger');
     }

     $(td_price[index]).html(formatter.format(value.price));
    });

    $.NotificationApp.send('Увага', data.message, 'top-center', 'rgba(0,0,0,0.2)', data.status === 'SUCCESS' ? 'success' : 'error');
    console.log(data.message);
   })
   .fail(function(data, textStatus, jqXHR) {
    console.log('Щось пішло не так! Можливо не має зв`язку з сервером.');
   })
   .always(function(data, textStatus, jqXHR) {
    console.log('Запит закінчено успішно!');
   });
 }

 function createCiphersWorkersAjax(event) {
  event.preventDefault();

  const form = $("#formWorkers");

  const ciphers = form.find('input[name="cipher_id[]"]');
  const workers = form.find('input[name="worker_id[]"]');
  const quantities = form.find('input[name="quantity[]"]');

  const data = [];

  for (let i = 0; i < ciphers.length; i++) {
   if (workers[i].checked && quantities[i].value != '') {
    let cipher_id = ciphers[i].value
    let worker_id = workers[i].value
    let quantity = quantities[i].value
    data.push({
     cipher_id,
     worker_id,
     quantity
    });
   } else {
    workers[i].checked = false;
    quantities[i].value = '';
   }
  }

  $.ajax({
    url: "/ciphers/store/create_ciphers_workers_ajax",
    method: "POST",
    headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    dataType: 'json',
    data: {
     'data': data
    }
   })
   .done(function(data, textStatus, jqXHR) {
    $.NotificationApp.send('Увага', data.message, 'top-center', 'rgba(0,0,0,0.2)', data.status === 'SUCCESS' ? 'success' : 'error');
    console.log(data.message);
   })
   .fail(function(data, textStatus, jqXHR) {
    console.log('Щось пішло не так! Можливо не має зв`язку з сервером.');
   })
   .always(function(data, textStatus, jqXHR) {
    console.log('Запит закінчено успішно!');
   });
 }

 function createCiphersTechnicsAjax(event) {
  event.preventDefault();

  const form = $("#formTechnics");

  const ciphers = form.find('input[name="cipher_id[]"]');
  const technics = form.find('input[name="technic_id[]"]');
  const quantities = form.find('input[name="quantity[]"]');

  const data = [];

  for (let i = 0; i < ciphers.length; i++) {
   if (technics[i].checked && quantities[i].value != '') {
    let cipher_id = ciphers[i].value
    let technic_id = technics[i].value
    let quantity = quantities[i].value
    data.push({
     cipher_id,
     technic_id,
     quantity
    });
   } else {
    technics[i].checked = false;
    quantities[i].value = '';
   }
  }

  $.ajax({
    url: "/ciphers/store/create_ciphers_technics_ajax",
    method: "POST",
    headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    dataType: 'json',
    data: {
     'data': data
    }
   })
   .done(function(data, textStatus, jqXHR) {
    $.NotificationApp.send('Увага', data.message, 'top-center', 'rgba(0,0,0,0.2)', data.status === 'SUCCESS' ? 'success' : 'error');
    console.log(data.message);
   })
   .fail(function(data, textStatus, jqXHR) {
    console.log('Щось пішло не так! Можливо не має зв`язку з сервером.');
   })
   .always(function(data, textStatus, jqXHR) {
    console.log('Запит закінчено успішно!');
   });
 }
</script>
