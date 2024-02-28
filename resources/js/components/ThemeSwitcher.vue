<template>
    <div class="dropdown w-36 mr-2">
        <button @click="window.toggleDropdown('theme');">
            <div class="flex items-center">
                <div class="rounded-full w-4 h-4 bg-default border border-accent mr-2 focus:outline-none"
                    :style="{ backgroundColor: selectedThemeProperties[1] }"></div>

                <p class="text-default text-sm">Theme: {{ selectedThemeProperties[0] }}</p>
            </div>
        </button>

        <div id="theme-dropdown-content" class="dropdown-content">
            <div class="-mt-1 -mb-2">
                <div v-for="(properties, theme) in themes" class="flex items-center cursor-pointer mb-1"
                    @click="selectedTheme = theme; window.toggleDropdown('theme')">
                    <div class="rounded-full w-4 h-4 bg-default border mr-2 focus:outline-none"
                        :class="{ 'border-accent': selectedTheme == theme }" :style="{ backgroundColor: properties[1] }">
                    </div>

                    <p class="text-default">{{ properties[0] }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            themes: {
                'theme-light': ['Light', '#f5f6f9'],
                'theme-dark': ['Dark', '#17181e'],
                'theme-pink': ['Pink', '#e46887'],
                'theme-purple': ['Purple', '#c469e8']
            },
            selectedTheme: 'theme-light'
        }
    },

    computed: {
        selectedThemeProperties() {
            return this.themes[this.selectedTheme] || [];
        }
    },

    created() {
        this.selectedTheme = localStorage.getItem('theme') || 'theme-light';
    },

    watch: {
        selectedTheme() {
            document.body.className = document.body.className.replace(/theme-\w+/, this.selectedTheme);

            localStorage.setItem('theme', this.selectedTheme);
        }
    }
}
</script>
