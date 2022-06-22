import { Routes } from '@angular/router';
import { AddUserComponent, UserListComponent } from '../components';

export const userRoutes: Routes = [
  {
    path: '',
    component: UserListComponent
  },
  {
    path: 'create',
    component: AddUserComponent
  }
];
