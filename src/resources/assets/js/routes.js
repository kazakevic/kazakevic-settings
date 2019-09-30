import SettingsIndex from './components/admin/options/SettingsIndex';
import SettingsCreate from './components/admin/options/SettingsCreate';
import SettingsEdit from './components/admin/options/SettingsEdit';

export const routes = [
    { path: '/', components: {
            settingsIndex: SettingsIndex,
        }
    },
    { path: '/settings/create', component: SettingsCreate, name: 'optionCreate' },
    { path: '/settings/edit/:id', component: SettingsEdit, name: 'optionEdit' },
];
