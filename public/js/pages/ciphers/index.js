async function getResourcesAjax(event) {
	event.preventDefault();
	const id = $(event.target).parents("tr").data("id");
	$("#resourcesModal .modal-body .row").hide();
	$("#resourcesModal").modal("show");

	await $.ajax({
		url: "/ciphers/show/get_resources_ajax",
		method: "POST",
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
		},
		dataType: "json",
		data: {
			id,
		},
	})
		.done(function (data, textStatus, jqXHR) {
			// {{-- const formatter = new Intl.NumberFormat('ru-RU', {
			// minimumFractionDigits: 2,
			// maximumFractionDigits: 2,
			// }); --}}

			$("#tabMaterials h3").html(
				'Матеріальні ресурси <span class="badge bg-success">' +
					data.response.result_materials.total_materials_prices +
					"</span>"
			);
			$("#tabMaterials .total-price:eq(0)").html(
				"<strong>" +
					data.response.result_materials.total_materials_prices +
					"</strong>"
			);
			$("#tabMaterials .total-price:eq(1)").html(
				"<strong>" +
					data.response.result_materials.total_materials_prices_vat +
					"</strong>"
			);

			let tr;

			tr = "";
			$(data.response.result_materials.materials).each(function (
				index,
				value
			) {
				tr += "<tr>";
				tr += "<td>" + value.name + "</td>";
				tr += '<td class="text-center">' + value.quantity + "</td>";
				tr += '<td class="text-center">' + value.unit + "</td>";
				tr += '<td class="text-center">' + value.price + "</td>";
				tr += '<td class="text-center">' + value.price_total + "</td>";
				tr += "</tr>";
			});
			$("#tabMaterials tbody").html(tr);

			$("#tabWorkers h3").html(
				'Людські ресурси <span class="badge bg-success">' +
					data.response.result_workers.total_workers_prices +
					"</span>"
			);
			$("#tabWorkers .total-price:eq(0)").html(
				"<strong>" +
					data.response.result_workers.total_workers_prices +
					"</strong>"
			);
			$("#tabWorkers .total-price:eq(1)").html(
				"<strong>" +
					data.response.result_workers.total_workers_prices_vat +
					"</strong>"
			);

			tr = "";
			$(data.response.result_workers.workers).each(function (
				index,
				value
			) {
				tr += "<tr>";
				tr += "<td>" + value.name + "</td>";
				tr += '<td class="text-center">' + value.quantity + "</td>";
				tr += '<td class="text-center">' + value.unit + "</td>";
				tr += '<td class="text-center">' + value.price + "</td>";
				tr += '<td class="text-center">' + value.price_total + "</td>";
				tr += "</tr>";
			});
			$("#tabWorkers tbody").html(tr);

			$("#tabTechnics h3").html(
				'Людські ресурси <span class="badge bg-success">' +
					data.response.result_technics.total_technics_prices +
					"</span>"
			);
			$("#tabTechnics .total-price:eq(0)").html(
				"<strong>" +
					data.response.result_technics.total_technics_prices +
					"</strong>"
			);
			$("#tabTechnics .total-price:eq(1)").html(
				"<strong>" +
					data.response.result_technics.total_technics_prices_vat +
					"</strong>"
			);

			tr = "";
			$(data.response.result_technics.technics).each(function (
				index,
				value
			) {
				tr += "<tr>";
				tr += "<td>" + value.name + "</td>";
				tr += '<td class="text-center">' + value.quantity + "</td>";
				tr += '<td class="text-center">' + value.unit + "</td>";
				tr += '<td class="text-center">' + value.price + "</td>";
				tr += '<td class="text-center">' + value.price_total + "</td>";
				tr += "</tr>";
			});
			$("#tabTechnics tbody").html(tr);

			// $.NotificationApp.send('Увага', data.message, 'top-center', 'rgba(0,0,0,0.2)', data.status === 'SUCCESS' ? 'success' : 'error');
			console.log(data.message);
		})
		.fail(function (data, textStatus, jqXHR) {
			console.log(
				"Щось пішло не так! Можливо не має зв`язку з сервером."
			);
		})
		.always(function (data, textStatus, jqXHR) {
			console.log("Запит закінчено успішно!");
		});
	$("#resourcesModal").on("hidden.bs.modal", function (event) {
		$("#tabMaterials tbody").html("");
		$("#tabMaterials .total-price").html("");
		$("#tabMaterials h3").html("Матеріальні ресурси");

		$("#tabWorkers tbody").html("");
		$("#tabWorkers .total-price").html("");
		$("#tabWorkers h3").html("Людські ресурси");

		$("#tabTechnics tbody").html("");
		$("#tabTechnics .total-price").html("");
		$("#tabTechnics h3").html("Технічні ресурси");

		$("#resourcesModal .modal-body .mdi-spin").parent("div").show();

		$(this).off();
	});

	$("#resourcesModal .modal-body .mdi-spin").parent("div").hide();
	$("#resourcesModal .modal-body .row").show();
}
