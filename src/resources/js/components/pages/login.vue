<template>
    <div id="login" class="container">
        <div class="btn-selection-form">
            <button type="button" id="log-btn" class="btn btn-primary active" @click="selectForm(true, 'log-btn', 'reg-btn')">Login</button>
            <button type="button" id="reg-btn" class="btn btn-primary" @click="selectForm(false, 'reg-btn', 'log-btn')">Register</button>
        </div>
        <div class="form-content common-mrgn-top" v-if="isLogin">
            <p v-if="log_errors.length">
                <b>Please correct the following error(s):</b>
                <ul>
                    <li v-for="error in log_errors" :key="error">{{ error }}</li>
                </ul>
            </p>
            <form @submit.prevent="login">
                <h4>Log In:</h4>
                <div class="form-group">
                    <input type="email" required class="form-control field-input"  placeholder=" " v-model="login_form.email" required>
                    <label class="form-label" >Email</label>
                </div>
                <div class="form-group">
                    <input type="password" required class="form-control" placeholder=" " v-model="login_form.password" minlength="8" required>
                    <label class="form-label">Password</label>
                </div>
                <button class="btn btn-primary" :disabled="isLoading">
                    <span class="loader" v-if="isLoading"></span>
                    <span v-else>Sign In</span>
                </button>
            </form>
        </div>
        <div id="register-form" class="form-content common-mrgn-top" v-else>
            <p v-if="reg_errors.length">
                <b>Please correct the following error(s):</b>
                <ul>
                    <li v-for="error in reg_errors" :key="error">{{ error }}</li>
                </ul>
            </p>
            <form @submit.prevent="register">
                <h4>Register User:</h4>
                <div class="form-group">
                    <input type="text" class="form-control field-input"  placeholder=" " v-model="register_form.name" required>
                    <label class="form-label" >Name</label>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control field-input"  placeholder=" " v-model="register_form.email" required>
                    <label class="form-label" >Email</label>
                </div>
                <div class="form-group">
                    <input type="password" id="reg-pass" class="form-control" placeholder=" " v-model="register_form.password" minlength="8" required>
                    <label class="form-label">Password</label>
                </div>
                <div class="form-group">
                    <input type="password" id="reg-confirm_pass" class="form-control" placeholder=" " v-model="register_form.confirm_password" minlength="8" required>
                    <label class="form-label">Confirm Password : <span id="error-cpass" v-if="error_confirm_pass">Passwords does not match.</span></label>
                </div>
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
                login_form: {
                    email: null,
                    password: null
                },
                register_form: {
                    name: null,
                    email: null,
                    password: null,
                    confirm_password: null
                },
                log_errors: [],
                reg_errors: [],
                isLoading: false,
                isLogin: true,
                error_confirm_pass: false,
            };
        },
        methods: {
            ...mapActions(['setLogin']),
            async login() {
                this.errors = []
                this.isLoading = true;

                await this.$api.login({ 
                    email: this.login_form.email, 
                    password:this.login_form.password 
                }).then(response => {
                    if (response.data.success == true) {
                        this.setLogin({
                            id: response.data.data.id,
                            email: response.data.data.user,
                            token: response.data.data.token,
                            name: response.data.data.name,
                            isLogin: true,
                        });
                        this.$router.push({ path: '/dashboard' })
                    } else {
                        this.isLoading = false;
                        this.log_errors = [];
                        Object.values(response.data.data).forEach(val => this.log_errors.push(val));
                    }
                }).catch(error => {
                    this.isLoading = false;
                    this.log_errors = [];
                    Object.values(response.data.data).forEach(val => this.log_errors.push(val));
                });
            },
            async register() {
                if (this.validate_confirm_password()) {
                    return true;
                }
                this.errors = []
                this.isLoading = true;

                await this.$api.addUser({ 
                    name: this.register_form.name, 
                    email: this.register_form.email, 
                    password:this.register_form.password,
                    confirm_password:this.register_form.confirm_password 
                }).then(response => {
                    if (response.data.success == true) {
                        this.setLogin({
                            id: response.data.data.id,
                            email: response.data.data.email,
                            token: response.data.data.token,
                            name: response.data.data.name,
                            isLogin: true,
                        });
                        this.$router.push({ path: '/dashboard' })
                    } else {
                        this.isLoading = false;
                        this.reg_errors = [];
                        Object.values(response.data.data).forEach(val => this.reg_errors.push(val));
                    }
                }).catch(error => {});
            },
            selectForm(stats, newId, oldId) {
                this.isLogin = stats;
                document.getElementById(newId).classList.add('active');
                document.getElementById(oldId).classList.remove('active');
            },
            validate_confirm_password() {
                let password = document.getElementById("reg-pass").value;
                let confirmPassword = document.getElementById("reg-confirm_pass").value;

                this.error_confirm_pass = (password != confirmPassword) ? true : false;
                return this.error_confirm_pass;
            }
        }
    }
</script>
