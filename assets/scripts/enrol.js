$("#email").on('input', function(){
    let email = $(this).val()
    $.post("../../src/Controllers/enrol.php", {email}, null, null)
        .done((res) => {
            $(".email-error").empty().append(res)
        })
})
$(".submit").click(function () {
    $(".modal .firstname").text($("#firstname").val())
    $(".modal .lastname").text($("#lastname").val())
    $(".modal .othername").text($("#othername").val())
    $(".modal .email").text($("#email").val())
    $(".modal .phone").text($("#phone").val())
    $(".genderR").each(function () {
        if ($(this).prop("checked") == false) return;
        $(".modal .sex").text($(this).val())
    })
    $(".modal .dob").text($("#dob").val())
    $(".modal .admMode").text($("#courses").val())







    $(".modal").addClass("show")
    $(".overlay").addClass("show")
})


$(".overlay").click(function () {
    $(".modal").removeClass("show")
    $(".overlay").removeClass("show")
})
$("#close").click(function(){
    $(".modal").removeClass("show")
    $(".overlay").removeClass("show")
})