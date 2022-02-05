<div class="row">
	<div class="col-lg-12">
		<div class="card mb-3">
			<h3 class="card-header text-{{ $page === 'create' ? 'primary' : 'success' }}">
				{{ $page === 'create' ? 'Форма створення цін на матеріали' : 'Форма редагування цін матеріали' }}
			</h3>
			<div class="card-body">
				<form action="/materials_prices/store/tabular" method="POST" id="form">
					@csrf
					@if (isset($result)) @method('PUT') @else @method('POST') @endif
					<table class="table table-sm table-bordered table-hover">
						<thead>
							<tr class="text-center">
								<th style="width: 50%;">Матеріал</th>
								<th style="width: 25%;">Ціна без НДС, грн</th>
								<th style="width: 25%;">Актуальний рік</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($materials as $item)
								<tr>
									<td>
										<input type="hidden" value="{{ $item->id }}" name="material_id[]" tabindex="-1" />
										<strong>{{ $item->name }}</strong>
										{{-- <select class="form-select @error('material_id') is-invalid @enderror" name="material_id[]" id="selectMaterial" tabindex="-1" disabled>
										<option value="" selected>Оберіть матеріал</option>
										@foreach ($materials as $material)
										<option value="{{$material->id}}" @if (isset($result) && $result->material_id == $material->id && !$errors->any()) selected @elseif (old('material_id') == $material->id) selected @elseif ($item->id == $material->id) selected @else {{ NULL }} @endif>{{ $material->name }}</option>
										@endforeach
									</select> --}}
									</td>
									<td>
										<input type="text" id="inputPrice" class="form-control @error('price') is-invalid @enderror" name="price[]" placeholder="Введить ціну матеріалу" value="{{ isset($result) && !$errors->any() ? $result->price : old('price') }}" />
									</td>
									<td>
										<input type="text" id="inputPriceYear" class="form-control @error('price_year') is-invalid @enderror" name="price_year[]" placeholder="Введить актуальний рік" autocomplete="off" value="{{ date('Y') + 1 }}" tabindex="-1" readonly />
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					<button type="submit" class="btn btn-{{ $page === 'create' ? 'primary' : 'success' }}">
						{{ $page === 'create' ? 'Створити' : 'Редагувати' }}
					</button>
					<a href="/materials_prices" class="btn btn-info">Назад</a>
				</form>
			</div>
		</div>
	</div>
</div>
