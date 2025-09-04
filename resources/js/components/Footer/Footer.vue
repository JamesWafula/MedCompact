<template>
    <footer class="bg-primary font-bold py-6 text-white text-center">
        Copyright {{ new Date().getFullYear() }}. Medical Error Tool. All rights reserved.
    </footer>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
export default {
    components: {
        Link,
    },
};
</script>
