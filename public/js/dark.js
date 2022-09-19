var checkbox = document.querySelector('nav input[type="checkbox"]'); //get the checkbox to a variable

//check storage if dark mode was on or off
if (localStorage.getItem("mode") == "dark") {
  darkmode(); //if dark mode was on, run this funtion
} else {
  nodark(); //else run this funtion
}

//if the checkbox state is changed, run a funtion
checkbox.addEventListener("change", function() {
  //check if the checkbox is checked or not
  if (checkbox.checked) {
    darkmode(); //if the checkbox is checked, run this funtion
  } else {
    nodark(); //else run this funtion
  }
});

//function for checkbox when checkbox is checked
function darkmode() {
  document.body.classList.add("active"); //add a class to the body tag
  checkbox.checked = true; //set checkbox to be checked state
  localStorage.setItem("mode", "dark"); //store a name & value to know that dark mode is on
}

//function for checkbox when checkbox is not checked
function nodark() {
  document.body.classList.remove("active"); //remove added class from body tag
  checkbox.checked = false; //set checkbox to be unchecked state
  localStorage.setItem("mode", "light"); //store a name & value to know that dark mode is off or light mode is on
}