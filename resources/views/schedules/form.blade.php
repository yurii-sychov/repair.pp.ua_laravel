<div class="row">
	<div class="col-lg-6">
		<div class="card mb-3">
			<h3 class="card-header text-{{ $page === 'create' ? 'primary' : 'success' }}">
				{{ $page === 'create' ? 'Форма створення графіку ремонту' : 'Форма редагування графіку ремонту' }}
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
				<form action="@if (isset($result)) /schedules/{{ $result->id }} @else /schedules @endif" method="POST" id="form">
					@csrf
					@if (isset($result)) @method('PUT') @else @method('POST') @endif
					<div class="mb-3">
						<label for="inputPeriodicity" class="form-label">Періодичність ремонту, міс.</label>
						<input type="text" id="inputPeriodicity" class="form-control @error('periodicity') is-invalid @enderror @if (old('periodicity')) is-valid @endif" name="periodicity" placeholder="Введить періодичність ремонту" value="{{ isset($result) && !$errors->any() ? $result->periodicity : old('periodicity') }}">
						<div class="invalid-feedback">{{ $errors->first('periodicity') }}</div>
					</div>
					<div class="mb-3 position-relative" id="datepicker"">
						<label for=" inputDateLastService" class="form-label">Дата останього ремонту</label>
						<input type="text" id="inputDateLastService" class="form-control @error('date_last_service') is-invalid @enderror @if (old('date_last_service')) is-valid @endif" name="date_last_service" placeholder="Виберіть дату останього ремонту" value="{{ isset($result) && !$errors->any() ? $result->date_last_service : old('date_last_service') }}" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-container="#datepicker" data-date-autoclose="true" readonly>
						<div class="invalid-feedback">{{ $errors->first('date_last_service') }}</div>
					</div>
					<div class="mb-3">
						<input type="checkbox" id="checkboxStatus" name="status" @if ($result->status) checked @endif data-switch="success" />
						<label for="checkboxStatus" data-on-label="Так" data-off-label="Ні"></label>
					</div>
					<button type="submit" class="btn btn-{{ $page === 'create' ? 'primary' : 'success' }}">
						{{ $page === 'create' ? 'Створити' : 'Редагувати' }}
					</button>
					<a href="/schedules" class="btn btn-info">Назад</a>
				</form>
			</div>
		</div>
	</div>
</div>
