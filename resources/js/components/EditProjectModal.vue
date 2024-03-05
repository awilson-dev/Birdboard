<template>
    <form @submit.prevent="submit">
        <h1 class="font-normal mb-16 text-center text-2xl">Edit Your Project</h1>

        <div class="flex-1 mr-4">
            <div class="mb-4">
                <label for="title" class="text-sm block mb-2">Title</label>

                <input type="text" class="bg-transparent border rounded p-2 text-xs w-full"
                    :class="form.errors.title ? 'border-error' : 'border-muted'" name="title" placeholder="Title" required
                    v-model="form.title">

                <span class="text-xs italic text-error" v-if="form.errors.title" v-text="form.errors.title[0]"></span>
            </div>

            <div class="mb-4">
                <label for="description" class="text-sm block mb-2">Description</label>

                <textarea name="description" class="bg-transparent border rounded p-2 text-xs w-full"
                    :class="form.errors.description ? 'border-error' : 'border-muted'" style="min-height: 150px" required
                    v-model="form.description"></textarea>

                <span class="text-xs italic text-error" v-if="form.errors.description"
                    v-text="form.errors.description[0]"></span>
            </div>

            <div id="members" class="mb-4" v-if="this.authIsOwner && this.projectMembers.length > 0">
                <label class="text-sm block mb-2">Members</label>

                <div class="mb-2" v-for="member in this.projectMembers">
                    <div class="flex items-center">
                        <img :src="'https://gravatar.com/avatar/' + md5(member.email) + '?s=60&d=https://s3.amazonaws.com/laracasts/images/default-square-avatar.jpg'"
                            :alt="member.name + '\'s avatar'" class="rounded-full w-8 mr-2">

                        <div>
                            <h1 class="text-sm"
                                :class="this.membersToRemove.includes(member.id) ? 'text-muted' : 'text-default'">{{
                                    member.name }}</h1>

                            <p class="text-xs text-muted">{{ member.email }}</p>
                        </div>

                        <button type="button" class="text-xs ml-auto"
                            :class="this.membersToRemove.includes(member.id) ? 'text-muted' : 'text-error'"
                            @click="this.removeMember(member)">{{
                                this.membersToRemove.includes(member.id) ? 'Removed' : 'Remove' }}</button>
                    </div>
                </div>
            </div>
        </div>

        <footer class="mt-auto flex justify-end">
            <button type="button" class="button mr-4 is-outlined" @click="window.closeModal('edit-project')">Cancel</button>

            <button type="submit" class="button">Update Project</button>
        </footer>
    </form>
</template>

<script>
import BirdboardForm from './BirdboardForm';
import axios from "axios";

var submitting = false;

export default {
    data() {
        return {
            // form: {
            //     title: '',
            //     description: ''
            // },

            // errors: {}

            form: new BirdboardForm({
                title: '',
                description: '',
                tasks: []
            })
        };
    },

    methods: {
        async submit() {
            if (!submitting) {
                submitting = true;

                this.form.patch('/projects/' + this.projectId)
                    .catch(error => {
                        submitting = false;
                    })
                    .then(response => {
                        for (let i = 0; i < this.membersToRemove.length; i++) {
                            axios.delete('/projects/' + this.projectId + '/invitations/' + this.membersToRemove[i])
                                .catch(error => {
                                    console.error(error.response.data.message);
                                })
                                .then(response => {
                                    console.log(response);
                                });
                        }

                        location = response.data.message;
                    });
            }
        },

        removeMember(member) {
            this.membersToRemove.push(member.id);
            this.$forceUpdate();
        },

        md5(r) {
            var o, e, n, f = [-680876936, -389564586, 606105819, -1044525330, -176418897, 1200080426, -1473231341, -45705983, 1770035416, -1958414417, -42063, -1990404162, 1804603682, -40341101, -1502002290, 1236535329, -165796510, -1069501632, 643717713, -373897302, -701558691, 38016083, -660478335, -405537848, 568446438, -1019803690, -187363961, 1163531501, -1444681467, -51403784, 1735328473, -1926607734, -378558, -2022574463, 1839030562, -35309556, -1530992060, 1272893353, -155497632, -1094730640, 681279174, -358537222, -722521979, 76029189, -640364487, -421815835, 530742520, -995338651, -198630844, 1126891415, -1416354905, -57434055, 1700485571, -1894986606, -1051523, -2054922799, 1873313359, -30611744, -1560198380, 1309151649, -145523070, -1120210379, 718787259, -343485551], t = [o = 1732584193, e = 4023233417, ~o, ~e], c = [], a = unescape(encodeURI(r)) + "\u0080", d = a.length;
            for (r = --d / 4 + 2 | 15, c[--r] = 8 * d; ~d;) c[d >> 2] |= a.charCodeAt(d) << 8 * d--;
            for (let i = a = 0; i < r; i += 16) {
                for (d = t; 64 > a; d = [n = d[3], o + ((n = d[0] + [o & e | ~o & n, n & o | ~n & e, o ^ e ^ n, e ^ (o | ~n)][d = a >> 4] + f[a] + ~~c[i | 15 & [a, 5 * a + 1, 3 * a + 5, 7 * a][d]]) << (d = [7, 12, 17, 22, 5, 9, 14, 20, 4, 11, 16, 23, 6, 10, 15, 21][4 * d + a++ % 4]) | n >>> -d), o, e]) o = 0 | d[1],
                    e = d[2];
                for (a = 4; a;) t[--a] += d[a];
            }
            for (r = ""; 32 > a;) r += (t[a >> 3] >> 4 * (1 ^ a++) & 15).toString(16);
            return r;
        }
    },

    created() {
        let project = JSON.parse(this.project);

        this.projectId = project.id;

        this.form.title = project.title;
        this.form.description = project.description;

        this.authIsOwner = project.authIsOwner;

        this.projectMembers = project.members;
        for (let i = 0; i < project.members.length; i++) {
            this.projectMembers[i] = {
                'id': project.members[i].id,
                'name': project.members[i].name,
                'email': project.members[i].email
            }
        }

        this.membersToRemove = [];
    },

    props: ['project']
}
</script>
