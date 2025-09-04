<template>
    <div>
        <Head :title="title" />

        <JetBanner />

        <div class="h-screen overflow-scroll">
            <nav
                class="bg-white border-b border-gray-200 fixed top-0 w-full z-50"
            >
                <!-- Primary Navigation Menu -->
                <div class="container mx-auto px-4 md:px-0">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div
                                class="shrink-0 flex items-center font-bold text-xl"
                            >
                                <img
                                    class="h-10"
                                    src="/images/knh_logo.png"
                                    alt="Logo"
                                />
                                <Link :href="route('dashboard')">
                                    Medical Error Tool
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div
                                class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"
                            >
                                <JetNavLink
                                    :href="route('dashboard')"
                                    :active="route().current('dashboard')"
                                >
                                    Dashboard
                                </JetNavLink>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <div class="ml-3 relative">
                                <!-- Teams Dropdown -->
                                <JetDropdown
                                    v-if="$page.props.jetstream.hasTeamFeatures"
                                    align="right"
                                    width="60"
                                >
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition"
                                            >
                                                {{
                                                    $page.props.user
                                                        .current_team.name
                                                }}

                                                <svg
                                                    class="ml-2 -mr-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <div class="w-60">
                                            <!-- Team Management -->
                                            <template
                                                v-if="
                                                    $page.props.jetstream
                                                        .hasTeamFeatures
                                                "
                                            >
                                                <div
                                                    class="block px-4 py-2 text-xs text-gray-400"
                                                >
                                                    Manage Team
                                                </div>

                                                <!-- Team Settings -->
                                                <JetDropdownLink
                                                    :href="
                                                        route(
                                                            'teams.show',
                                                            $page.props.user
                                                                .current_team
                                                        )
                                                    "
                                                >
                                                    Team Settings
                                                </JetDropdownLink>

                                                <JetDropdownLink
                                                    v-if="
                                                        $page.props.jetstream
                                                            .canCreateTeams
                                                    "
                                                    :href="
                                                        route('teams.create')
                                                    "
                                                >
                                                    Create New Team
                                                </JetDropdownLink>

                                                <div
                                                    class="border-t border-gray-100"
                                                />

                                                <!-- Team Switcher -->
                                                <div
                                                    class="block px-4 py-2 text-xs text-gray-400"
                                                >
                                                    Switch Teams
                                                </div>

                                                <template
                                                    v-for="team in $page.props
                                                        .user.all_teams"
                                                    :key="team.id"
                                                >
                                                    <form
                                                        @submit.prevent="
                                                            switchToTeam(team)
                                                        "
                                                    >
                                                        <JetDropdownLink
                                                            as="button"
                                                        >
                                                            <div
                                                                class="flex items-center"
                                                            >
                                                                <svg
                                                                    v-if="
                                                                        team.id ==
                                                                        $page
                                                                            .props
                                                                            .user
                                                                            .current_team_id
                                                                    "
                                                                    class="mr-2 h-5 w-5 text-green-400"
                                                                    fill="none"
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    stroke="currentColor"
                                                                    viewBox="0 0 24 24"
                                                                >
                                                                    <path
                                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                                                    />
                                                                </svg>
                                                                <div>
                                                                    {{
                                                                        team.name
                                                                    }}
                                                                </div>
                                                            </div>
                                                        </JetDropdownLink>
                                                    </form>
                                                </template>
                                            </template>
                                        </div>
                                    </template>
                                </JetDropdown>
                            </div>

                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative">
                                <JetDropdown align="right" width="48">
                                    <template #trigger>
                                        <button
                                            v-if="
                                                $page.props.jetstream
                                                    .managesProfilePhotos
                                            "
                                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition"
                                        >
                                            <img
                                                class="h-8 w-8 rounded-full object-cover"
                                                :src="
                                                    $page.props.user
                                                        .profile_photo_url
                                                "
                                                :alt="$page.props.user.name"
                                            />
                                        </button>

                                        <span
                                            v-else
                                            class="inline-flex rounded-md"
                                        >
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition"
                                            >
                                                {{
                                                    $page.props.user.first_name
                                                        .charAt(0)
                                                        .toUpperCase() +
                                                    $page.props.user.last_name
                                                        .charAt(0)
                                                        .toUpperCase() +
                                                    $page.props.user
                                                        .personal_number
                                                }}
                                                <svg
                                                    class="ml-2 -mr-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <JetResponsiveNavLink
                                            :href="route('dashboard')"
                                            :active="
                                                route().current('dashboard')
                                            "
                                        >
                                            Dashboard
                                        </JetResponsiveNavLink>
                                        <JetResponsiveNavLink
                                            :href="route('dashboard.tables')"
                                            :active="
                                                route().current(
                                                    'dashboard.tables'
                                                )
                                            "
                                        >
                                            Tables
                                        </JetResponsiveNavLink>
                                        <JetResponsiveNavLink
                                            :href="route('dashboard.fields')"
                                            :active="
                                                route().current(
                                                    'dashboard.fields'
                                                )
                                            "
                                            v-if="
                                                $page.props.user
                                                    .account_type === 'root' ||
                                                $page.props.user
                                                    .account_type === 'admin'
                                            "
                                        >
                                            Fields
                                        </JetResponsiveNavLink>

                                        <JetResponsiveNavLink
                                            :href="route('dashboard.profile')"
                                            :active="
                                                route().current(
                                                    'dashboard.profile'
                                                )
                                            "
                                        >
                                            Profile
                                        </JetResponsiveNavLink>

                                        <JetResponsiveNavLink
                                            :href="route('dashboard.accounts')"
                                            :active="
                                                route().current(
                                                    'dashboard.accounts'
                                                )
                                            "
                                            v-if="
                                                $page.props.user
                                                    .account_type === 'root' ||
                                                $page.props.user
                                                    .account_type === 'admin'
                                            "
                                        >
                                            Accounts
                                        </JetResponsiveNavLink>

                                        <JetResponsiveNavLink
                                            :href="route('errorform')"
                                            :active="
                                                route().current('errorform')
                                            "
                                        >
                                            Error Form
                                        </JetResponsiveNavLink>

                                        <JetResponsiveNavLink
                                            v-if="
                                                $page.props.user
                                                    .account_type === 'root' ||
                                                $page.props.user
                                                    .account_type === 'admin'
                                            "
                                            :href="
                                                route('dashboard.registeruser')
                                            "
                                            :active="
                                                route().current(
                                                    'dashboard.registeruser'
                                                )
                                            "
                                        >
                                            Create User
                                        </JetResponsiveNavLink>
                                        <div class="border-t border-gray-100" />
                                        <!-- Authentication -->
                                        <form @submit.prevent="logout">
                                            <JetDropdownLink as="button">
                                                Log Out
                                            </JetDropdownLink>
                                        </form>
                                    </template>
                                </JetDropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition"
                                @click="
                                    showingNavigationDropdown =
                                        !showingNavigationDropdown
                                "
                            >
                                <svg
                                    class="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex':
                                                !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex':
                                                showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{
                        block: showingNavigationDropdown,
                        hidden: !showingNavigationDropdown,
                    }"
                    class="sm:hidden"
                >
                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="mt-3 space-y-1">
                            <JetResponsiveNavLink
                                :href="route('dashboard')"
                                :active="route().current('dashboard')"
                            >
                                Dashboard
                            </JetResponsiveNavLink>
                            <JetResponsiveNavLink
                                :href="route('dashboard.tables')"
                                :active="route().current('dashboard.tables')"
                            >
                                Tables
                            </JetResponsiveNavLink>
                            <JetResponsiveNavLink
                                v-if="
                                    $page.props.user.account_type === 'root' ||
                                    $page.props.user.account_type === 'admin'
                                "
                                :href="route('dashboard.fields')"
                                :active="route().current('dashboard.fields')"
                            >
                                Fields
                            </JetResponsiveNavLink>

                            <JetResponsiveNavLink
                                :href="route('dashboard.profile')"
                                :active="route().current('dashboard.profile')"
                            >
                                Profile
                            </JetResponsiveNavLink>

                            <JetResponsiveNavLink
                                :href="route('dashboard.accounts')"
                                :active="route().current('dashboard.accounts')"
                                v-if="
                                    $page.props.user.account_type === 'root' ||
                                    $page.props.user.account_type === 'admin'
                                "
                            >
                                Accounts
                            </JetResponsiveNavLink>

                            <!-- Authentication -->
                            <form method="POST" @submit.prevent="logout">
                                <JetResponsiveNavLink as="button">
                                    Log Out
                                </JetResponsiveNavLink>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main
                class="container mx-auto pt-6 grid grid-cols-12 gap-6 mt-14 relative"
            >
                <!-- sidebar -->
                <div class="col-span-2 hidden md:block">
                    <aside class="shadow-lg rounded-xl p-4 bg-gray-200">
                        <p class="pb-2 font-bold">
                            {{
                                $page.props.user.first_name
                                    .charAt(0)
                                    .toUpperCase() +
                                $page.props.user.last_name
                                    .charAt(0)
                                    .toUpperCase() +
                                $page.props.user.personal_number
                            }}
                        </p>

                        <ul class="pt-3 flex flex-col gap-y-3">
                            <li>
                                <Link
                                    href="/dashboard"
                                    class="sidebarLink"
                                    :class="{
                                        'bg-primary shadow-xl text-white':
                                            $page.url == '/dashboard',
                                    }"
                                >
                                    dashboard
                                </Link>
                            </li>
                            <li
                                v-if="
                                    $page.props.user.account_type !== 'reporter'
                                "
                            >
                                <Link
                                    href="/dashboard/tables"
                                    class="sidebarLink"
                                    :class="{
                                        'bg-primary shadow-xl text-white':
                                            $page.url == '/dashboard/tables',
                                    }"
                                >
                                    tables
                                </Link>
                            </li>
                            <li
                                v-if="
                                    $page.props.user.account_type === 'root' ||
                                    $page.props.user.account_type === 'admin'
                                "
                            >
                                <Link
                                    href="/dashboard/fields"
                                    class="sidebarLink"
                                    :class="{
                                        'bg-primary shadow-xl text-white':
                                            $page.url == '/dashboard/fields',
                                    }"
                                >
                                    fields
                                </Link>
                            </li>
                            <li>
                                <Link
                                    href="/dashboard/profile"
                                    class="sidebarLink"
                                    :class="{
                                        'bg-primary shadow-xl text-white':
                                            $page.url == '/dashboard/profile',
                                    }"
                                >
                                    profile
                                </Link>
                            </li>
                            <li
                                v-if="
                                    $page.props.user.account_type === 'root' ||
                                    $page.props.user.account_type === 'admin'
                                "
                            >
                                <Link
                                    href="/dashboard/accounts"
                                    class="sidebarLink"
                                    :class="{
                                        'bg-primary shadow-xl text-white':
                                            $page.url == '/dashboard/accounts',
                                    }"
                                >
                                    accounts
                                </Link>
                            </li>
                            <li>
                                <Link
                                    href="/"
                                    class="sidebarLink"
                                    :class="{
                                        'bg-primary shadow-xl text-white':
                                            $page.url == '/',
                                    }"
                                >
                                    Error Form
                                </Link>
                            </li>
                            <li
                                v-if="
                                    $page.props.user.account_type === 'root' ||
                                    $page.props.user.account_type === 'admin'
                                "
                            >
                                <Link
                                    href="/dashboard/user/register"
                                    class="sidebarLink"
                                    :class="{
                                        'bg-primary shadow-xl text-white':
                                            $page.url ==
                                            '/dashboard/user/register',
                                    }"
                                >
                                    Create Accounts
                                </Link>
                            </li>
                        </ul>
                    </aside>
                </div>

                <div
                    class="shadow-lg rounded-xl bg-gray-200 px-8 py-4 col-span-12 md:col-span-10"
                >
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>

<script>
import { reactive, computed, ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/inertia-vue3";
import JetApplicationMark from "@/Jetstream/ApplicationMark.vue";
import JetBanner from "@/Jetstream/Banner.vue";
import JetDropdown from "@/Jetstream/Dropdown.vue";
import JetDropdownLink from "@/Jetstream/DropdownLink.vue";
import JetNavLink from "@/Jetstream/NavLink.vue";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink.vue";

export default {
    name: "AppLayout",
    props: {
        title: String,
        user: Object,
    },
    data() {
        return {
            showingNavigationDropdown: false,
        };
    },
    methods: {
        logout() {
            Inertia.post("/logout");
        },
    },
    components: {
        Head,
        Link,
        JetApplicationMark,
        JetBanner,
        JetDropdown,
        JetDropdownLink,
        JetNavLink,
        JetResponsiveNavLink,
    },
};
</script>
