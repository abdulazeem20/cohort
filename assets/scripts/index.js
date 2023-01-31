import { Course } from "./components/Course.js";

try {
	let coursesRes = await fetch(
		`${location.origin}/assets/scripts/contents/courses.json`
	);
	let courses = await coursesRes.json();
	courses.forEach((el) => {
		$("#courses").append(Course(el));
	});
} catch (error) {}
