import { getComponent, type Route, route } from './sources/generator';

import Home from '../pages/Home.svelte';
import User from '../pages/User.svelte';
import Install from '../pages/Install.svelte';
import Check from '../pages/Check.svelte';
import Login from '../pages/Login.svelte';
import Dashboard from '../pages/admin/Dashboard.svelte';

export const routes: Route[] = [
    route('/', getComponent(Home), []),
    route('/install/credentials', getComponent(Install), []),
    route('/credentials/check', getComponent(Check), []),
    route('/create/user', getComponent(User), []),
    route('/login', getComponent(Login), []),
    route('/dashboard', getComponent(Dashboard), []),
];
