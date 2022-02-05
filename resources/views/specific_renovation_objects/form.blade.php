<div class="row">
	<div class="col-lg-4">
		<div class="card mb-3">
			<h3 class="card-header text-{{ isset($page) && $page === 'create' ? 'primary' : 'success' }}">
				{{ isset($page) && $page === 'create' ? 'Форма створення об`єкту ремонту' : 'Форма редагування об`єкту ремонту' }}
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
				<form action="@if (isset($result)) /specific_renovation_objects/{{ $result->id }} @else /specific_renovation_objects @endif" method="POST" id="form">
					@csrf
					@if (isset($result)) @method('PUT') @else @method('POST') @endif
					<div class="mb-3">
						<label for="inputName" class="form-label">Підрозділ</label>
						<select class="form-select @error('subdivision_id') is-invalid @enderror @if (old('subdivision_id')) is-valid @endif" name="subdivision_id">
							<option value="" selected>Оберіть підрозділ</option>
							@isset($subdivisions)
								@foreach ($subdivisions as $subdivision)
									<option value="{{ $subdivision->id }}" @if (isset($result) && $result->subdivision_id == $subdivision->id && !$errors->any()) selected @elseif (old('subdivision_id') == $subdivision->id) selected @else {{ null }} @endif>{{ $subdivision->name }}</option>
								@endforeach
							@endisset
						</select>
						<div class="invalid-feedback">{{ $errors->first('subdivision_id') }}</div>
					</div>
					<div class="mb-3">
						<label for="selectCompleteRenovationObject" class="form-label">Загальний об`єкт ремонту</label>
						<select class="form-select @error('complete_renovation_object_id') is-invalid @enderror @if (old('complete_renovation_object_id')) is-valid @endif" name="complete_renovation_object_id" id="selectCompleteRenovationObject">
							<option value="" selected>Оберіть загальний об`єкт ремонту</option>
							@isset($complete_renovation_objects)
								@foreach ($complete_renovation_objects as $complete_renovation_object)
									<option value="{{ $complete_renovation_object->id }}" @if (isset($result) && $result->complete_renovation_object_id == $complete_renovation_object->id && !$errors->any()) selected @elseif (old('complete_renovation_object_id') == $complete_renovation_object->id) selected @else {{ null }} @endif>{{ $complete_renovation_object->name }}</option>
								@endforeach
							@endisset
						</select>
						<div class="invalid-feedback">{{ $errors->first('complete_renovation_object_id') }}</div>
					</div>
					<div class="mb-3">
						<label for="selectEquipment" class="form-label">Вид обладнання</label>
						<select class="form-select @error('equipment_id') is-invalid @enderror @if (old('equipment_id')) is-valid @endif" name="equipment_id" id="selectEquipment">
							<option value="" selected>Оберіть вид обладнання</option>
							@isset($equipments)
								@foreach ($equipments as $equipment)
									<option value="{{ $equipment->id }}" @if (isset($result) && $result->equipment_id == $equipment->id && !$errors->any()) selected @elseif (old('equipment_id') == $equipment->id) selected @else {{ null }} @endif>{{ $equipment->name }}</option>
								@endforeach
							@endisset
						</select>
						<div class="invalid-feedback">{{ $errors->first('equipment_id') }}</div>
					</div>
					<div class="mb-3">
						<label for="inputName" class="form-label">Назва об`єкту ремонту</label>
						<input type="text" id="inputName" class="form-control @error('name') is-invalid @enderror @if (old('name')) is-valid @endif" name="name" placeholder="Введить назву об`єкту ремонту" value="{{ isset($result) && !$errors->any() ? $result->name : old('name') }}">
						<div class="invalid-feedback">{{ $errors->first('name') }}</div>
					</div>
					<div class="mb-3 position-relative" id="datepicker">
						<label for="inputYearCommissioning" class="form-label">Рік вводу в експлуатацію</label>
						<input type="text" id="inputYearCommissioning" class="form-control @error('year_commissioning') is-invalid @enderror @if (old('year_commissioning')) is-valid @endif" name="year_commissioning" placeholder="Введить рікв воду в експлуатацію" autocomplete="off" value="{{ isset($result) && !$errors->any() ? $result->year_commissioning : old('year_commissioning') }}" data-provide="datepicker" data-date-min-view-mode="2" data-date-format="yyyy" data-date-container="#datepicker" data-date-autoclose="true">
						<div class="invalid-feedback">{{ $errors->first('year_commissioning') }}</div>
					</div>
					<div class="mb-3">
						<div class="table-responsive">
							<table class="table table-sm table-bordered table-hover">
								<thead>
									<tr class="text-center">
										<th colspan="2">Місце встановлення об`єкту ремонту</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($places as $item)
										<tr>
											<td><strong>{{ $item->name }}</strong></td>
											<td>
												<input type="checkbox" id="checkbox_{{ $item->id }}" name="place[]" @if ($item->checked) checked @endif data-switch="success" onClick="addPassportAjax(event)" value="{{ $item->id }}" @if (isset($result) && !$item->checked) data-subdivision_id="{{ $result->subdivision_id }}" data-complete_renovation_object_id="{{ $result->complete_renovation_object_id }}" data-specific_renovation_object_id="{{ $result->id }}" data-place_id="{{ $item->id }} @endif" />
												<label for="checkbox_{{ $item->id }}" data-on-label="Так" data-off-label="Ні"></label>
											</td>
										</tr>
									@endforeach
								<tbody>
							</table>
						</div>
					</div>
					<button type="submit" class="btn btn-{{ isset($page) && $page === 'create' ? 'primary' : 'success' }}">
						{{ isset($page) && $page === 'create' ? 'Створити' : 'Редагувати' }}
					</button>
					<a href="/specific_renovation_objects" class="btn btn-info">Назад</a>
				</form>
			</div>
		</div>
	</div>
	@if (isset($page) && $page === 'edit')
		<div class="col-lg-8">
			<div class="card mb-3">
				<h3 class="card-header text-{{ isset($page) && $page === 'create' ? 'primary' : 'success' }}">
					Форма редагування графіків обслуговування
				</h3>
				<div class="card-body">
					<form action="" method="POST" id="formMaterials">
						@csrf
						<div class="table-responsive">
							<table class="table table-sm table-bordered table-hover">
								<thead>
									<tr class="text-center">
										<th style="width: 10%;">Статус</th>
										<th style="width: 30%;">Тип обслуговування</th>
										<th style="width: 25%;">Періодичність, міс</th>
										<th style="width: 25%;">Дата останього обслуговування</th>
										<th style="width: 10%;">is_schedule</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($type_services as $item)
										<tr data-id={{ $item->id }}>
											<td class="text-center">
												<input type="hidden" class="specific_renovation_object_id" value="{{ $result->id }}" disabled />
												<input type="checkbox" id="switch_{{ $item->id }}" @if ($item->checked) checked @endif data-switch="success" onClick="uptadeStatusScheduleAjax(event)" data-schedule_id={{ $item->schedule_id }} />
												<label for="switch_{{ $item->id }}" data-on-label="Так" data-off-label="Ні"></label>
											</td>
											<td>
												<input type="hidden" class="type_service_id" value="{{ $item->id }}" />
												{{ isset($item->name) ? $item->name : null }}
											</td>
											<td class="text-center">
												<input class="form-control periodicity" placeholder="Введіть періодичність в місяцях" value="{{ isset($item->periodicity) ? $item->periodicity : null }}" @if (!$item->checked) disabled @endif disabled />
											</td>
											<td class="text-center">
												<div class="position-relative" id="datepickerSchedules">
													<input type="text" class="form-control date_last_service" placeholder="Введіть дату останього обслуговування" autocomplete="off" value="{{ isset($item->date_last_service) ? $item->date_last_service : null }}" data-provide="datepicker" data-date-format="yyyy-m-d" data-date-container="#datepickerSchedules" data-date-autoclose="true" @if (!$item->checked) disabled @endif disabled />
												</div>
											</td>
											<td>
												@if ($item->is_schedule) is_schedule @else no_schedule @endif
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						{{-- <button type="submit" class="btn btn-warning mb-1" disabled onClick="editSchedulesAjax(event)">
							Змінити дані в графіку
						</button> --}}
					</form>
				</div>
			</div>
		</div>
	@endif
</div>

<script>
 function addScheduleAjax(event) {
  return;
  if ($(event.target).prop('checked')) {
   $(event.target).parents('tr').find('.periodicity, .date_last_service').removeAttr('disabled').val('');
  } else {
   $(event.target).parents('tr').find('.periodicity, .date_last_service').attr('disabled', 'disabled').val('');
  }

  const specific_renovation_object_id = $(event.target).parents('tr').find('.specific_renovation_object_id').val();
  const type_service_id = $(event.target).parents('tr').find('.type_service_id').val();
  const checked = $(event.target).prop('checked');

  $.ajax({
    url: "/specific_renovation_objects/store/add_schedule_ajax",
    method: "POST",
    headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    dataType: 'json',
    data: {
     specific_renovation_object_id,
     type_service_id,
     checked
    }
   })
   .done(function(data, textStatus, jqXHR) {
    $.NotificationApp.send('Увага', data.message, 'top-center', 'rgba(0,0,0,0.2)', data.color);
    console.log('Ok.');
   })
   .fail(function(data, textStatus, jqXHR) {
    console.log('Щось пішло не так! Можливо не має зв`язку з сервером.');
   })
   .always(function(data, textStatus, jqXHR) {
    console.log('Запит закінчено успішно!');
   });
 }
</script>
