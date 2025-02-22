/**
 * toJSON - return date in 'yyy-mm-dd' after slicing first 10 characters
 */
let dateToday = new Date().toJSON().slice(0, 10);

const current_date = document
	.getElementById("pickup")
	.setAttribute("min", dateToday);

/***
 * When pickup date is selected, use this date as earliest date for return
 * Prevents user from selecting a return date earlier than date of pickup
 */
function date_duration(e) {
	document.getElementById("return").setAttribute("min", e.target.value);
}
