export function Course({ name, description, id }) {
	let handleModal = function () {
		let target = $(this).data("target");
		$(target)
			.find(".modalContent .myModal-body")
			.empty()
			.append(`<h3 style="text-align: center;">${name}</h3>`);
		$("body").css({ overflow: "hidden" });
		$(target).addClass("open");
	};
	let course = $(`
	<div class="course">
		<p>Requires Laptop</p>
		<h3 class="course__header">${name}</h3>
		<div class="course__content">
			<p>${description}</p>
		</div>
		<a href="./enrol.html">Enrol now</a>
	</div>
	`);
	course.find(".modalToggler").on("click", handleModal);
	return course;
}
