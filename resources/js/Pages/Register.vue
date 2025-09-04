<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard.vue";
import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import AppLayout from "@/Layouts/AppLayout.vue";

const form = useForm({
    first_name: "",
    last_name: "",
    title: "",
    personal_number: "",
    occupation: "",
    department_or_unit: "",
    mobile_number: "",
    account_type: "",
    email: "",
    password: "",
    password_confirmation: "",
    terms: false,
});

const submit = () => {
    form.post(route("dashboard.registeruserpost"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <Head title="Register" />
    <AppLayout title="Dashboard">
        <JetAuthenticationCard>
            <form @submit.prevent="submit">
                <div>
                    <JetLabel for="first_name" value="First Name" />
                    <JetInput
                        id="first_name"
                        v-model="form.first_name"
                        type="text"
                        class="mt-1 block w-full"
                        required
                        autofocus
                        autocomplete="first_name"
                    />
                </div>

                <div>
                    <JetLabel for="last_name" value="Last Name" />
                    <JetInput
                        id="last_name"
                        v-model="form.last_name"
                        type="text"
                        class="mt-1 block w-full"
                        required
                        autofocus
                        autocomplete="last_name"
                    />
                </div>

                <div>
                    <JetLabel for="title" value="Title" />
                    <JetInput
                        id="title"
                        v-model="form.title"
                        type="text"
                        class="mt-1 block w-full"
                        required
                        autofocus
                        autocomplete="title"
                    />
                </div>

                <div>
                    <JetLabel for="personal_number" value="Personal Number" />
                    <JetInput
                        id="personal_number"
                        v-model="form.personal_number"
                        type="text"
                        class="mt-1 block w-full"
                        required
                        autofocus
                        autocomplete="personal_number"
                    />
                </div>

                <div>
                    <JetLabel for="occupation" value="Occupation" />
                    <JetInput
                        id="occupation"
                        v-model="form.occupation"
                        type="text"
                        class="mt-1 block w-full"
                        required
                        autofocus
                        autocomplete="occupation"
                    />
                </div>

                <div>
                    <JetLabel
                        for="department_or_unit"
                        value="Department or Unit"
                    />
                    <JetInput
                        id="department_or_unit"
                        v-model="form.department_or_unit"
                        type="text"
                        class="mt-1 block w-full"
                        required
                        autofocus
                        autocomplete="department_or_unit"
                    />
                </div>

                <div>
                    <JetLabel for="mobile_number" value="Mobile Number" />
                    <JetInput
                        id="mobile_number"
                        v-model="form.mobile_number"
                        type="number"
                        class="mt-1 block w-full"
                        required
                        autofocus
                        autocomplete="mobile_number"
                    />
                </div>

                <div class="mt-4">
                    <JetLabel for="email" value="Email" />
                    <JetInput
                        id="email"
                        v-model="form.email"
                        type="email"
                        class="mt-1 block w-full"
                        required
                    />
                </div>

                <div class="mt-4">
                    <JetLabel for="account type" value="Account type" />
                    <select
                        class="errorFormInput my-1"
                        v-model="form.account_type"
                        placeholder=""
                    >
                        <option value="" selected disabled>
                            Select Account Type
                        </option>
                        <option value="admin">admin</option>
                        <option value="hod">hod</option>
                        <option value="root">root</option>
                        <option value="officer">officer</option>
                        <option value="reporter">reporter</option>
                    </select>
                </div>

                <div class="mt-4">
                    <JetLabel for="password" value="Password" />
                    <JetInput
                        id="password"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-full"
                        required
                        autocomplete="new-password"
                    />
                </div>

                <div class="mt-4">
                    <JetLabel
                        for="password_confirmation"
                        value="Confirm Password"
                    />
                    <JetInput
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        type="password"
                        class="mt-1 block w-full"
                        required
                        autocomplete="new-password"
                    />
                </div>

                <div
                    v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature"
                    class="mt-4"
                >
                    <JetLabel for="terms">
                        <div class="flex items-center">
                            <JetCheckbox
                                id="terms"
                                v-model:checked="form.terms"
                                name="terms"
                            />

                            <div class="ml-2">
                                I agree to the
                                <a
                                    target="_blank"
                                    :href="route('terms.show')"
                                    class="underline text-sm text-gray-600 hover:text-gray-900"
                                    >Terms of Service</a
                                >
                                and
                                <a
                                    target="_blank"
                                    :href="route('policy.show')"
                                    class="underline text-sm text-gray-600 hover:text-gray-900"
                                    >Privacy Policy</a
                                >
                            </div>
                        </div>
                    </JetLabel>
                </div>

                <div class="flex mt-4">
                    <JetButton
                        class="ml-4"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Register
                    </JetButton>
                </div>
            </form>
        </JetAuthenticationCard>
    </AppLayout>
</template>
