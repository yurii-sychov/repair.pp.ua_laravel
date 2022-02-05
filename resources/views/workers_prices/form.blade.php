<div class="row">
	<div class="col-lg-12">
		<div class="card mb-3">
			<h3 class="card-header text-{{ $page === 'create' ? 'primary' : 'success' }}">
				{{ $page === 'create' ? 'Форма створення ціни на людський ресурс' : 'Форма редагування ціни на людський ресурс' }}
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
				<form action="@if (isset($result)) /workers_prices/{{ $result->id }} @else /workers_prices @endif" method="POST" id="form">
					@csrf
					@if (isset($result)) @method('PUT') @else @method('POST') @endif
					<div class="mb-3">
						<label for="selectWorker" class="form-label">Людський ресурс</label>
						<select class="form-select @error('worker_id') is-invalid @enderror @if (old('worker_id')) is-valid @endif" name="worker_id" id="selectWorker" @isset($result) disabled @endisset>
							<option value="" selected>Оберіть людський ресурс</option>
							@foreach ($workers as $worker)
								<option value="{{ $worker->id }}" @if (isset($result) && $result->worker_id == $worker->id && !$errors->any()) selected @elseif (old('worker_id') == $worker->id) selected @else {{ null }} @endif>{{ $worker->name }}</option>
							@endforeach
						</select>
						<div class="invalid-feedback">{{ $errors->first('worker_id') }}</div>
					</div>
					<div class="mb-3">
						<label for="inputPrice" class="form-label">Ціна на людський ресурс</label>
						<input type="text" id="inputPrice" class="form-control @error('price') is-invalid @enderror @if (old('price')) is-valid @endif" name="price" placeholder="Введить ціну на людський ресурс" value="{{ isset($result) && !$errors->any() ? $result->price : old('price') }}">
						<div class="invalid-feedback">{{ $errors->first('price') }}</div>
					</div>
					<div class="mb-3 position-relative" id="datepicker">
						<label for="inputPriceYear" class="form-label">Актуальний рік</label>
						<input type="text" id="inputPriceYear" class="form-control @error('price_year') is-invalid @enderror @if (old('price_year')) is-valid @endif" name="price_year" placeholder="Введить актуальний рік" @isset($result) disabled @endisset autocomplete="off" value="{{ isset($result) && !$errors->any() ? $result->price_year : old('price_year') }}" data-provide="datepicker" data-date-min-view-mode="2" data-date-format="yyyy" data-date-container="#datepicker" data-date-autoclose="true">
						<div class="invalid-feedback">{{ $errors->first('price_year') }}</div>
					</div>
					<button type="submit" class="btn btn-{{ $page === 'create' ? 'primary' : 'success' }}">
						{{ $page === 'create' ? 'Створити' : 'Редагувати' }}
					</button>
					<a href="/workers_prices" class="btn btn-info">Назад</a>
				</form>
			</div>
		</div>
	</div>
</div>
