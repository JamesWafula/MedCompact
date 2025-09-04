<template>
    <div class="flex items-center justify-center h-screen">
        <div>
            <p class="text-4xl bg-primary p-10">
                The error has been submitted successfully
            </p>
        </div>
    </div>
</template>
<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        Link,
    },

    mounted() {
        //timer to redirect to the home page after 10 seconds
        setTimeout(() => {
            this.$inertia.visit("/");
            this.$router.push("/");
        }, 2000);
    },
};
</script>
