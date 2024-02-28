import './bootstrap';
import { createApp } from 'vue';

const app = createApp({});

import ThemeSwitcher from './components/ThemeSwitcher.vue';
app.component('theme-switcher', ThemeSwitcher);

import NewProjectModal from './components/NewProjectModal.vue';
app.component('new-project-modal', NewProjectModal);

import EditProjectModal from './components/EditProjectModal.vue';
app.component('edit-project-modal', EditProjectModal);

import resolveConfig from 'tailwindcss/resolveConfig';
import tailwindConfig from '../../tailwind.config.js';

const fullConfig = resolveConfig(tailwindConfig);

// import pageBackground from '../sass/_variables.scss';

app.mount('#app');

app.config.globalProperties.window = window

window.toggleDropdown = function toggleDropdown(name) {
    var dropdown = document.getElementById(name + "-dropdown-content");

    if (dropdown.classList.contains("show")) {
        hideAllDropdowns();
    } else {
        hideAllDropdowns();
        dropdown.classList.add("show");
    }
}

function hideAllDropdowns() {
    let elements = document.getElementsByClassName('dropdown-content');
    for (var i = 0; i < elements.length; i++) {
        elements[i].classList.remove("show");
    }
}

window.onclick = function (event) {
    var hideAll = true;

    let elements = document.getElementsByClassName('dropdown');
    for (var i = 0; i < elements.length; i++) {
        if (elements[i].contains(event.target)) {
            hideAll = false;
        }
    }

    if (hideAll) {
        hideAllDropdowns();
    }

    // MARK: Modals

    hideAll = true;

    elements = document.getElementsByClassName('modal');
    for (var i = 0; i < elements.length; i++) {
        if (
            elements[i].contains(event.target) ||
            event.target.classList.contains('button') ||
            event.target instanceof HTMLButtonElement ||
            event.target instanceof HTMLAnchorElement
        ) {
            hideAll = false;
        }
    }

    if (hideAll) {
        hideAllModals();
    }

    // MARK: Header

    updateHeaderColor();
}

window.onscroll = hideAllDropdowns;

window.showModal = function showModal(name) {
    document.body.classList.add('prevent-scroll');

    var modal = document.getElementById(name + "-modal");

    modal.classList.remove('hidden');

    modal.animate([
        { opacity: 0 },
        { opacity: 100 }
    ], {
        duration: 200,
        iterations: 1
    });
}

window.closeModal = function closeModal(name) {
    document.body.classList.remove('prevent-scroll');

    var modal = document.getElementById(name + "-modal");

    modal.animate([
        { opacity: 100 },
        { opacity: 0 }
    ], {
        duration: 200,
        iterations: 1
    });

    setTimeout(() => {
        modal.classList.add('hidden');
    }, 200);
}

function hideAllModals() {
    let elements = document.getElementsByClassName('modal-background');
    for (var i = 0; i < elements.length; i++) {
        closeModal(elements[i].id.replace('-modal', ''))
    }
}

function updateHeaderColor() {
    let backgroundColor = getComputedStyle(document.body).getPropertyValue('--page-header-color');

    document.querySelector('meta[name="theme-color"]').setAttribute("content", backgroundColor);
}

window.onload = updateHeaderColor;
window.onchange = updateHeaderColor;
