<template>
    <header class="body-font shadow-xl py-4 fixed z-50 w-full top-0 bg-white">
        <div
            class="container mx-auto flex justify-between items-center px-4 md:px-0"
        >
            <a class="flex title-font font-medium items-center text-gray-900">
                <img class="h-10" src="/images/knh_logo.png" alt="Logo" />
                <span class="ml-3 font-bold capitalize"
                    >Medical Error Reporting Tool
                </span>
            </a>
            <nav class="font-bold capitalize hover:text-gray-600">
                <Link
                    v-if="$page.props.user"
                    class=""
                    :href="route('dashboard')"
                >
                    dashboard
                </Link>
                <Link v-else class="" :href="route('login')"> login </Link>
            </nav>
        </div>
    </header>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
export default {
    components: {
        Link,
    },
};
</script>

<style></style>
