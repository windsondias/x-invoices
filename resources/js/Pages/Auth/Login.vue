<template>
    <Main>
        <Head title="Login"/>
        <div class="row login-box d-flex align-items-center justify-content-md-center">
            <div class="col-md-6">
                <h3 class="text-center">Log In</h3>
                <form @submit.prevent="form.post('/login')">
                    <div class="form-floating mb-3">
                        <input type="email" v-model="form.email" class="form-control"
                               :class="form.errors.email ? 'is-invalid': ''" id="floatingInput"
                               placeholder="name@example.com">
                        <label for="floatingInput">Email address</label>
                        <div class="invalid-feedback" v-if="form.errors.email">{{ form.errors.email }}</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" v-model="form.password" class="form-control"
                               :class="form.errors.email ? 'is-invalid': ''" id="floatingPassword"
                               placeholder="Password">
                        <label for="floatingPassword">Password</label>
                        <div class="invalid-feedback" v-if="form.errors.password">{{ form.errors.password }}</div>
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
import {useForm} from '@inertiajs/inertia-vue3'
import {Head} from '@inertiajs/inertia-vue3'

export default {
    name: "Login",
    components: {
        Main,
        Head
    },
    setup() {
        const form = useForm({
            email: null,
            password: null,
            remember: false,
        })

        return {form}
    },
}
</script>

<style scoped>
.login-box {
    height: calc(95vh - 130px);
}
</style>
