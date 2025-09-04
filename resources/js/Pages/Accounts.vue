<template>
    <AppLayout title="Dashboard" :account_type="user.account_type">
        <div
            class="flex flex-col"
            v-if="user.account_type === 'root' || user.account_type === 'admin'"
        >
            <div class="overflow-x-auto">
                <div class="py-2 inline-block min-w-full">
                    <div class="overflow-hidden">
                        <!-- <div>
                            <Link :href="route('dashboard.adduser')"
                                >add new user</Link
                            >
                        </div> -->
                        <table class="min-w-full">
                            <thead class="bg-white border-b">
                                <tr>
                                    <th
                                        scope="col"
                                        class="text-sm capitalize font-medium text-gray-900 px-6 py-2 text-left"
                                        v-for="tableHeader in tableHeaders"
                                        :key="tableHeader"
                                    >
                                        {{ tableHeader }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    class="border-b even:bg-white odd:bg-gray-200"
                                    v-for="user in all_users"
                                    :key="user.id"
                                >
                                    <td class="tableData">{{ user.id }}</td>
                                    <td class="tableData">
                                        {{ user.first_name }}
                                    </td>
                                    <td class="tableData">
                                        {{ user.last_name }}
                                    </td>
                                    <td class="tableData">{{ user.title }}</td>
                                    <td class="tableData">
                                        {{ user.personal_number }}
                                    </td>
                                    <td class="tableData">
                                        {{ user.occupation }}
                                    </td>
                                    <td class="tableData">
                                        {{ user.department_or_unit }}
                                    </td>

                                    <td class="tableData">
                                        {{ user.mobile_number }}
                                    </td>
                                    <td class="tableData">{{ user.email }}</td>
                                    <td class="tableData capitalize">
                                        <!-- select with account types -->
                                        <div
                                            class="w-32"
                                            v-if="
                                                $page.props.user.account_type ==
                                                'root'
                                            "
                                        >
                                            <select
                                                class="errorFormInput my-1"
                                                placeholder="user.account_type "
                                                @change="updateUser"
                                            >
                                                <option
                                                    value=""
                                                    selected
                                                    disabled
                                                >
                                                    {{ user.account_type }}
                                                </option>
                                                <option
                                                    :value="`${
                                                        'admin' + ' ' + user.id
                                                    }`"
                                                >
                                                    admin
                                                </option>
                                                <option
                                                    :value="`${
                                                        'hod' + ' ' + user.id
                                                    }`"
                                                >
                                                    hod
                                                </option>
                                                <option
                                                    :value="`${
                                                        'root' + ' ' + user.id
                                                    }`"
                                                >
                                                    root
                                                </option>
                                                <option
                                                    :value="`${
                                                        'officer' +
                                                        ' ' +
                                                        user.id
                                                    }`"
                                                >
                                                    officer
                                                </option>
                                                <option
                                                    :value="`${
                                                        'reporter' +
                                                        ' ' +
                                                        user.id
                                                    }`"
                                                >
                                                    reporter
                                                </option>
                                            </select>
                                        </div>
                                        <span v-else>
                                            {{ user.account_type }}
                                        </span>
                                    </td>

                                    <td class="tableData">
                                        {{ created_at }}
                                    </td>

                                    <td class="tableData">
                                        <div class="">
                                            <button
                                                v-if="
                                                    !allowChangePassword(
                                                        user.id
                                                    )
                                                "
                                                class="bg-primary hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md"
                                                @click="
                                                    openPasswordChangeForm(
                                                        user.id
                                                    )
                                                "
                                            >
                                                change password
                                            </button>
                                            <form
                                                action=""
                                                class="w-72 space-y-2"
                                                @submit.prevent="
                                                    updatePassword(user.id)
                                                "
                                                v-if="
                                                    allowChangePassword(user.id)
                                                "
                                            >
                                                <div class="">
                                                    <div class="">
                                                        <label
                                                            for="password"
                                                            v-if="
                                                                form.errors
                                                                    .password
                                                            "
                                                            class="text-red-500"
                                                        >
                                                            {{
                                                                form.errors
                                                                    .password
                                                            }}
                                                        </label>
                                                    </div>

                                                    <input
                                                        type="password"
                                                        placeholder="password"
                                                        name=""
                                                        class="errorFormInput"
                                                        id=""
                                                        v-model="form.password"
                                                    />
                                                </div>

                                                <div class="">
                                                    <div>
                                                        <label
                                                            for="password"
                                                            v-if="
                                                                form.errors
                                                                    .password_confirmation
                                                            "
                                                            class="text-red-500"
                                                        >
                                                            {{
                                                                form.errors
                                                                    .password_confirmation
                                                            }}
                                                        </label>
                                                    </div>

                                                    <input
                                                        type="password"
                                                        name=""
                                                        class="errorFormInput"
                                                        placeholder="confirm password"
                                                        id=""
                                                        v-model="
                                                            form.password_confirmation
                                                        "
                                                    />
                                                </div>
                                                <button
                                                    type="submit"
                                                    class="bg-primary hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md"
                                                >
                                                    submit
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <h3 class="text-xl">Sorry you dont have access to this page</h3>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import moment from "moment";
import { Link } from "@inertiajs/inertia-vue3";
export default {
    data() {
        return {
            selectedId: null,
            form: this.$inertia.form({
                password: "",
                password_confirmation: "",
            }),
            tableHeaders: [
                "ID",
                "First name",
                "Last name",
                "Title",
                "Personal Number",
                "Occupation",
                "Department or unit",
                "Mobile_number",
                "Email",
                "Account Type",
                "Created at",
                "Change Password",
            ],
            selectedAccountType: "",
        };
    },
    methods: {
        updatePassword(id) {
            this.form.put(`/user/update/password/${id}`, {
                onSuccess: () => {
                    alert("Password has been updated successfully");
                    this.form.reset("password", "password_confirmation");
                },
            });
        },
        openPasswordChangeForm(id) {
            this.form.password = "";
            this.form.password_confirmation = "";
            this.selectedId = id;
            // this.allowChangePassword = true;
        },
        allowChangePassword(id) {
            let allow = false;
            if (this.selectedId == id) {
                allow = true;
            } else {
                if (this.form.errors) {
                    allow = false;
                } else {
                    allow = false;
                }
            }
            return allow;
        },

        updateUser(e) {
            // alert(id + this.selectedAccountType);

            if (
                window.confirm(
                    "Are you sure you want to update this user's account type?"
                )
            ) {
                this.$inertia.put(
                    `/user/update/accounttype/${e.target.value.substring(
                        e.target.value.indexOf(" ") + 1
                    )}`,
                    {
                        account_type: e.target.value.substring(
                            0,
                            e.target.value.indexOf(" ")
                        ),
                    }
                );
            } else {
                alert("rudi baadaye");
            }
        },
    },

    computed: {
        created_at() {
            return moment(this.created_at).format("YYYY-MM-DD , HH:mm");
        },
    },
    components: {
        AppLayout,
        Link,
    },
    props: {
        all_users: Object,
        user: Object,
    },
};
</script>
