<template>
    <AppLayout title="Dashboard">
        <app-table
            :all_errors="all_errors"
            :all_locations="all_locations"
            :all_possible_factors="all_possible_factors"
            :all_preventability="all_preventability"
            :all_outcomes="all_outcomes"
            :all_incidents="all_incidents"
            :all_type_of_error="all_type_of_error"
            :all_specific_locations="all_specific_locations"
            :all_occupations="all_occupations"
            :all_users="all_users"
        >
        </app-table>
    </AppLayout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import AppTable from "@/components/Dashboard/appTable.vue";
export default {
    components: {
        AppLayout,
        AppTable,
    },
    props: {
        all_errors: Object,
        all_locations: Object,
        all_possible_factors: Object,
        all_preventability: Object,
        all_outcomes: Object,
        all_occupations: Object,
        all_incidents: Object,
        all_type_of_error: Object,
        all_specific_locations: Object,
        all_occupations: Object,
        all_users: Object,
    },
};
</script>
