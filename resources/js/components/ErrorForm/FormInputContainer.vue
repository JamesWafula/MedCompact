<template>
  <div class="flex flex-col">
    <label
      for=""
      class="flex justify-between text-gray-700 font-medium text-xs mb-4"
    >
      <span class="">{{ inputLabel }} </span>
      <span class="text-gray-600">{{ inputDescription }}</span></label
    >
    <slot />
  </div>
</template>

<script>
export default {
  props: {
    inputLabel: {
      type: String,
      required: true,
    },
    inputDescription: {
      type: String,
      required: true,
    },
  },
};
</script>

<style></style>
