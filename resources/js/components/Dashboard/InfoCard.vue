<template>
    <div class="rounded-xl shadow-xl text-white p-5">
        <h3 class="font-bold text-xl capitalize">{{ title }}</h3>
        <p class="font-bold text-4xl capitalize">
            {{ value }}
            <span v-if="secondaryValue"> : {{ secondaryValue }}</span>
        </p>
    </div>
</template>

<script>
export default {
    name: "InfoCard",
    props: {
        title: String,
        value: String,
        secondaryValue: String,
    },
};
</script>
