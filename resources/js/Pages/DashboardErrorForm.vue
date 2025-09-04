<template>
    <AppLayout title="Dashboard">
        <ErrorForm
            :incident="incident"
            :locations="locations"
            :occupations="occupations"
            :outcomes="outcomes"
            :possible_factors="possible_factors"
            :preventability="preventability"
            :type_of_error="type_of_error"
            :specific_location="specific_location"
            :user_id="user.id"
        />
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import ErrorForm from "../components/ErrorForm/ErrorForm.vue";
import moment from "moment";
export default {
    data() {
        return {
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
            ],
        };
    },
    computed: {
        created_at() {
            return moment(this.created_at).format("YYYY-MM-DD , HH:mm");
        },
    },
    components: {
        AppLayout,
        ErrorForm,
    },
    props: {
        user: Object,
        incident: Array,
        locations: Array,
        occupations: Array,
        outcomes: Array,
        possible_factors: Array,
        preventability: Array,
        type_of_error: Array,
        specific_location: Array,
    },
};
</script>
