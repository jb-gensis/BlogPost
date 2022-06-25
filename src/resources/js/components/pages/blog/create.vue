<template>
    <div class="container">
        <div class="form-content common-mrgn-top">
            <p v-if="errors.length">
                <b>Please correct the following error(s):</b>
                <ul>
                    <li v-for="error in errors" :key="error">{{ error }}</li>
                </ul>
            </p>
            <form @submit.prevent="createPost">
                <h4>Create Post:</h4>
                <div class="form-group">
                    <input type="text" required class="form-control field-input"  placeholder=" " v-model="create.title" required>
                    <label class="form-label" >Title</label>
                </div>
                <div class="form-group">
                    <input type="text" required class="form-control field-input"  placeholder=" " v-model="create.description" required>
                    <label class="form-label" >Description</label>
                </div>
                <button class="btn btn-warning" @click="(()=>{$router.go(-1)})">
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
                create: {
                    title: null,
                    description: null
                },
                errors: [],
                isLoading: false,
            };
        },
        methods: {
            async createPost() {
                this.errors = []
                this.isLoading = true;

                await this.$api.auth.createPost({ 
                    title: this.create.title, 
                    description: this.create.description, 
                }).then(response => {
                    if (response.data.success == true) {
                        this.$router.push({ path: '/dashboard' })
                    } else {
                        this.isLoading = false;
                        this.errors = [];
                        Object.values(response.data.data).forEach(val => this.errors.push(val));
                    }
                }).catch(error => {});
            },
        }
    } 
</script>