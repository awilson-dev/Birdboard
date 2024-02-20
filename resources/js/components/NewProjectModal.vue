<template>
    <!-- <x-modal id="new-project" class="p-10 lg:w-1/2 text-default"> -->
    <form @submit.prevent="submit">
        <h1 class="font-normal mb-16 text-center text-2xl">Let's Start Something New</h1>

        <div class="flex">
            <div class="flex-1 mr-4">
                <div class="mb-4">
                    <label for="title" class="text-sm block mb-2">Title</label>

                    <input type="text" class="bg-transparent border rounded p-2 text-xs w-full"
                        :class="errors.title ? 'border-error' : 'border-muted'" name="title" placeholder="Title" required
                        v-model="form.title">

                    <span class="text-xs italic text-error" v-if="errors.title" v-text="errors.title[0]"></span>
                </div>

                <div class="mb-4">
                    <label for="description" class="text-sm block mb-2">Description</label>

                    <textarea name="description" class="bg-transparent border rounded p-2 text-xs w-full"
                        :class="errors.description ? 'border-error' : 'border-muted'" style="min-height: 150px" required
                        v-model="form.description"></textarea>

                    <span class="text-xs italic text-error" v-if="errors.description" v-text="errors.description[0]"></span>
                </div>
            </div>

            <div class="flex-1 ml-4">
                <div class="mb-2">
                    <label class="text-sm block mb-2">Need Some Tasks?</label>
                    <input type="text" class="bg-transparent border border-muted rounded mb-2 p-2 text-xs w-full"
                        placeholder="Task 1" v-for="task in form.tasks" v-model="task.value">
                </div>

                <button class="inline-flex items-center text-xs text-muted" @click="addTask">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                        class="mr-2 fill-current">
                        <g fill="none" fill-rule="evenodd" opacity=".75">
                            <path stroke="#000" stroke-opacity=".012" stroke-width="0" d="M-3-3h24v24H-3z"></path>
                            <path class="fill-current"
                                d="M9 0a9 9 0 0 0-9 9c0 4.97 4.02 9 9 9A9 9 0 0 0 9 0zm0 16c-3.87 0-7-3.13-7-7s3.13-7 7-7 7 3.13 7 7-3.13 7-7 7zm1-11H8v3H5v2h3v3h2v-3h3V8h-3V5z">
                            </path>
                        </g>
                    </svg>

                    <span>Add New Task Field</span>
                </button>
            </div>
        </div>

        <footer class="mt-auto flex justify-end">
            <button class="button mr-4 is-outlined" onclick="closeModal('new-project')">Cancel</button>

            <button class="button" onclick="">Create Project</button>
        </footer>
    </form>
    <!-- </x-modal> -->
</template>

<script>
export default {
    data() {
        return {
            form: {
                title: '',
                description: '',
                tasks: [
                    { value: '' }
                ]
            },

            errors: {}
        };
    },

    methods: {
        addTask() {
            this.form.tasks.push({ value: '' });
        },

        async submit() {
            try {
                let response = await axios.post('/projects', this.form);
                
                location = response.data.message;
            } catch (error) {
                this.errors = error.response.data.errors;
            }
        }
    }
}
</script>
