import './bootstrap';
// import '../css/app.css';
import '../scss/app.scss';
import 'bootstrap/dist/js/bootstrap.bundle.js';
// import "bootstrap-icons/font/bootstrap-icons.css";

// import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
// import 'datatables.net-bs5';
// import 'primevue/resources/themes/aura-light-green/theme.css'
// import 'datatables.net-bs5';

// import 'bootstrap/dist/css/bootstrap.css'
// import 'bootstrap-vue/dist/bootstrap-vue.css'

import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';

DataTable.use(DataTablesCore);

// import PrimeVue from 'primevue/config';
import CKEditor from '@ckeditor/ckeditor5-vue';
import { createApp, h } from 'vue';
import { createInertiaApp, usePage } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

import { computed } from 'vue'

const page = usePage()
const user = computed(() => page.props.auth.user)
const flash = computed(() => page.props.flash)

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    // title: (title) => `${title} - ${appName}`,
    title: (title) => `${title}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(CKEditor)
            // .use(DataTable)
            .mixin({
                data: function () {
                    return {
                        admin: user,
                        flash: flash,
                    }
                },
            })
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
