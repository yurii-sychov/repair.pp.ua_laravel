<div class="row">
	<div class="col-lg-12">
		<div class="card mb-3">
			<h3 class="card-header text-{{ $page === 'create' ? 'primary' : 'success' }}">
				{{ $page === 'create' ? 'Форма створення матеріального ресурсу' : 'Форма редагування матеріального ресурсу' }}
			</h3>
			<div class="card-body">
				{{-- @if ($errors->any())
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <h5><i class="mdi mdi-information-outline"></i> Увага!</h5>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif --}}
				<form action="@if (isset($result)) /materials/{{ $result->id }} @else /materials @endif" method="POST" id="form">
					@csrf
					@if (isset($result)) @method('PUT') @else @method('POST') @endif
					<div class="mb-3">
						<label for="inputR3Id" class="form-label">Номер по R3</label>
						<input type="text" id="inputR3Id" class="form-control @error('r3_id') is-invalid @enderror @if (old('r3_id')) is-valid @endif" name="r3_id" placeholder="Введить номер по R3" value="{{ isset($result) && !$errors->any() ? $result->r3_id : old('r3_id') }}">
						<div class="invalid-feedback">{{ $errors->first('r3_id') }}</div>
					</div>
					<div class="mb-3">
						<label for="inputName" class="form-label">Назва матеріального ресурсу</label>
						<input type="text" id="inputName" class="form-control @error('name') is-invalid @enderror @if (old('name')) is-valid @endif" name="name" placeholder="Введить назву матеріального ресурсу" value="{{ isset($result) && !$errors->any() ? $result->name : old('name') }}">
						<div class="invalid-feedback">{{ $errors->first('name') }}</div>
					</div>
					<div class="mb-3">
						<label for="inputUnit" class="form-label">Одиниця виміру</label>
						<input type="text" id="inputUnit" class="form-control @error('unit') is-invalid @enderror @if (old('unit')) is-valid @endif" name="unit" placeholder="Введить одиницю виміру" value="{{ isset($result) && !$errors->any() ? $result->unit : old('unit') }}">
						<div class="invalid-feedback">{{ $errors->first('unit') }}</div>
					</div>
					<button type="submit" class="btn btn-{{ $page === 'create' ? 'primary' : 'success' }}">
						{{ $page === 'create' ? 'Створити' : 'Редагувати' }}
					</button>
					<a href="/materials" class="btn btn-info">Назад</a>
				</form>
			</div>
		</div>
	</div>
</div>
