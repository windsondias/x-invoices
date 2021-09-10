<template>
    <div>
        <Header></Header>
        <main class="content py-4">
            <section>
                <div class="container">
                    <slot></slot>
                </div>
            </section>
        </main>
        <Footer></Footer>
    </div>
</template>

<script>
import Header from "./Header";
import Footer from "./Footer";

export default {
    name: "Main",
    components: {
        Header,
        Footer
    }
}
</script>

<style scoped>
.content {
    background-color: #f6f6f6;
    margin-top: 80px;
    min-height: calc(100vh - 130px);
}
</style>
