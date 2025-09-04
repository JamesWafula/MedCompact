<template>
  <div class="card">
    <div class="flex justify-between">
      <h3 class="fieldTitle">location</h3>
      <button
        @click="isDialogueOpen = !isDialogueOpen"
        class="bg-green-300 hover:bg-green-500 w-9 h-9 font-bold text-xl flex items-center justify-center text-white rounded-lg"
      >
        +
      </button>
    </div>

    <TransitionRoot appear :show="isDialogueOpen" as="template">
      <Dialog as="div" class="relative z-10">
        <TransitionChild
          as="template"
          enter="duration-300 ease-out"
          enter-from="opacity-0"
          enter-to="opacity-100"
          leave="duration-200 ease-in"
          leave-from="opacity-100"
          leave-to="opacity-0"
        >
          <div class="fixed inset-0 bg-black bg-opacity-25" />
        </TransitionChild>

        <div class="fixed inset-0 overflow-y-auto">
          <div
            class="flex min-h-full items-center justify-center p-4 text-center"
          >
            <TransitionChild
              as="template"
              enter="duration-300 ease-out"
              enter-from="opacity-0 scale-95"
              enter-to="opacity-100 scale-100"
              leave="duration-200 ease-in"
              leave-from="opacity-100 scale-100"
              leave-to="opacity-0 scale-95"
            >
              <DialogPanel
                class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
              >
                <DialogTitle
                  as="h3"
                  class="text-lg font-medium leading-6 text-gray-900 flex justify-between items-center mb-4"
                >
                  <span>location</span>
                  <button
                    @click="isDialogueOpen = !isDialogueOpen"
                    class="bg-red-300 hover:bg-red-500 w-9 h-9 font-bold flex items-center justify-center text-white rounded-lg"
                  >
                    X
                  </button>
                </DialogTitle>
                <div class="mt-2">
                  <form class="mt-2" @submit.prevent="addItem">
                    {{ form.user }}
                    <input
                      type="text"
                      class="errorFormInput"
                      placeholder="Location"
                      v-model="form.location"
                    />
                    <p class="text-xs text-red-700 font-bold">error</p>

                    <button
                      type="submit"
                      class="bg-primary hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md mt-4"
                    >
                      Submit
                    </button>
                  </form>
                </div>
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </Dialog>
    </TransitionRoot>

    <div>
      <ul class="chips w-full">
        <li
          class="chip flex"
          v-for="chip in get_locationsData"
          :key="chip.item"
        >
          <div class="flex gap-x-2">
            <div>{{ chip.item }}</div>
            <div>
              <button
                type="submit"
                @click="deleteConfirmationDialog = !deleteConfirmationDialog"
                class="chipDeleteButton"
              >
                x
              </button>
            </div>
            <TransitionRoot
              appear
              :show="deleteConfirmationDialog"
              as="template"
            >
              <Dialog as="div" class="relative z-10">
                <TransitionChild
                  as="template"
                  enter="duration-300 ease-out"
                  enter-from="opacity-0"
                  enter-to="opacity-100"
                  leave="duration-200 ease-in"
                  leave-from="opacity-100"
                  leave-to="opacity-0"
                >
                  <div class="fixed inset-0 bg-black bg-opacity-25" />
                </TransitionChild>

                <div class="fixed inset-0 overflow-y-auto">
                  <div
                    class="flex min-h-full items-center justify-center p-4 text-center"
                  >
                    <TransitionChild
                      as="template"
                      enter="duration-300 ease-out"
                      enter-from="opacity-0 scale-95"
                      enter-to="opacity-100 scale-100"
                      leave="duration-200 ease-in"
                      leave-from="opacity-100 scale-100"
                      leave-to="opacity-0 scale-95"
                    >
                      <DialogPanel
                        class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
                      >
                        <DialogTitle
                          as="h3"
                          class="text-lg font-medium leading-6 text-gray-900 flex justify-between items-center mb-4"
                        >
                          <span
                            >Are you sure you want to delete this action is
                            irreversible</span
                          >
                        </DialogTitle>
                        <div class="mt-2 flex gap-3">
                          <button
                            type="submit"
                            class="bg-red-400 hover:bg-red-500 text-white font-bold py-2 px-4 rounded-md mt-4"
                            @click="
                              deleteConfirmationDialog =
                                !deleteConfirmationDialog
                            "
                          >
                            Go back
                          </button>
                          <form
                            class="mt-2"
                            @submit.prevent="deleteItem(chip.id)"
                          >
                            <button
                              type="submit"
                              class="bg-primary hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md mt-4"
                            >
                              Submit
                            </button>
                          </form>
                        </div>
                      </DialogPanel>
                    </TransitionChild>
                  </div>
                </div>
              </Dialog>
            </TransitionRoot>
          </div>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import FormInputContainer from "@/components/ErrorForm/FormInputContainer.vue";
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogPanel,
  DialogTitle,
} from "@headlessui/vue";
import { useForm } from "@inertiajs/inertia-vue3";

export default {
  data() {
    return {
      isDialogueOpen: false,
      form: useForm({
        location: "",
      }),
      deleteConfirmationDialog: false,
      deleteConfimation: true,
    };
  },
  components: {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
  },
  methods: {
    addItem() {
      this.form.post(route("errorfields.location"));
      this.isDialogueOpen = false;
      this.form.location = "";
    },
    confrimDeletion() {
      this.deleteConfimation = true;
    },
    deleteItem(id) {
      this.deleteConfimation = true;
      if (this.deleteConfimation) {
        this.$inertia.delete(route("deletelocation", id));
        this.deleteConfirmationDialog = false;
      }
    },
  },
  computed: {
    get_locationsData: function () {
      const data = this.all_locations;
      let filteredData = [];
      if (data) {
        filteredData = data.map((item) => {
          return { id: item.id, item: item.location };
        });
      }

      return filteredData;
    },
  },
  props: {
    all_locations: Array,
  },
};
</script>
