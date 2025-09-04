<template>
    <!-- the form's heading -->
    <h1
        class="text-xl bg-primary text-white rounded-md font-bold text-center capitalize py-3"
    >
        medical error reporting tool
    </h1>
    <!-- the main form container -->
    <div class="mt-4 p-6 rounded-md border border-gray-300 border-1">
        <!-- disclaimer -->
        <p class="text-sm font-semibold">
            Disclaimer: The hospital management affirms that this is a blame
            free reporting tool. Any information provided is secure under
            Hospital policy and regulations and cannot be used against any staff
            for disciplinary action. The intent is to estimate the risk and
            evaluate patient safety for improved patient care.
        </p>
        <!-- the form -->
        <form @submit.prevent="form.post('/')" class="mt-10">
            <!-- the form's fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- the form's fields-->
                <!-- ip/op number -->
                <FormInputContainer
                    inputLabel="IP/OP Number"
                    inputDescription=""
                >
                    <input
                        type="text"
                        class="errorFormInput"
                        placeholder="IP/OP number"
                        v-model="form.ipOrOpNumber"
                    />
                    <p
                        class="text-xs text-red-700 font-bold"
                        v-if="form.errors.ipOrOpNumber"
                    >
                        {{ form.errors.ipOrOpNumber }}
                    </p>
                </FormInputContainer>

                <!-- diagnosis  -->
                <FormInputContainer inputLabel="Diagnosis" inputDescription="">
                    <input
                        type="text"
                        class="errorFormInput"
                        v-model="form.diagnosis"
                        placeholder="Diagnosis"
                    />
                    <p
                        class="text-xs text-red-700 font-bold"
                        v-if="form.errors.diagnosis"
                    >
                        {{ form.errors.diagnosis }}
                    </p>
                </FormInputContainer>

                <div class="flex space-x-3">
                    <!-- gender -->
                    <FormInputContainer
                        inputLabel="Gender"
                        class="w-1/2"
                        inputDescription=""
                    >
                        <select
                            name="gender"
                            id="gender"
                            class="errorFormInput"
                            v-model="form.gender"
                        >
                            <option value="" disabled>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <p
                            class="text-xs text-red-700 font-bold"
                            v-if="form.errors.gender"
                        >
                            {{ form.errors.gender }}
                        </p>
                    </FormInputContainer>
                    <!-- age -->
                    <FormInputContainer
                        class="w-1/2"
                        inputLabel="Age"
                        inputDescription=""
                    >
                        <div
                            class="rounded-md text-sm text-gray-800 w-full border-gray-300 flex"
                        >
                            <input
                                v-if="age_selector_model == 'Unknown'"
                                type="text"
                                class="errorFormInput rounded-l-md w-1/2"
                                name="Unknown Age"
                                placeholder="Unknown"
                                v-model="form.age"
                                disabled
                            />
                            <select
                                v-else
                                id="age"
                                class="rounded-l-md w-1/2 border-gray-300 errorFormInputFocus"
                                v-model="form.age"
                            >
                                <option
                                    v-for="(age, index) in get_age_data"
                                    :key="index"
                                >
                                    {{ age }}
                                </option>
                            </select>

                            <select
                                id="ageSelector"
                                class="rounded-r-md border-gray-300 r errorFormInputFocus w-1/2"
                                v-model="age_selector_model"
                            >
                                <option value="Years">Years</option>
                                <option value="Months">Months</option>
                                <option value="Days">Days</option>
                                <option value="Unknown">Unknown</option>
                            </select>
                        </div>

                        <p
                            class="text-xs text-red-700 font-bold"
                            v-if="form.errors.age"
                        >
                            {{ form.errors.age }}
                        </p>
                    </FormInputContainer>
                </div>

                <div class="flex space-x-3">
                    <!-- date of error  -->
                    <FormInputContainer
                        inputLabel="Date of error"
                        inputDescription=""
                        class="w-1/2"
                    >
                        <input
                            type="date"
                            id="start"
                            class="errorFormInput"
                            name="trip-start"
                            min="2018-01-01"
                            :max="current_date"
                            v-model="form.date"
                        />
                        <p
                            class="text-xs text-red-700 font-bold"
                            v-if="form.errors.date"
                        >
                            {{ form.errors.date }}
                        </p>
                    </FormInputContainer>

                    <!-- time of error -->
                    <FormInputContainer
                        inputLabel="Time"
                        class="w-1/2"
                        inputDescription=""
                    >
                        <select
                            name="Time"
                            id="time"
                            class="errorFormInput"
                            v-model="form.time"
                        >
                            <option value="" disabled>Select Time</option>
                            <option value="Morning">Morning</option>
                            <option value="AfterNoon">AfterNoon</option>
                            <option value="Evening">Evening</option>
                            <option value="Night">Night</option>
                        </select>
                        <p
                            class="text-xs text-red-700 font-bold"
                            v-if="form.errors.time"
                        >
                            {{ form.errors.time }}
                        </p>
                    </FormInputContainer>
                </div>

                <div class="flex space-x-3">
                    <!-- location of error -->
                    <FormInputContainer
                        inputLabel="Location of error"
                        inputDescription=""
                        class="w-1/2"
                    >
                        <select
                            name="locationOfError"
                            id="locationOfError"
                            class="errorFormInput"
                            v-model="form.locationOfError"
                        >
                            <option value="" disabled>
                                Select location of error
                            </option>

                            <option
                                v-for="location in locations"
                                :key="location.id"
                                :value="location.id"
                            >
                                {{ location.location }}
                            </option>
                        </select>
                        <p
                            class="text-xs text-red-700 font-bold"
                            v-if="form.errors.locationOfError"
                        >
                            {{ form.errors.locationOfError }}
                        </p>
                    </FormInputContainer>

                    <!-- specify location -->
                    <FormInputContainer
                        inputLabel="Specific location"
                        inputDescription=""
                        class="w-1/2"
                    >
                        <select
                            name="specificLocation"
                            id="specificLocation"
                            class="errorFormInput"
                            v-model="form.specificLocation"
                        >
                            <option value="" disabled>
                                Select specific location
                            </option>
                            <option
                                v-for="specific_location in specific_location_data"
                                :key="specific_location.id"
                                :value="specific_location.id"
                            >
                                {{ specific_location.specific_location }}
                            </option>
                        </select>

                        <p
                            class="text-xs text-red-700 font-bold"
                            v-if="form.errors.specificLocation"
                        >
                            {{ form.errors.specificLocation }}
                        </p>
                    </FormInputContainer>
                </div>

                <!-- specify location (other) -->
                <FormInputContainer
                    inputLabel="Specify location (other)"
                    inputDescription=""
                >
                    <input
                        type="text"
                        placeholder="Specify location (other)"
                        class="errorFormInput"
                        v-model="form.specifyLocationByUser"
                    />
                    <p
                        class="text-xs text-red-700 font-bold"
                        v-if="form.errors.specifyLocationByUser"
                    >
                        {{ form.errors.specifyLocationByUser }}
                    </p>
                </FormInputContainer>

                <!-- incident -->
                <FormInputContainer inputLabel="Incident" inputDescription="">
                    <select
                        name="incident"
                        id="incident"
                        class="errorFormInput"
                        v-model="form.incident"
                    >
                        <option value="" disabled>Select incident</option>
                        <option
                            v-for="incident in incident"
                            :key="incident.id"
                            :value="incident.id"
                        >
                            {{ incident.incident }}
                        </option>
                    </select>
                    <p
                        class="text-xs text-red-700 font-bold"
                        v-if="form.errors.incident"
                    >
                        {{ form.errors.incident }}
                    </p>
                </FormInputContainer>
                <!-- type of error -->
                <FormInputContainer
                    inputLabel="Type of error"
                    inputDescription=""
                >
                    <select
                        name="type of error"
                        id="type of error"
                        class="errorFormInput"
                        v-model="form.typeOfError"
                    >
                        <option value="" disabled>Select type of error</option>
                        <option
                            v-for="type_of_error in type_of_error_data"
                            :key="type_of_error.id"
                            :value="type_of_error.id"
                        >
                            {{ type_of_error.type_of_error }}
                        </option>
                    </select>
                    <p
                        class="text-xs text-red-700 font-bold"
                        v-if="form.errors.typeOfError"
                    >
                        {{ form.errors.typeOfError }}
                    </p>
                </FormInputContainer>
                <!-- outcome of error -->
                <FormInputContainer
                    inputLabel="Outcome of error"
                    inputDescription=""
                >
                    <select
                        name="outcome"
                        id="outcome"
                        class="errorFormInput"
                        v-model="form.outcome"
                    >
                        <option value="" disabled>Select outcome</option>
                        <option
                            v-for="outcome in outcomes"
                            :key="outcome.id"
                            :value="outcome.id"
                        >
                            {{ outcome.outcome }}
                        </option>
                    </select>
                    <p
                        class="text-xs text-red-700 font-bold"
                        v-if="form.errors.outcome"
                    >
                        {{ form.errors.outcome }}
                    </p>
                </FormInputContainer>
                <!-- possible factors contributing to error -->
                <FormInputContainer
                    inputLabel="Possible contributing factors"
                    inputDescription=""
                >
                    <select
                        name="preventability"
                        id="preventability"
                        class="errorFormInput"
                        v-model="form.possibleFactors"
                    >
                        <option value="" disabled>
                            Select possible factors
                        </option>
                        <option
                            v-for="possible_factor in possible_factors"
                            :key="possible_factor.id"
                            :value="possible_factor.id"
                        >
                            {{ possible_factor.possible_factor }}
                        </option>
                    </select>
                    <p
                        class="text-xs text-red-700 font-bold"
                        v-if="form.errors.possibleFactors"
                    >
                        {{ form.errors.possibleFactors }}
                    </p>
                </FormInputContainer>
                <!-- preventability -->
                <FormInputContainer
                    inputLabel="Preventability"
                    inputDescription=""
                >
                    <select
                        name="preventability"
                        id="preventability"
                        class="errorFormInput"
                        v-model="form.preventability"
                    >
                        <option value="" disabled>Select preventability</option>
                        <option
                            v-for="preventability in preventability"
                            :key="preventability.id"
                            :value="preventability.id"
                        >
                            {{ preventability.preventability }}
                        </option>
                    </select>
                    <p
                        class="text-xs text-red-700 font-bold"
                        v-if="form.errors.preventability"
                    >
                        {{ form.errors.preventability }}
                    </p>
                </FormInputContainer>
                <!-- suggested preventive measures -->
                <FormInputContainer
                    inputLabel="Suggested preventive measures"
                    inputDescription=""
                >
                    <input
                        type="text"
                        class="errorFormInput"
                        placeholder="Suggested preventive measures"
                        v-model="form.suggestedPreventiveMeasures"
                    />
                    <p
                        class="text-xs text-red-700 font-bold"
                        v-if="form.errors.suggestedPreventiveMeasures"
                    >
                        {{ form.errors.suggestedPreventiveMeasures }}
                    </p>
                </FormInputContainer>
                <!-- preson reporting by occupation  -->
                <FormInputContainer inputLabel="Occupation" inputDescription="">
                    <select
                        name="occupation"
                        v-model="form.occupation"
                        id="occupation"
                        class="errorFormInput"
                    >
                        <option value="" disabled>Select Occupation</option>
                        <option
                            v-for="occupation in occupations"
                            :key="occupation.id"
                            :value="occupation.id"
                        >
                            {{ occupation.occupation }}
                        </option>
                    </select>
                    <p
                        class="text-xs text-red-700 font-bold"
                        v-if="form.errors.occupation"
                    >
                        {{ form.errors.occupation }}
                    </p>
                </FormInputContainer>
                <!-- email -->
                <FormInputContainer inputLabel="Email" inputDescription="">
                    <input
                        type="text"
                        placeholder="Email(optional)"
                        class="errorFormInput"
                        v-model="form.email"
                    />
                    <p
                        class="text-xs text-red-700 font-bold"
                        v-if="form.errors.email"
                    >
                        {{ form.errors.email }}
                    </p>
                </FormInputContainer>
                <input type="number " hidden v-model="user_id" name="" id="" />
            </div>

            <!-- submit button -->
            <div class="my-9">
                <button
                    type="submit"
                    class="bg-primary hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md"
                >
                    Submit
                </button>
            </div>
        </form>
    </div>
