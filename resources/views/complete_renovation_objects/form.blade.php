<div class="row">
	<div class="col-lg-6">
		<div class="card mb-3">
			<h3 class="card-header text-{{ isset($page) && $page === 'create' ? 'primary' : 'success' }}">
				{{ isset($page) && $page === 'create'
				    ? 'Форма створення загального об`єкту ремонту'
				    : 'Форма редагування загального
																				                об`єкту ремонту' }}
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
				<form action="@if (isset($result)) /complete_renovation_objects/{{ $result->id }} @else /complete_renovation_objects @endif" method="POST" id="form">
					@csrf
					@if (isset($result)) @method('PUT') @else @method('POST') @endif
					<div class="mb-3">
						<label for="selectSubdivision" class="form-label">Підрозділ</label>
						<select class="form-select @error('subdivision_id') is-invalid @enderror @if (old('subdivision_id')) is-valid @endif" name="subdivision_id" id="selectSubdivision">
							<option value="" selected>Оберіть підрозділ</option>
							@foreach ($subdivisions as $subdivision)
							<option value="{{ $subdivision->id }}" @if (isset($result) && $result->subdivision_id == $subdivision->id && !$errors->any()) selected @elseif (old('subdivision_id') ==
									$subdivision->id)
								selected @else {{ null }}
							@endif>{{ $subdivision->name }}</option>
							@endforeach
						</select>
						<div class="invalid-feedback">{{ $errors->first('subdivision->id') }}</div>
					</div>
					<div class="mb-3">
						<label for="inputName" class="form-label">Назва загального об`єкту ремонту</label>
						<input type="text" id="inputName" class="form-control @error('name') is-invalid @enderror @if (old('name')) is-valid @endif" name="name" placeholder="Введить назву загального об`єкту ремонту" value="{{ isset($result) && !$errors->any() ? $result->name : old('name') }}">
						<div class="invalid-feedback">{{ $errors->first('name') }}</div>
					</div>
					<div class="mb-3 position-relative" id="datepicker">
						<label for="inputYearCommissioning" class="form-label">Рік вводу в експлуатацію</label>
						<input type="text" id="inputYearCommissioning" class="form-control @error('year_commissioning') is-invalid @enderror @if (old('year_commissioning')) is-valid @endif" name="year_commissioning" placeholder="Введить рікв воду в експлуатацію" autocomplete="off" value="{{ isset($result) && !$errors->any() ? $result->year_commissioning : old('year_commissioning') }}" data-provide="datepicker" data-date-min-view-mode="2" data-date-format="yyyy" data-date-container="#datepicker" data-date-autoclose="true">
						<div class="invalid-feedback">{{ $errors->first('year_commissioning') }}</div>
					</div>
					<button type="submit" class="btn btn-{{ isset($page) && $page === 'create' ? 'primary' : 'success' }}">
						{{ isset($page) && $page === 'create' ? 'Створити' : 'Редагувати' }}
					</button>
					<a href="/complete_renovation_objects" class="btn btn-info">Назад</a>
				</form>
			</div>
		</div>
	</div>
</div>
