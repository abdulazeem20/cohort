$(".modalToggler").each((i, el) => {
	$(el).on("click", function () {
		let target = $(this).data("target");
		$("body").css({ overflow: "hidden" });
		$(target).addClass("open");
	});
});
$(".modal-close").each((i, el) => {
	$(el).on("click", function () {
		$("body").css({ "overflow-y": "auto" });
		$(this).parents(".myModal").removeClass("open");
	});
});
$(window).on("click", (e) => {
	if ($(e.target).hasClass("myModal")) {
		$("body").css({ "overflow-y": "auto" });
		$(e.target).removeClass("open");
	}
});
