var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    /* Toggle between adding and removing the "active" class,
    to highlight the button that controls the panel */
    this.classList.toggle("active");
    var icon = this.childNodes[1];
    
    /* Toggle between hiding and showing the active panel */
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      icon.classList.add("fa-chevron-down");
      icon.classList.remove("fa-chevron-up");
      panel.style.display = "none";
    } else {
      icon.classList.remove("fa-chevron-down");
      icon.classList.add("fa-chevron-up");
      panel.style.display = "block";
    }
  });
}