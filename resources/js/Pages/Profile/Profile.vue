<template>
    <AppLayout title="Dashboard">
        <div>
            <h1 class="text-2xl font-bold capitalize">profile</h1>
            <br />
            <div class="space-y-4">
                <p class="font-bold capitalize">
                    Username:
                    <span class="font-normal">
                        {{
                            $page.props.user.first_name
                                .charAt(0)
                                .toUpperCase() +
                            $page.props.user.last_name.charAt(0).toUpperCase() +
                            $page.props.user.personal_number
                        }}
                    </span>
                </p>
                <p class="font-bold capitalize">
                    Personal Number:
                    <span class="font-normal"
                        >{{ $page.props.user.personal_number }}
                    </span>
                </p>
                <p class="font-bold capitalize">
                    Title:
                    <span class="font-normal"
                        >{{ $page.props.user.title }}
                    </span>
                </p>
                <p class="font-bold capitalize">
                    Full name:
                    <span class="font-normal"
                        >{{ $page.props.user.first_name }}
                        {{ $page.props.user.last_name }}
                    </span>
                </p>
                <p class="font-bold capitalize">
                    Occupation:
                    <span class="font-normal"
                        >{{ $page.props.user.occupation }}
                    </span>
                </p>
                <p class="font-bold capitalize">
                    Department or Unit:
                    <span class="font-normal"
                        >{{ $page.props.user.department_or_unit }}
                    </span>
                </p>
                <p class="font-bold capitalize">
                    Email (username):
                    <span class="font-normal"
                        >{{ $page.props.user.email }}
                    </span>
                </p>

                <p class="font-bold capitalize">
                    Mobile Number:
                    <span class="font-normal"
                        >{{ $page.props.user.mobile_number }}
                    </span>
                </p>
                <p class="font-bold capitalize">
                    Type of user:
                    <span class="font-normal">{{ user.account_type }} </span>
                </p>
            </div>
        </div>
    </AppLayout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";
export default {
    components: {
        AppLayout,
    },
    props: {
        user: Object,
    },
};
</script>
