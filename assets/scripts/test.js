let points = 4;
let score = 0;
let min = 15;
let sec = "00";
try {
	let questionsRes = await fetch(
		`${location.origin}/assets/scripts/contents/question.json`
	);
	let questions = await questionsRes.json();
	let shuffledQuestions = getQuestion(questions, 25);
	$(".head").prepend(timer({ min, sec }));
	shuffledQuestions.forEach((el, i) => {
		let index = ++i;
		$("form").append(test({ ...el, index }));
		$("footer").append(`
                <button type="button" class="index ${
					index == 1 && "active"
				}" data-index="${index}" >${index}</button>
        `);
	});
} catch (error) {}

function test({ question, options, answer, index }) {
	return $(`
    <div class="test ${index == 1 && "active"}" data-answer="${md5(
		answer
	)}" data-index="${index}">
        <div class="question">
            <h3 class="title">Question ${index}</h3>
            <h4 class="main_question">${question}</h4>
        </div>
        <div class="options">
            ${options
				.map((opt, i) => option({ opt, index: ++i, answer }))
				.join(" ")}
        </div>
    </div>;
        `);
}

function option({ index, opt }) {
	return `<button class="option" type="button">
        <span class="index">${index}</span>
        <span  class="answer">${opt}</span>
    </button>`;
}
function getQuestion(questions, index) {
	return [...questions].sort(() => Math.random() - 0.5).slice(0, index);
}

$("footer .index").on("click", function () {
	let index = $(this).data("index");
	let target = [...$(".test")].filter((el) => $(el).data("index") == index);
	$(target).addClass("active").siblings().removeClass("active");
	$(this).addClass("active").siblings().removeClass("active");
});

$(".option").on("click", function () {
	if ($(this).hasClass("selected")) return;
	let me = $(this);
	let answer = $(this).parents(".test").data("answer");
	let index = $(this).parents(".test").data("index");
	let previousSelected = [...$(this).siblings()].filter((el) =>
		$(el).hasClass("selected")
	);
	if (answer == md5(Number($(previousSelected).find(".index").text())))
		score -= points;
	if (answer == md5(Number(me.find(".index").text()))) score += points;

	let target = [...$(".index")].filter((el) => $(el).data("index") == index);
	$(target).addClass("answered");
	$(this).addClass("selected").siblings().removeClass("selected");

	setTimeout(() => {
		++index;
		let allQuestions = $(".test").length;
		if (++allQuestions == index) index = 1;
		me.parents(".test").removeClass("active");
		let target = [...$(".test")].filter(
			(el) => $(el).data("index") == index
		);
		let IndexTarget = [...$("footer .index")].filter(
			(el) => $(el).data("index") == index
		);
		$(IndexTarget).addClass("active").siblings().removeClass("active");
		$(target).addClass("active");
	}, 1000);
});
let testTimeout = setInterval(async () => {
	$(".head").children().not(".modalToggler").remove();
	sec = Number(sec) - 1;
	if (sec < 0 && min > 0) {
		sec = 59;
		min--;
	} else if (sec == 0 && min == 0) {
		clearInterval(testTimeout);
		await updateScore();
	}
	$(".head").prepend(timer({ min, sec }));
}, 1000);

function timer({ min, sec }) {
	return $(`
        <button class="timer ${
			min < 5 && "timerUp"
		}" type="button"><span class="min">${min}</span>:<span class="sec">${
		String(sec).length == 1 ? "0" + sec : sec
	}</span></button>
    `);
}

$(".submit").on("click", async function () {
	await updateScore();
});

async function updateScore() {
	let data = { score, saveScore: true };
	try {
		let update = await $.post(
			`${location.origin}/src/request.php`,
			data,
			null,
			"json"
		);
		update.status == true ? (location.href = "login.php") : "";
	} catch (error) {}
}
