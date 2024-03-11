<template>
    <div class="bg-secondary text-white">
        <div class="container">
            <div class="d-flex justify-content-between px-2">
                <div>
                    <small>
                        {{ admin.email }}
                        (<Link class="btn btn-link btn-sm py-0 px-0 link-info" :onBefore="confirmLogout" :href="route('logout')" method="post" as="button" type="button">
                            Log Out
                        </Link>)
                    </small>
                </div>
                <div>
                    <small>
                        <a target="_blank" :href="route('dashboard.index')" class="btn btn-link btn-sm py-0 px-0 link-info">Dashboard</a>
                    </small>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
// import { router } from '@inertiajs/vue3'
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

function confirmLogout() {
    return confirm("Are you sure?");
    // return false;
}
// import { usePage } from '@inertiajs/vue3'

// const page = usePage()
//
// const user = page.props.auth.user;


// import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
// import { Bars3Icon, BellIcon, XMarkIcon } from '@heroicons/vue/24/outline'
//
// const navigation = [
//     { name: 'Blog', href: route('home'), current: route().current('home') },
//     { name: 'Last 5 Posts', href: route('last_5'), current: route().current('last_5') },
//     { name: 'Tags', href: route('tags'), current: route().current('tags') },
//     // { name: 'Projects', href: route('tags'), current: false },
//     // { name: 'Calendar', href: '#', current: false },
// ]
//
// const navigationLeft = [
//     { name: 'Login', href: route('login'), current: route().current('login') },
//     { name: 'Register', href: route('register'), current: route().current('register') },
// ]
</script>
