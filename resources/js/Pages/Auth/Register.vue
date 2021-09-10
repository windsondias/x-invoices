<template>
    <Main>
        <Head title="Register" />
        <div class="row login-box d-flex align-items-center justify-content-md-center">
            <div class="col-md-6">
                <h3 class="text-center">Sign In</h3>
                <form @submit.prevent="form.post('/register')">
                    <div class="form-floating mb-3">
                        <input type="text" v-model="form.name" class="form-control" :class="form.errors.name ? 'is-invalid': ''" id="name">
                        <label for="name">Name</label>
                        <div class="invalid-feedback" v-if="form.errors.name">{{ form.errors.name }}</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" v-model="form.email" class="form-control" :class="form.errors.email ? 'is-invalid': ''" id="email">
                        <label for="email">Email address</label>
                        <div class="invalid-feedback" v-if="form.errors.email">{{ form.errors.email }}</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" v-model="form.password" class="form-control" :class="form.errors.password ? 'is-invalid': ''" id="password">
                        <label for="password">Password</label>
                        <div class="invalid-feedback" v-if="form.errors.password">{{ form.errors.password }}</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" v-model="form.password_confirmation" class="form-control" :class="form.errors.password_confirmation ? 'is-invalid': ''" id="password_confirmation">
                        <label for="password_confirmation">Password Confirmation</label>
                        <div class="invalid-feedback" v-if="form.errors.password_confirmation">{{ form.errors.password_confirmation }}</div>
                    </div>
                    <div class="d-grid gap-2 mb-3">
                        <button class="btn btn-info" :disabled="form.processing" type="submit">Log In</button>
                    </div>
                </form>

            </div>
        </div>
    </Main>
</template>

<script>
import Main from "../../Components/Layout/Main";
import { useForm } from '@inertiajs/inertia-vue3'
import { Head } from '@inertiajs/inertia-vue3'

export default {
    name: "Register",
    components: {
        Main,
        Head
    },
    setup () {
        const form = useForm({
            name: null,
            email: null,
            password: null,
            password_confirmation: null,
        })

        return { form }
    },
}
</script>

<style scoped>
.login-box{
    height: calc(95vh - 160px);
}
</style>
