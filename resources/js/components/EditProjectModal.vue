<template>
    <form @submit.prevent="submit">
        <h1 class="font-normal mb-16 text-center text-2xl">Edit Your Project</h1>

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

        <footer class="mt-auto flex justify-end">
            <button type="button" class="button mr-4 is-outlined" onclick="closeModal('edit-project')">Cancel</button>

            <button type="submit" class="button">Update Project</button>
        </footer>
    </form>
</template>

<script>
export default {
    data() {
        return {
            form: {
                title: '',
                description: ''
            },

            errors: {}
        };
    },

    methods: {
        async submit() {
            try {
                let response = await axios.patch("projects/23", this.form);

                location = response.data.message;
            } catch (error) {
                this.errors = error.response.data.errors;
            }
        }
    },

    created() {
        let project = JSON.parse(this.project);

        this.projectId = project.id;

        this.form.title = project.title;
        this.form.description = project.description;
    },

    props: ['project']
}
</script>
