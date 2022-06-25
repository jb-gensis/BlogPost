<template>
    <div class="container">
        <div class="form-content common-mrgn-top">
            <p v-if="errors.length">
                <b>Please correct the following error(s):</b>
                <ul>
                    <li v-for="error in errors" :key="error">{{ error }}</li>
                </ul>
            </p>
            <form @submit.prevent="editPost">
                <h4>Edit Post:</h4>
                <div class="form-group">
                    <input type="text" required class="form-control field-input"  placeholder=" " v-model="form.title" required>
                    <label class="form-label" >Title</label>
                </div>
                <div class="form-group">
                    <input type="text" required class="form-control field-input"  placeholder=" " v-model="form.description" required>
                    <label class="form-label" >Description</label>
                </div>
                <button class="btn btn-warning" @click="(()=>{$router.push({ path: '/myposts' })})">
                    <span>Cancel</span>
                </button>
                <button class="btn btn-primary" :disabled="isLoading">
                    <span class="loader" v-if="isLoading"></span>
                    <span v-else>Submit</span>
                </button>
            </form>
        </div>
    </div>
</template>

<script>
    import { mapActions } from 'vuex';
    export default {
        data() {
            return {
                form: {
                    id: null,
                    title: null,
                    description: null,
                },
                errors: [],
                isLoading: false,
            };
        },
        methods: {
            async editPost() {
                this.errors = []
                this.isLoading = true;

                await this.$api.auth.editPost({ 
                    title: this.form.title, 
                    description: this.form.description, 
                }, this.form.id ).then(response => {
                    if (response.data.success == true) {
                        this.$router.push({ path: '/dashboard' })
                    } else {
                        this.isLoading = false;
                        this.errors = [];
                        Object.values(response.data.data).forEach(val => this.errors.push(val));

                    }
                }).catch(error => {});
            },
        },
        async mounted() {
            if(!this.$route.params.id){
                this.$router.go(-1);
            }

            await this.$api.auth.getPostByBlogId(this.$route.params.id).then(response => {
                let post = response.data.data;
                this.form.id = post.id;
                this.form.title = post.title;
                this.form.description = post.description;
            })
        }
    } 
</script>