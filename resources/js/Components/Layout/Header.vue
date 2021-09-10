<template>
    <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white shadow p-3 mb-5 rounded">
        <div class="container">
            <Link class="navbar-brand logo" :href="$route('index')">X-Invoices</Link>
            <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-2">
                <span class="visually-hidden">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navcol-2">
                <ul v-if="user" class="navbar-nav me-auto">
<!--                    <li class="nav-item">-->
<!--                        <Link class="nav-link" :href="$route('home')" :class="{ 'active': $page.url === '/home' }">Home</Link>-->
<!--                    </li>-->
                    <li class="nav-item">
                        <Link class="nav-link" :href="$route('invoices.index')" :class="{ 'active': $page.url === '/invoices' }">Invoices</Link>
                    </li>
                </ul>
                <ul v-else class="navbar-nav me-auto">
                </ul>
                <span v-if="user" class="navbar-text actions">
                    <Link class="btn btn-danger border rounded-pill" :href="$route('logout')" method="post" as="button" type="button">LogOut</Link>
                </span>
                <span v-else class="navbar-text actions">
                    <Link class="login" :href="$route('login')">Log In</Link>
                    <Link class="btn btn-info border rounded-pill" :href="$route('register')" method="get" as="button" type="button">Sign Up</Link>
                </span>
            </div>
        </div>
    </nav>
</template>

<script>
import {Link} from '@inertiajs/inertia-vue3'
import { computed } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'

export default {
    name: "Header",
    components: {
        Link
    },
    setup() {
        const user = computed(() => usePage().props.value.auth.user)
        return { user }
    },
}
</script>

<style scoped>
nav {
    height: 80px;
}
.login{
    margin-right: 16px;
}
</style>
