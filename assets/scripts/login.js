$("#login").on("submit", async function (e)
{
	e.preventDefault();
	$(".start").addClass("disabled")
	$(".start").prop({ disabled: true })
	$(".start").text("Please Wait...")
	let data = new FormData(this);
	data.append("login", true);
	try
	{
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
		if (login.status == "success")
		{
			// location.href = "test.php";
			$("#login").addClass("hide")
			$(".after_login").addClass("show")
		} else
		{
			$("form").append(errorMsg({ ...login, className: "error" }));
			$(".start").empty().append(`Start<i class="fas fa-sign-in-alt"></i>`)
			$(".start").removeClass("disabled")
			$(".start").prop({ disabled: false })
		}
	} catch (error)
	{
		console.error(error.responseText);
	}
});
function errorMsg({ msg, className })
{
	return `
            <p class="${className} alert">${msg}</p>
    `;
}
$(".final").click(() => location.reload())
