<template>
    <AppLayout title="Dashboard">
        <div v-if="$page.props.user.account_type == 'reporter'">
            <h1>Reporter Account</h1>
        </div>
        <div v-else>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <info-card
                    class="bg-blue-400"
                    title="errors total"
                    :value="all_errors.length"
                />
                <info-card
                    class="bg-purple-400"
                    title="top outcome"
                    :value="top_outcome.outcome"
                    :secondaryValue="top_outcome.errorCount"
                />

                <info-card
                    class="bg-red-400"
                    title="top location"
                    :value="top_location.location"
                    :secondaryValue="top_location.errorCount"
                />
            </div>

            <!-- charts sections  -->
            <div class="grid grid-cols-1 md:grid-cols-2 w-full gap-6 pt-10">
                <incident-graph :incident_data="incident_data" />
                <gender-pie-chart :gender_data="gender_data" />
                <location-of-error-graph :location_data="location_data" />
                <occupation-graph :occupation_data="occupation_data" />
                <outcome-of-error-graph :outcome_data="outcome_data" />
                <possible-factors-graph
                    :possible_factors_data="possible_factors_data"
                />
                <preventability-graph
                    :preventability_data="preventability_data"
                />

                <!--
                    <reporting-location-graph
                        :reporting_location_data="reporting_location_data"
                /> -->
                <!-- <p>reporting_location - {{ reporting_location_data }}</p> -->
            </div>

            <div class="graphChart px-6 py-4 mt-8">
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
                />
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import InfoCard from "@/components/Dashboard/InfoCard.vue";
import Welcome from "@/Jetstream/Welcome.vue";
import GenderPieChart from "@/components/Dashboard/charts/genderPieChart.vue";
import IncidentGraph from "@/components/Dashboard/charts/incidentGraph.vue";
import LocationOfErrorGraph from "@/components/Dashboard/charts/locationOfErrorGraph.vue";
import OccupationGraph from "@/components/Dashboard/charts/occupationGraph.vue";
import OutcomeOfErrorGraph from "@/components/Dashboard/charts/outcomeOfErrorGraph.vue";
import PossibleFactorsGraph from "@/components/Dashboard/charts/possibleFactorsGraph.vue";
import PreventabilityGraph from "@/components/Dashboard/charts/preventabilityGraph.vue";
import ReportingLocationGraph from "@/components/Dashboard/charts/reportingLocationGraph.vue";
import AppTable from "@/components/Dashboard/appTable.vue";

export default {
    components: {
        AppLayout,
        Welcome,
        InfoCard,
        GenderPieChart,
        IncidentGraph,
        LocationOfErrorGraph,
        OccupationGraph,
        OutcomeOfErrorGraph,
        PossibleFactorsGraph,
        PreventabilityGraph,
        ReportingLocationGraph,
        AppTable,
    },
    computed: {
        top_outcome() {
            let top_outcome = [];
            if (this.all_outcomes.length > 0) {
                top_outcome = this.outcome_data.sort((b, a) =>
                    a.errorCount > b.errorCount ? 1 : -1
                );
            } else {
                top_outcome = [
                    {
                        outcome: "No data",
                        errorCount: 0,
                    },
                ];
            }

            return top_outcome[0];
        },
        top_location() {
            let top_location = [];
            if (this.all_outcomes.length > 0) {
                top_location = this.location_data.sort((b, a) =>
                    a.errorCount > b.errorCount ? 1 : -1
                );
            } else {
                top_location = [
                    {
                        location: "No data",
                        errorCount: 0,
                    },
                ];
            }

            return top_location[0];
        },
    },
    props: {
        all_errors: Object,
        gender_data: Object,
        incident_data: Object,
        possible_factors_data: Object,
        reporting_location_data: Object,
        preventability_data: Object,
        outcome_data: Object,
        location_data: Object,
        occupation_data: Object,
        all_locations: Object,
        all_possible_factors: Object,
        all_preventability: Object,
        all_outcomes: Object,
        all_occupations: Object,
        all_incidents: Object,
        all_type_of_error: Object,
        all_specific_locations: Object,
        all_users: Object,
    },
    //mounted redirect to the profile page
    mounted() {
        if (this.$page.props.user.account_type == "reporter") {
            this.$router.push("/dashboard/profile");
        }
    },
};
</script>
