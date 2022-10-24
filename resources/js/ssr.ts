import {createSSRApp, h} from 'vue';
import {renderToString} from '@vue/server-renderer';
import {createInertiaApp} from '@inertiajs/inertia-vue3';
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';
import {ZiggyVue} from '@ziggy/vue.m.js';

export async function handler(event) {
    return await createInertiaApp({
        page: event,
        render: renderToString,
        title: (title) => `${title} - Laravel`,
        resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
        setup({app, props, plugin}) {
            return createSSRApp({render: () => h(app, props)})
                .use(plugin)
                .use(ZiggyVue, {
                    ...event.props.ziggy,
                    location: new URL(event.props.ziggy.location),
                });
        },
    })
}
