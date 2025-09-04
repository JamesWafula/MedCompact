<template>
    <div class="flex flex-col card">
        <div class="flex justify-between">
            <h1 class="fieldTitle">
                {{ sectionTitle }}
            </h1>

            <div v-if="!secondaryTitle">
                <button
                    @click="isDialogueOpen = !isDialogueOpen"
                    v-if="account_type === 'root' || account_type === 'admin'"
                    class="bg-green-500 text-white px-4 rounded hover:bg-green-600 py-1 inline-flex"
                >
                    Add new
                </button>
                <!-- the add fields button -->

                <TransitionRoot
                    appear
                    :show="isDialogueOpen"
                    v-if="account_type === 'root' || account_type === 'admin'"
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
                                            <span>{{ dialogTitle }}</span>
                                            <button
                                                @click="
                                                    isDialogueOpen =
                                                        !isDialogueOpen
                                                "
                                                class="bg-red-300 hover:bg-red-500 w-9 h-9 font-bold flex items-center justify-center text-white rounded-lg"
                                            >
                                                X
                                            </button>
                                        </DialogTitle>
                                        <div class="mt-2">
                                            <form
                                                class="mt-2"
                                                @submit.prevent="addItem"
                                            >
                                                {{ form.user }}
                                                <input
                                                    type="text"
                                                    class="errorFormInput"
                                                    :placeholder="dialogTitle"
                                                    v-model="form.fielditem"
                                                />
                                                <p
                                                    class="text-xs text-red-700 font-bold"
                                                >
                                                    error
                                                </p>

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

            <!-- adding the secondary item -->

            <div v-if="secondaryTitle">
                <button
                    @click="isDialogueOpen = !isDialogueOpen"
                    v-if="account_type === 'root' || account_type === 'admin'"
                    :disabled="selectedSecondaryItem === ''"
                    :class="{
                        'bg-gray-200 text-white ': selectedSecondaryItem === '',
                        'bg-green-500 text-white  hover:bg-green-600 ':
                            selectedSecondaryItem !== '',
                    }"
                    class="px-4 rounded py-1 inline-flex"
                >
                    Add new
                </button>
                <!-- the add fields button -->

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
                                            <span>{{ dialogTitle }}</span>
                                            <button
                                                @click="
                                                    isDialogueOpen =
                                                        !isDialogueOpen
                                                "
                                                class="bg-red-300 hover:bg-red-500 w-9 h-9 font-bold flex items-center justify-center text-white rounded-lg"
                                            >
                                                X
                                            </button>
                                        </DialogTitle>
                                        <div class="mt-2">
                                            <form
                                                class="mt-2"
                                                @submit.prevent="
                                                    addSecondaryItem
                                                "
                                            >
                                                {{ form.user }}
                                                <!-- hidden input -->

                                                <input
                                                    type="text"
                                                    class="errorFormInput"
                                                    :placeholder="dialogTitle"
                                                    v-model="myform.fielditem"
                                                />
                                                <p
                                                    class="text-xs text-red-700 font-bold"
                                                >
                                                    error
                                                </p>

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
        </div>

        <div class="flex gap-x-2 items-center" v-if="secondaryTitle">
            <div>
                Select
                {{ secondaryTitle }} first
            </div>
            <div class="flex-1">
                <select
                    name="gender"
                    id="gender"
                    class="errorFormInput"
                    v-model="selectedSecondaryItem"
                    placeholder="select"
                >
                    <option
                        v-for="secondaryItem in secondaryField"
                        :value="secondaryItem.id"
                        :key="secondaryItem.id"
                    >
                        {{ secondaryItem.item }}
                    </option>
                </select>
            </div>
        </div>

        <div v-if="secondaryTitle" class="overflow-x-auto">
            <div class="py-2 inline-block min-w-full">
                <div class="overflow-hidden">
                    <table class="min-w-full">
                        <thead class="bg-white border-b capitalize">
                            <tr>
                                <th
                                    scope="col"
                                    class="text-sm font-bold text-gray-900 px-6 py-2 text-left"
                                >
                                    id
                                </th>
                                <th
                                    scope="col"
                                    class="text-sm font-bold text-gray-900 px-6 py-2 text-left"
                                >
                                    {{ sectionTitle }}
                                </th>

                                <th
                                    scope="col"
                                    class="text-sm font-bold text-gray-900 px-6 py-2 text-left"
                                >
                                    {{ secondaryTitle }} ID
                                </th>

                                <th
                                    scope="col"
                                    v-if="
                                        account_type === 'root' ||
                                        account_type === 'admin'
                                    "
                                    class="text-sm font-bold text-gray-900 px-6 py-2 text-left"
                                >
                                    delete
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                class="border-b even:bg-white odd:bg-gray-200"
                                v-for="field in filteredFieldsData"
                                :key="field.id"
                            >
                                <td class="tableData">{{ field.id }}</td>
                                <td class="tableData">{{ field.item }}</td>
                                <td class="tableData">
                                    {{ field.secondary_item_id }}
                                </td>
                                <td class="tableData">
                                    <button
                                        type="submit"
                                        v-if="
                                            account_type === 'root' ||
                                            account_type === 'admin'
                                        "
                                        @click="deleteItem(field.id)"
                                        class="bg-red-500 text-white px-4 rounded hover:bg-red-600 py-1"
                                    >
                                        Delete
                                    </button>
                                    <!-- the delete popup -->
                                    <TransitionRoot
                                        v-if="
                                            account_type === 'root' ||
                                            account_type === 'admin'
                                        "
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
                                                <div
                                                    class="fixed inset-0 bg-black bg-opacity-25"
                                                />
                                            </TransitionChild>

                                            <div
                                                class="fixed inset-0 overflow-y-auto"
                                            >
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
                                                                    >Are you
                                                                    sure you
                                                                    want to
                                                                    delete this
                                                                    field, the
                                                                    action is
                                                                    irreversible</span
                                                                >
                                                            </DialogTitle>
                                                            <div
                                                                class="mt-2 flex gap-3"
                                                            >
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
                                                                <button
                                                                    type="submit"
                                                                    class="bg-primary hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md mt-4"
                                                                    @click="
                                                                        confrimDeletion()
                                                                    "
                                                                >
                                                                    Delete
                                                                </button>
                                                            </div>
                                                        </DialogPanel>
                                                    </TransitionChild>
                                                </div>
                                            </div>
                                        </Dialog>
                                    </TransitionRoot>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div v-else class="overflow-x-auto">
            <div class="py-2 inline-block min-w-full">
                <div class="overflow-hidden">
                    <table class="min-w-full">
                        <thead class="bg-white border-b capitalize">
                            <tr>
                                <th
                                    scope="col"
                                    class="text-sm font-bold text-gray-900 px-6 py-2 text-left"
                                >
                                    id
                                </th>
                                <th
                                    scope="col"
                                    class="text-sm font-bold text-gray-900 px-6 py-2 text-left"
                                >
                                    {{ sectionTitle }}
                                </th>

                                <th
                                    scope="col"
                                    v-if="
                                        account_type === 'root' ||
                                        account_type === 'admin'
                                    "
                                    class="text-sm font-bold text-gray-900 px-6 py-2 text-left"
                                >
                                    delete
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                class="border-b even:bg-white odd:bg-gray-200"
                                v-for="field in fieldsData"
                                :key="field.id"
                            >
                                <td class="tableData">{{ field.id }}</td>
                                <td class="tableData">{{ field.item }}</td>

                                <td class="tableData">
                                    <button
                                        type="submit"
                                        v-if="
                                            account_type === 'root' ||
                                            account_type === 'admin'
                                        "
                                        @click="deleteItem(field.id)"
                                        class="bg-red-500 text-white px-4 rounded hover:bg-red-600 py-1"
                                    >
                                        Delete {{ field.id }}
                                    </button>
                                    <!-- the delete popup -->
                                    <TransitionRoot
                                        appear
                                        :show="deleteConfirmationDialog"
                                        as="template"
                                        v-if="
                                            account_type === 'root' ||
                                            account_type === 'admin'
                                        "
                                    >
                                        <Dialog
                                            as="div"
                                            v-if="
                                                account_type === 'root' ||
                                                account_type === 'admin'
                                            "
                                            class="relative z-10"
                                        >
                                            <TransitionChild
                                                as="template"
                                                enter="duration-300 ease-out"
                                                enter-from="opacity-0"
                                                enter-to="opacity-100"
                                                leave="duration-200 ease-in"
                                                leave-from="opacity-100"
                                                leave-to="opacity-0"
                                            >
                                                <div
                                                    class="fixed inset-0 bg-black bg-opacity-25"
                                                />
                                            </TransitionChild>

                                            <div
                                                class="fixed inset-0 overflow-y-auto"
                                            >
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
                                                                    >Are you
                                                                    sure you
                                                                    want to
                                                                    delete this
                                                                    field, the
                                                                    action is
                                                                    irreversible
                                                                    --
                                                                    {{
                                                                        field.id
                                                                    }}</span
                                                                >
                                                            </DialogTitle>
                                                            <div
                                                                class="mt-2 flex gap-3"
                                                            >
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

                                                                <button
                                                                    type="submit"
                                                                    class="bg-primary hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md mt-4"
                                                                    @click="
                                                                        confrimDeletion()
                                                                    "
                                                                >
                                                                    Delete
                                                                </button>
                                                            </div>
                                                        </DialogPanel>
                                                    </TransitionChild>
                                                </div>
                                            </div>
                                        </Dialog>
                                    </TransitionRoot>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
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
                fielditem: "",
            }),
            selectedSecondaryItem: "",
            myform: {
                fielditem: "",
            },
            deleteConfirmationDialog: false,
            deleteConfimation: true,
            selectedItemForDeletion: null,
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
            this.form.post(route(`${this.postRoute}`));
            this.isDialogueOpen = false;
            this.form.fielditem = "";
        },
        addSecondaryItem() {
            useForm({
                id: this.selectedSecondaryItem,
                fielditem: this.myform.fielditem,
            }).post(route(`${this.postRoute}`));
            // this.isDialogueOpen = false;
            // this.form.fielditem = "";
        },
        confrimDeletion() {
            this.deleteConfimation = true;
            this.$inertia.delete(
                route(`${this.deleteRoute}`, this.selectedItemForDeletion)
            );
            this.deleteConfirmationDialog = false;
        },
        deleteItem(id) {
            this.selectedItemForDeletion = id;
            this.deleteConfirmationDialog = true;
            // if (this.deleteConfimation == true) {
            //     this.$inertia.delete(route(`${this.deleteRoute}`, id));
            //     this.deleteConfirmationDialog = false;
            // }
        },
    },
    computed: {
        form_fields() {
            let myform = useForm({
                id: this.selectedSecondaryItem,
                fielditem: "",
            });
            return myform;
        },

        filteredFieldsData() {
            let filteredData = [];
            if (this.fieldsData) {
                filteredData = this.fieldsData.filter((item) => {
                    return item.secondary_item_id == this.selectedSecondaryItem;
                });
            }
            return filteredData;
        },
    },
    props: {
        all_locations: Array,
        sectionTitle: String,
        dialogTitle: String,
        fieldsData: Array,
        postRoute: String,
        deleteRoute: String,
        secondaryTitle: String,
        secondaryField: Array,
        account_type: String,
    },
};
</script>
