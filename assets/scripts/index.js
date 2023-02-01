import { Course } from "./components/Course.js";

try {
	let coursesRes = await fetch(
		`${location.origin}/assets/scripts/contents/courses.json`
	);
	let courses = await coursesRes.json();
	console.log(courses);
	courses.forEach((el) => {
		$("#courses .courses__container").append(Course(el));
	});
} catch (error) {}
