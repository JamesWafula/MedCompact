<template>
    <div>
        <button
            @click="downloadFile()"
            class="bg-green-500 text-white px-4 rounded hover:bg-green-600 py-1 inline-flex"
        >
            Export to excel
        </button>
    </div>
    <div class="flex flex-col" v-if="total_errors_table_data.length > 0">
        <div class="overflow-x-auto">
            <div class="py-2 inline-block min-w-full">
                <div class="overflow-hidden">
                    <table class="min-w-full">
                        <thead class="bg-white border-b">
                            <tr>
                                <th
                                    scope="col"
                                    class="text-sm font-medium text-gray-900 px-6 py-2 text-left"
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
                                v-for="reported_error in total_errors_table_data"
                                :key="reported_error.id"
                            >
                                <td class="tableData">
                                    {{ reported_error.id }}
                                </td>
                                <td class="tableData">
                                    {{ reported_error.users }}
                                </td>
                                <td class="tableData">
                                    {{ reported_error.created_at }}
                                </td>
                                <td class="tableData">
                                    {{ reported_error.ip }}
                                </td>
                                <td class="tableData">
                                    {{ reported_error.diagnosis }}
                                </td>
                                <td class="tableData">
                                    {{ reported_error.gender }}
                                </td>
                                <td class="tableData">
                                    {{ reported_error.age }}
                                </td>
                                <td class="tableData">
                                    {{ reported_error.date }}
                                </td>
                                <td class="tableData">
                                    {{ reported_error.time }}
                                </td>
                                <td class="tableData">
                                    {{ reported_error.location_of_error }}
                                </td>
                                <td class="tableData">
                                    {{ reported_error.specific_location }}
                                </td>
                                <td class="tableData">
                                    {{
                                        reported_error.specific_location_by_user
                                    }}
                                </td>
                                <td class="tableData">
                                    {{ reported_error.incident }}
                                </td>
                                <td class="tableData">
                                    {{ reported_error.type_of_error }}
                                </td>
                                <td class="tableData">
                                    {{ reported_error.outcome_of_error }}
                                </td>
                                <td class="tableData">
                                    {{ reported_error.preventability }}
                                </td>
                                <td class="tableData">
                                    {{ reported_error.possible_causes }}
                                </td>
                                <td class="tableData">
                                    {{ reported_error.suggestions }}
                                </td>
                                <td class="tableData">
                                    {{ reported_error.email }}
                                </td>
                                <td class="tableData">
                                    {{ reported_error.occupations }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div v-else>no errors found</div>
</template>

<script>
import exportFromJSON from "export-from-json";
import moment from "moment";
export default {
    data() {
        return {
            tableHeaders: [
                "ID",
                "Created By",
                "created at",
                "Ip/Op number",
                "diagnosis",
                "gender",
                "age",
                "date",
                "time",
                "location",
                "specific location",
                "specific location by user",
                "incident",
                "type of error",
                "outcome",
                "preventability",
                "possible factors",
                "suggestions",
                "email",
                "occupations",
            ],
        };
    },
    methods: {
        downloadFile() {
            const data = this.total_errors_table_data;
            const fileName = `all errors - ${new Date()}`;
            const exportType = exportFromJSON.types.csv;

            if (data) exportFromJSON({ data, fileName, exportType });
        },
    },
    computed: {
        total_errors_table_data() {
            let filtered_data = [];
            if (this.all_errors) {
                filtered_data = this.all_errors.map((item) => {
                    return {
                        id: item.id,
                        created_at: moment(item.created_at),
                        ip: item.ip,
                        diagnosis: item.diagnosis,
                        gender: item.gender,
                        age: item.age,
                        date: item.date,
                        time: item.time,
                        location_of_error: `${
                            this.all_locations &&
                            this.all_locations
                                .filter(
                                    (filtered) =>
                                        filtered.id == item.location_of_error_id
                                )
                                .map((item) => item)[0].location
                        }`,
                        specific_location: `${
                            this.all_specific_locations &&
                            this.all_specific_locations
                                .filter(
                                    (filtered) =>
                                        filtered.id == item.specific_location_id
                                )
                                .map((item) => item)[0].specific_location
                        }`,
                        specific_location_by_user:
                            item.specific_location_by_user,
                        incident: `${
                            this.all_incidents &&
                            this.all_incidents
                                .filter(
                                    (filtered) =>
                                        filtered.id == item.incident_id
                                )
                                .map((item) => item)[0].incident
                        }`,
                        type_of_error: `${
                            this.all_type_of_error &&
                            this.all_type_of_error
                                .filter(
                                    (filtered) =>
                                        filtered.id == item.type_of_error_id
                                )
                                .map((item) => item)[0].type_of_error
                        }`,
                        outcome_of_error: `${
                            this.all_outcomes &&
                            this.all_outcomes
                                .filter(
                                    (filtered) => filtered.id == item.outcome_id
                                )
                                .map((item) => item)[0].outcome
                        }`,
                        preventability: `${
                            this.all_preventability &&
                            this.all_preventability
                                .filter(
                                    (filtered) =>
                                        filtered.id == item.preventability_id
                                )
                                .map((item) => item)[0].preventability
                        }`,
                        possible_causes: `${
                            this.all_possible_factors &&
                            this.all_possible_factors
                                .filter(
                                    (filtered) =>
                                        filtered.id == item.possible_factor_id
                                )
                                .map((item) => item)[0].possible_factor
                        }`,
                        occupations: `${
                            this.all_occupations &&
                            this.all_occupations
                                .filter(
                                    (filtered) =>
                                        filtered.id == item.occupation_id
                                )
                                .map((item) => item)[0].occupation
                        }`,
                        users: `${
                            this.all_users &&
                            //check if user id is present and then get the user name
                            item.user_id
                                ? this.all_users
                                      .filter(
                                          (filtered) =>
                                              filtered.id == item.user_id
                                      )
                                      .map((item) => item)[0].personal_number
                                : "Anonymus"
                        }`,
                        email: item.email,
                        suggestions: item.suggestions,
                    };
                });
            }
            this.download_data = filtered_data;
            return filtered_data;
        },
    },
    props: {
        all_errors: Object,
        all_locations: Object,
        all_possible_factors: Array,
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
