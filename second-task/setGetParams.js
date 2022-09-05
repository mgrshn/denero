function setGetParams(newGetParams) {
	let newString = '';
	for(key in newGetParams) {
		newString += (newString ? '&' : '') + key + '=' + newGetParams[key];
    }
	return window.location.href + '?' + newString;
}


let obj = {
    name: "Ivan",
    lastName: "Petrov",
    speciality: "doctor",
    yearsOfExperience: 15
}

alert(setGetParams(obj));