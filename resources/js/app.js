import './bootstrap';

window.toggleDropdown = function toggleDropdown() {
    var dropdown = document.getElementById("dropdown-content");

    if (dropdown.classList.contains("show")) {
        dropdown.classList.remove("show");
    } else {
        dropdown.classList.add("show");
    }
}

function hideDropdown() {
    document.getElementById("dropdown-content").classList.remove("show");
}

window.onclick = function (event) {
    if (!document.getElementsByClassName('dropdown')[0].contains(event.target)) {
        hideDropdown();
    }
}

window.onscroll = hideDropdown;
