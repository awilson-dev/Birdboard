/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

import ThemeSwitcher from './components/ThemeSwitcher.vue';
app.component('theme-switcher', ThemeSwitcher);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');

app.config.globalProperties.window = window

window.toggleDropdown = function toggleDropdown(name) {
    var dropdown = document.getElementById(name + "-dropdown-content");

    if (dropdown.classList.contains("show")) {
        // dropdown.classList.remove("show");
        hideAllDropdowns();
    } else {
        hideAllDropdowns();
        dropdown.classList.add("show");
    }
}

function hideAllDropdowns() {
    // document.getElementById("-dropdown-content").classList.remove("show");

    let elements = document.getElementsByClassName('dropdown-content');
    for (var i = 0; i < elements.length; i++) {
        elements[i].classList.remove("show");
    }
}

function hideAllDropdownsExcept(id) {
    let elements = document.getElementsByClassName('dropdown-content');
    for (var i = 0; i < elements.length; i++) {
        if (elements[i].id == id) {
            elements[i].classList.remove("show");
        }
    }
}

window.onclick = function (event) {
    // if (!document.getElementsByClassName('dropdown')[0].contains(event.target)) {
    //     hideDropdowns();
    // }

    var hideAll = true;

    let elements = document.getElementsByClassName('dropdown');
    for (var i = 0; i < elements.length; i++) {
        if (elements[i].contains(event.target)) {
            hideAll = false;
            // hideAllDropdownsExcept(elements[i].getElementsByClassName('dropdown-content')[0].id);
        }

        console.log(i);
    }

    if (hideAll) {
        hideAllDropdowns();
    }
}

window.onscroll = hideAllDropdowns;
