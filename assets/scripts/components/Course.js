export function Course({
	name,
	description,
	mini_info,
	pt,
	ft,
	duration,
	tuition,
}) {
	let handleModal = function () {
		let target = $(this).data("target");
		$(target)
			.find(".modalContent .myModal-body")
			.empty()
			.append(
				modalContent({ description, name, pt, ft, duration, tuition })
			);
		$("body").css({ overflow: "hidden" });
		$(target).addClass("open");
	};
	let course = $(`
	<div class="course">
		<p>Requires Laptop</p>
		<h3 class="course__header">${name}</h3>
		<div class="course__content">
			<p>${mini_info}</p>
			<button type="button" data-target="#courseModal" class="modalToggler">Read More ...</button>
		</div>
		<a href="./enrol.html">enrol now</a>
	</div>
	`);
	course.find(".modalToggler").on("click", handleModal);
	return course;
}

function modalContent({ description, name, pt, ft, duration, tuition }) {
	return $(`
		<div class="head">
			<h2>${name}</h2>
		</div>
		<div class="content">
			<p>
				${description}
			</p>
		</div>
		<div class="foot">
			<div>
				<h3>Course Duration: </h3>
				<p>${duration}</p>
			</div>
			<div>
				<h3>Full Time Class: </h3>
				<p>${ft}</p>
			</div>
			<div>
				<h3>Part Time Class: </h3>
				<p>${pt}</p>
			</div>
			<div class="tail">
				<div class="amount">
					<h3>Tuition: </h3>
					<p>₦ ${new Intl.NumberFormat().format(tuition)}</p>
				</div>
				<a href="enrol.html">enrol now</a>
			</div>
		</div>
	`);
}
