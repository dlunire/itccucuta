import { getComponent, type Route, route } from './sources/generator';

import Home from '../pages/Home.svelte';
import User from '../pages/User.svelte';
import Install from '../pages/Install.svelte';

export const routes: Route[] = [
    route('/', getComponent(Home), []),
    route('/profile/:id', getComponent(User), ['id']),
    route('/install/credentials', getComponent(Install), []),
];
