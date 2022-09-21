<template>
    <nav v-if="links.length > 3" aria-label="Page navigation example">
        <ul class="pagination">
            <template v-for="(link, key) in links">
                <li v-if="link.url === null" :key="key"  class="page-item" :class="{ 'disabled': link.url === null }"><a class="page-link" href="#" v-html="link.label"></a></li>
                <li v-else :key="`link-${key}`" class="page-item" :class="{ 'active': link.active }">
                    <Link  class="page-link" :href="link.url" v-html="link.label" />
                </li>
            </template>
        </ul>
    </nav>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
export default {
    components: {
        Link,
    },
    props: {
        links: Array,
    },
}
</script>
