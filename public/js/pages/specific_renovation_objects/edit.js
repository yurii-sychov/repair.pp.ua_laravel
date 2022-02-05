async function addPassportAjax(event) {
	const place_id = $(event.target).data("place_id");
	const is_checked = $(event.target).prop("checked");

	if (!is_checked) {
		$(event.target)[0].checked = true;
	} else {
		const subdivision_id = $(event.target).data("subdivision_id");
		const complete_renovation_object_id = $(event.target).data(
			"complete_renovation_object_id"
		);
		const specific_renovation_object_id = $(event.target).data(
			"specific_renovation_object_id"
		);

		await $.ajax({
			url: "/specific_renovation_objects/store/add_passport_ajax",
			method: "POST",
			headers: {
				"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
			},
			dataType: "json",
			data: {
				subdivision_id,
				complete_renovation_object_id,
				specific_renovation_object_id,
				place_id,
			},
		})
			.done(function (data, textStatus, jqXHR) {
				$.NotificationApp.send(
					"Увага",
					data.message,
					"top-center",
					"rgba(0,0,0,0.2)",
					data.status === "SUCCESS" ? "success" : "error"
				);
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
	}
}

async function uptadeStatusScheduleAjax(event) {
	const schedule_id = $(event.target).data("schedule_id");
	let status;
	const is_checked = $(event.target).prop("checked");

	if (!is_checked) {
		status = 0;
	} else {
		status = 1;
	}
	await $.ajax({
		url: "/specific_renovation_objects/store/update_status_schedule_ajax",
		method: "POST",
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
		},
		dataType: "json",
		data: {
			schedule_id,
			status,
		},
	})
		.done(function (data, textStatus, jqXHR) {
			$.NotificationApp.send(
				"Увага",
				data.message,
				"top-center",
				"rgba(0,0,0,0.2)",
				data.status === "SUCCESS" ? "success" : "error"
			);
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
}