</template>

<script>
import FormInputContainer from "./../../components/ErrorForm/FormInputContainer";
import { useForm } from "@inertiajs/inertia-vue3";
import moment from "moment";

export default {
    data() {
        return {
            age_selector_model: "Years",
            age_min_value: 0,
            age_max_value: 0,
            form: this.$inertia.form({
                ipOrOpNumber: "",
                diagnosis: "",
                gender: "",
                date: "",
                time: "",
                age: "",
                locationOfError: "",
                specificLocation: "",
                specifyLocationByUser: "",
                incident: "",
                typeOfError: "",
                outcome: "",
                possibleFactors: "",
                preventability: "",
                suggestedPreventiveMeasures: "",
                occupation: "",
                email: "",
                user_id: `${
                    this.$page.props.user == null
                        ? ""
                        : parseInt(this.$page.props.user.id)
                }`,
            }),
        };
    },

    components: {
        FormInputContainer,
    },
    props: {
        errors: Object,
        success: String,
        incident: Array,
        locations: Array,
        occupations: Array,
        outcomes: Array,
        possible_factors: Array,
        preventability: Array,
        type_of_error: Array,
        specific_location: Array,
        user_id: Number,
        user: Object,
    },

    watch: {
        age_selector_model() {
            // alert(this.age_selector_model);
            if (this.age_selector_model == "Unknown") {
                this.form.age = "Unknown";
            }
        },
    },
    computed: {
        current_date() {
            return moment().format("YYYY-MM-DD");
        },

        specific_location_data() {
            let filteredData = [];
            if (this.locations.length > 0) {
                filteredData = this.specific_location.filter((item) => {
                    return item.location_id == this.form.locationOfError;
                });
            }

            return filteredData;
        },
        type_of_error_data() {
            let filteredData = [];
            if (this.type_of_error.length > 0) {
                filteredData = this.type_of_error.filter((item) => {
                    return item.incident_id == this.form.incident;
                });
            }

            return filteredData;
        },

        get_age_data: function () {
            let total = "";
            if (this.age_selector_model == "Months") {
                total = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

                total = total.map((val) => {
                    return val + "M";
                });
            }
            if (this.age_selector_model == "Years") {
                total = [
                    1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17,
                    18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32,
                    33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47,
                    48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62,
                    63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77,
                    78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 90, 91, 92,
                    93, 94, 95, 96, 97, 98, 99, 100,
                ];
                total = total.map((val) => {
                    return val + "Y";
                });
            }

            if (this.age_selector_model == "Days") {
                total = [
                    1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17,
                    18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32,
                    33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47,
                    48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62,
                    63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77,
                    78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 90, 91, 92,
                    93, 94, 95, 96, 97, 98, 99, 100,
                ];
                total = total.map((val) => {
                    return val + "D";
                });
            }

            return total;
        },
    },

    methods: {
        submit() {
            this.$inertia.post("/", this.myform);
        },
    },
};
</script>

<style></style>
