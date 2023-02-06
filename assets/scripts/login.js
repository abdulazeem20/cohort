$("#login").on("submit", async function (e) {
	e.preventDefault();
	let data = new FormData(this);
	data.append("login", true);
	try {
		let login = await $.ajax({
			type: "POST",
			url: `${location.origin}/src/request.php`,
			data: data,
			dataType: "JSON",
			contentType: false,
			processData: false,
			cache: false,
		});
		$("form").find(".alert").remove();
		if (login.status == "success") {
			location.href = "test.php";
		} else {
			$("form").append(errorMsg({ ...login, className: "error" }));
		}
	} catch (error) {
		console.error(error.responseText);
	}
});
function errorMsg({ msg, className }) {
	return `
            <p class="${className} alert">${msg}</p>
    `;
}
