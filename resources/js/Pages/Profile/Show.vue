<template>
  <AppLayout title="Profile">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Profile</h2>
    </template>

    <!-- <div>
      <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <UpdateProfileInformationForm :user="$page.props.user" />

        <JetSectionBorder />

        <UpdatePasswordForm class="mt-10 sm:mt-0" />

        <JetSectionBorder />

        <TwoFactorAuthenticationForm
          :requires-confirmation="confirmsTwoFactorAuthentication"
          class="mt-10 sm:mt-0"
        />

        <JetSectionBorder />

        <LogoutOtherBrowserSessionsForm
          :sessions="sessions"
          class="mt-10 sm:mt-0"
        />

        <JetSectionBorder />

        <DeleteUserForm class="mt-10 sm:mt-0" />
      </div>
    </div> -->
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import DeleteUserForm from "@/Pages/Profile/Partials/DeleteUserForm.vue";
import JetSectionBorder from "@/Jetstream/SectionBorder.vue";
import LogoutOtherBrowserSessionsForm from "@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue";
import TwoFactorAuthenticationForm from "@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue";
import UpdatePasswordForm from "@/Pages/Profile/Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "@/Pages/Profile/Partials/UpdateProfileInformationForm.vue";

export default {
  components: {
    AppLayout,
    DeleteUserForm,
    JetSectionBorder,
    LogoutOtherBrowserSessionsForm,
    TwoFactorAuthenticationForm,
    UpdatePasswordForm,
    UpdateProfileInformationForm,
  },
  props: {
    confirmsTwoFactorAuthentication: Boolean,
    sessions: Array,
  },
};
</script>
