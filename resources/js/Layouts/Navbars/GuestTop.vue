<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
<!--            <a class="navbar-brand" href="#">Navbar</a>-->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <Link v-for="item in navigation" :key="item.name" :href="item.href" :class="['nav-item', 'nav-link' + (item.current ? ' active' : '')]">{{ item.name }}</Link>

<!--                    <li class="nav-item">-->
<!--                        <a class="nav-link active" aria-current="page" href="#">Home</a>-->
<!--                    </li>-->
<!--                    <li class="nav-item">-->
<!--                        <a class="nav-link" href="#">Link</a>-->
<!--                    </li>-->
<!--                    <li class="nav-item dropdown">-->
<!--                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">-->
<!--                            Dropdown-->
<!--                        </a>-->
<!--                        <ul class="dropdown-menu">-->
<!--                            <li><a class="dropdown-item" href="#">Action</a></li>-->
<!--                            <li><a class="dropdown-item" href="#">Another action</a></li>-->
<!--                            <li><hr class="dropdown-divider"></li>-->
<!--                            <li><a class="dropdown-item" href="#">Something else here</a></li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                    <li class="nav-item">-->
<!--                        <a class="nav-link disabled">Disabled</a>-->
<!--                    </li>-->
                </ul>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { Bars3Icon, BellIcon, XMarkIcon } from '@heroicons/vue/24/outline'

const navigation = [
    { name: 'Home', href: route('home'),
        current: route().current('home') || route().current('article') },
    { name: 'Top latest', href: route('latest'),
        current: route().current('latest') || route().current('latest.article') },
    { name: 'Categories', href: route('tags'),
        current: route().current('tags') },
    // { name: 'Projects', href: route('tags'), current: false },
    // { name: 'Calendar', href: '#', current: false },
]

const navigationLeft = [
    { name: 'Login', href: route('login'), current: route().current('login') },
    { name: 'Register', href: route('register'), current: route().current('register') },
]
</script>
