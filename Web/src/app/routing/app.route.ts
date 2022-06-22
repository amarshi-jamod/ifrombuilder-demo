import { Routes } from '@angular/router';

export const appRoutes: Routes = [
    {
        path: '',
        redirectTo: 'users',
        pathMatch: 'full',
    },
    {
        path: 'users',
        loadChildren: () => import('../user/user.module').then(m => m.UserModule),
    },
    { path: '**', redirectTo: 'users' }
];
