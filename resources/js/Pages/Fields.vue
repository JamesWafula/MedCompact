<template>
    <AppLayout title="Dashboard">
        <div
            class="space-y-6"
            v-if="
                $page.props.user.account_type === 'root' ||
                $page.props.user.account_type === 'admin'
            "
        >
            <fields-section
                sectionTitle="locations"
                dialogTitle="location"
                :fieldsData="get_locationsData"
                postRoute="post_location"
                deleteRoute="delete_locations"
                :account_type="user.account_type"
            />

            <fields-section
                sectionTitle="Specific location"
                dialogTitle="Specific location"
                :fieldsData="get_specificLocations"
                postRoute="post_specificlocation"
                deleteRoute="delete_specificlocation"
                secondaryTitle="location"
                :secondaryField="get_locationsData"
                :account_type="user.account_type"
            />
            <fields-section
                sectionTitle="incident"
                dialogTitle="incident"
                :fieldsData="get_incidentsData"
                postRoute="post_incident"
                deleteRoute="delete_incidents"
                :account_type="user.account_type"
            />
            <fields-section
                sectionTitle="type of error"
                dialogTitle="type of error"
                :fieldsData="get_typeOfError"
                postRoute="post_typeoferror"
                deleteRoute="delete_typeoferror"
                secondaryTitle="incident"
                :secondaryField="get_incidentsData"
                :account_type="user.account_type"
            />
            <fields-section
                sectionTitle="possible factors"
                dialogTitle="possible factors"
                :fieldsData="get_possibleFactorsData"
                postRoute="post_possiblefactors"
                deleteRoute="delete_possiblefactors"
                :account_type="user.account_type"
            />
            <fields-section
                sectionTitle="preventability"
                dialogTitle="preventability"
                :fieldsData="get_preventabilityData"
                postRoute="post_preventability"
                deleteRoute="delete_preventability"
                :account_type="user.account_type"
            />
            <fields-section
                sectionTitle="outcomes"
                dialogTitle="outcomes"
                :fieldsData="get_outcomesData"
                postRoute="post_outcome"
                deleteRoute="delete_outcome"
                :account_type="user.account_type"
            />
            <fields-section
                sectionTitle="occupations"
                dialogTitle="occupations"
                :fieldsData="get_occupationsData"
                postRoute="post_occuppation"
                deleteRoute="delete_occupation"
                :account_type="user.account_type"
            />
        </div>
        <div v-else>
            <h3 class="text-xl">Sorry you dont have access to this page</h3>
        </div>
    </AppLayout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Location from "@/components/Dashboard/fields/location.vue";
import Incident from "@/components/Dashboard/fields/incident.vue";
import TypeOfError from "@/components/Dashboard/fields/typeOfError.vue";
import PossibleFactors from "@/components/Dashboard/fields/possibleFactors.vue";
import Preventability from "@/components/Dashboard/fields/preventability.vue";
import Outcome from "@/components/Dashboard/fields/outcome.vue";
import Occupation from "@/components/Dashboard/fields/occupation.vue";
import FieldsSection from "@/components/Dashboard/fields/fieldsSection.vue";

export default {
    components: {
        AppLayout,
        Location,
        Incident,
        TypeOfError,
        PossibleFactors,
        Preventability,
        Outcome,
        Occupation,
        FieldsSection,
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
        get_incidentsData: function () {
            const data = this.all_incidents;
            let filteredData = [];
            if (data) {
                filteredData = data.map((item) => {
                    return { id: item.id, item: item.incident };
                });
            }

            return filteredData;
        },
        get_specificLocations: function () {
            const data = this.all_specific_locations;
            let filteredData = [];
            if (data) {
                filteredData = data.map((item) => {
                    return {
                        id: item.id,
                        item: item.specific_location,
                        secondary_item_id: item.location_id,
                    };
                });
            }
            return filteredData;
        },
        get_typeOfError: function () {
            const data = this.all_type_of_error;
            let filteredData = [];
            if (data) {
                filteredData = data.map((item) => {
                    return {
                        id: item.id,
                        item: item.type_of_error,
                        secondary_item_id: item.incident_id,
                    };
                });
            }
            return filteredData;
        },
        get_possibleFactorsData: function () {
            const data = this.all_possible_factors;
            let filteredData = [];
            if (data) {
                filteredData = data.map((item) => {
                    return { id: item.id, item: item.possible_factor };
                });
            }
            return filteredData;
        },
        get_occupationsData: function () {
            const data = this.all_occupations;
            let filteredData = [];
            if (data) {
                filteredData = data.map((item) => {
                    return { id: item.id, item: item.occupation };
                });
            }
            return filteredData;
        },
        get_preventabilityData: function () {
            const data = this.all_preventability;
            let filteredData = [];
            if (data) {
                filteredData = data.map((item) => {
                    return { id: item.id, item: item.preventability };
                });
            }
            return filteredData;
        },
        get_outcomesData: function () {
            const data = this.all_outcomes;
            let filteredData = [];
            if (data) {
                filteredData = data.map((item) => {
                    return { id: item.id, item: item.outcome };
                });
            }
            return filteredData;
        },
    },
    props: {
        // incident: Array,
        // locations: Array,
        // occupations: Array,
        // outcomes: Array,
        // possible_factors: Array,
        // preventability: Array,
        // type_of_error: Array,
        all_errors: Array,
        all_locations: Array,
        all_possible_factors: Array,
        all_preventability: Array,
        all_outcomes: Array,
        all_occupations: Array,
        all_incidents: Array,
        all_type_of_error: Array,
        all_specific_locations: Array,
        user: Object,
    },
};
</script>
