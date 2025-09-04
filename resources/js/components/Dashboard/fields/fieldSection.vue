<template>
    <v-card raised outlined tile class="pa-6">
        <div class="d-flex justify-space-between">
            <h3 class="text-h5 font-weight-bold mb-5 text-capitalize">
                {{ title }}
            </h3>

            <!-- the form pop up dialogue -->
            <v-dialog
                persistent
                transition="dialog-bottom-transition"
                max-width="600"
            >
                <template v-slot:activator="{ on, attrs }">
                    <v-btn
                        icon
                        color="primary"
                        outlined
                        tile
                        v-bind="attrs"
                        v-on="on"
                    >
                        <v-icon> mdi-plus </v-icon>
                    </v-btn>
                </template>

                <template v-slot:default="dialog">
                    <v-card tile raised>
                        <v-toolbar
                            color="primary"
                            dense
                            dark
                            v-if="!form_is_successful"
                        >
                            <v-container class="d-flex justify-space-between">
                                <p class="text-h6 ma-0 text-capitalize">
                                    {{ formTitle }}
                                </p>

                                <v-btn
                                    text
                                    icon
                                    color="white"
                                    outlined
                                    tile
                                    @click="dialog.value = false"
                                >
                                    <v-icon> mdi-close </v-icon>
                                </v-btn>
                            </v-container>
                        </v-toolbar>
                        <br v-if="!form_is_successful" />

                        <v-alert
                            v-if="form_is_successful"
                            tile
                            class="py-5 px-10"
                            type="success"
                        >
                            Successfully added
                            <v-btn
                                text
                                color="white"
                                outlined
                                tile
                                @click="
                                    (dialog.value = false),
                                        (form_is_successful = false),
                                        (formData.title = '')
                                "
                                >close</v-btn
                            >
                        </v-alert>

                        <v-container>
                            <p>
                                {{ selectedIncident }}
                            </p>
                            <v-form
                                v-if="!form_is_successful"
                                ref="form"
                                lazy-validation
                                v-model="valid"
                                @submit.prevent="handleSubmit"
                            >
                                <v-row>
                                    <v-col cols="12" md="12">
                                        <v-text-field
                                            outlined
                                            rounded
                                            dense
                                            v-model="formData.title"
                                            :rules="text_rules"
                                            :counter="15"
                                            :label="
                                                title.charAt(0).toUpperCase() +
                                                title.slice(1)
                                            "
                                            required
                                            style="border-radius: 0"
                                        ></v-text-field>
                                    </v-col>
                                </v-row>

                                <v-btn
                                    color="primary"
                                    type="submit"
                                    :disabled="valid == !true"
                                    tile
                                    rounded
                                    :loading="form_loader"
                                    >submit</v-btn
                                >
                            </v-form>
                        </v-container>
                    </v-card>
                </template>
            </v-dialog>
            <!-- end the form pop up dialogue -->
        </div>

        <div v-if="typeOfError">
            <small>Select incident first</small>
            <v-select
                :items="incident_dropdown"
                outlined
                v-model="selectedIncident"
                style="border-radius: 0"
                dense
                label="Standard"
            ></v-select>
        </div>

        <v-chip-group
            v-if="typeOfError"
            active-class="primary--text"
            class="align-center"
            column
        >
            <v-chip
                v-for="(item, index) in get_incidentsData"
                :key="index"
                close
                @click:close="handleDeleteDialog(item.id)"
            >
                {{ item.field }}
            </v-chip>
        </v-chip-group>
        <v-chip-group v-if="!typeOfError" class="align-center" column>
            <v-chip
                v-for="(item, index) in items"
                :key="index"
                close
                @click:close="handleDeleteDialog(item.id)"
            >
                {{ item.item }}
            </v-chip>
        </v-chip-group>

        <v-dialog v-model="dialog" persistent max-width="300">
            <v-card>
                <v-card-title class="text-h5 red white--text font-weight-bold">
                    Warning!
                </v-card-title>
                <v-card-text class="font-weight-bold"
                    >You are about to delete a field are you sure you want to
                    proceed</v-card-text
                >
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="green darken-1" text @click="dialog = false">
                        Disagree
                    </v-btn>
                    <v-btn
                        color="green darken-1"
                        text
                        @click="handleDeleteField()"
                    >
                        Agree
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-card>
</template>

<script>
export default {
    data() {
        return {
            dialog: false,
            confirmDelete: "false",
            isSuccessfullySignedup: false,
            emailError: false,
            userNameError: false,
            fieldToBeDeleted: null,
            selectedIncident: null,
            formData: {
                title: "",
                incident_id: null,
            },
            valid: false,
            text_rules: [
                (v) => !!v || "Required",
                (v) => (v && v.length > 5) || "Must be more than 5 characters",
            ],
            isLoading: false,
        };
    },

    props: {
        title: {
            type: String,
            default: "Locations",
        },
        items: {
            type: Array,
            default: () => [],
        },
        formTitle: {
            type: String,
            default: "Add",
        },
        typeOfError: {
            type: Boolean,
            default: false,
        },
        incidents: {
            type: Array,
            default: () => [],
        },
        post_results: {
            type: Object | String,
            default: null,
        },
        type_of_error_data: {
            type: Array,
        },
        incident_data: {
            type: Array,
        },

        form_loader: {
            type: Boolean,
        },
        form_is_successful: {
            type: Boolean,
        },
        form_is_error: {
            type: Boolean,
        },
        // formData: {
        //   type: Object,
        // },
    },
    watch: {
        post_results() {
            // alert("Successfully added location");
            this.isLoading = false;
            this.isSuccessfullySignedup = true;
        },
    },
    computed: {
        incident_dropdown() {
            const data = this.incident_data;
            let filteredData = [];
            if (data) {
                filteredData = data.map((incident) => {
                    return incident.incident;
                });
            }

            return filteredData;
        },
        get_incidentsData: function () {
            const data = this.incident_data;
            const typeOfError = this.type_of_error_data;
            const selectedIncident = this.selectedIncident;
            let selectedIncidentId = null;

            let filteredData = [];

            if (selectedIncident) {
                selectedIncidentId = data.filter(
                    (item) => item.incident === selectedIncident
                )[0].id;

                filteredData = typeOfError
                    .filter((item) => item.incident_id == selectedIncidentId)
                    .map((item) => {
                        return {
                            id: item.id,
                            field: item.type_of_error,
                        };
                    });
            }

            return filteredData;
        },
        get_typeOfError: function () {
            const data = this.type_of_error_data;
            let filteredData = [];
            if (data) {
                filteredData = data.map((item) => {
                    return item.type_of_error;
                });
            }

            return filteredData;
        },
    },
    methods: {
        handleDeleteField() {
            if (this.fieldToBeDeleted) {
                this.$emit("deleteField", {
                    fieldId: this.fieldToBeDeleted,
                });
            }
            this.fieldToBeDeleted = null;
            this.dialog = false;
        },
        handleDeleteDialog(id) {
            this.dialog = true;
            this.fieldToBeDeleted = id;
        },
        handleSubmit() {
            this.valid = this.$refs.form.validate();

            if (this.valid) {
                // this.isSuccessfullySignedup = true;
                this.isLoading = true;
                let incident_id = this.selectedIncident;
                this.$emit("submit", {
                    title: this.formData.title,
                    selected_incident: incident_id,
                });
            }
        },
    },
    mounted() {},
};
</script>
