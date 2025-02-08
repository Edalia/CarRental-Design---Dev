let car_search_form = document.getElementById("car_search_form");
let search_field = document.getElementById("search_field");

car_search_form.addEventListener("submit", (e) => {
	e.preventDefault();

	search_for_vehicle(search_field.value);
});

function search_for_vehicle(car) {
	alert(car);
}
