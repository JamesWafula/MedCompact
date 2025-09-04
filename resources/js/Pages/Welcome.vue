<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import Navbar from "./../components/Navbar/Navbar.vue";
import ErrorForm from "./../components/ErrorForm/ErrorForm.vue";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    incident: Array,
    locations: Array,
    occupations: Array,
    outcomes: Array,
    possible_factors: Array,
    preventability: Array,
    type_of_error: Array,
    specific_location: Array,
});
</script>

<template>
    <!-- the title that appers on the browser tab -->
    <Head title="Error-form" />

    <!-- the navigation bar  -->
    <Navbar />

    <!-- the error form compponent -->
    <main class="container mx-auto mt-24 bg-gray-200 rounded p-6">
        <ErrorForm
            :incident="incident"
            :locations="locations"
            :occupations="occupations"
            :outcomes="outcomes"
            :possible_factors="possible_factors"
            :preventability="preventability"
            :type_of_error="type_of_error"
            :specific_location="specific_location"
        />
    </main>
</template>
