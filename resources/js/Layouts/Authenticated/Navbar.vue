<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

const leftNavigation = [
    {
        url: route('dashboard.index'),
        active: route().current('dashboard.index'),
        title: 'Dashboard'
    },
    {
        url: route('dashboard.post.index'),
        active: route().current('dashboard.post.index') ||
            route().current('dashboard.post.edit') ||
            route().current('dashboard.post.create'),
        title: 'Posts'
    },
    {
        url: route('dashboard.category.index'),
        active: route().current('dashboard.category.index') ||
            route().current('dashboard.category.edit') ||
            route().current('dashboard.category.create'),
        title: 'Categories'
    },
    // {
    //     url: route('dashboard.latest'),
    //     active: route().current('dashboard.latest'),
    //     title: 'Top Latest Posts'
    // },
];
</script>

<template>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
<!--            <a class="navbar-brand" href="#">Navbar</a>-->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <Link v-for="itm in leftNavigation" :href="itm.url" :class="{
                        active: itm.active,
                        disabled: itm.disabled
                    }" class="nav-link position-relative">
                        {{ itm.title }}
                    </Link>
                </div>
                <div class="navbar-nav">
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ $page.props.auth.user.email }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <Link class="dropdown-item" :href="route('profile.edit')">Profile</Link>
                            </li>
                            <li>
<!--                                <a class="dropdown-item" href="#">Another action</a>-->
                                <Link class="dropdown-item" :href="route('logout')" method="post" as="button">Log Out</Link>
                            </li>
                        </ul>
                    </div>
                    <a target="_blank" :href="route('home')" class="btn btn-primary">
                        Blog
                    </a>
                </div>
            </div>
        </div>
    </nav>

</template>
