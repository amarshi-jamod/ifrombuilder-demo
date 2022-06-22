import { NgModule } from '@angular/core';
import { CoreModule } from 'src/core/core.module';
import { AddUserComponent, UserListComponent } from './components';
import { UserRoutingModule } from './routing/user-routing.module';

@NgModule({
  imports: [
    CoreModule,
    UserRoutingModule,
  ],
  declarations: [
    // Components
    UserListComponent,
    AddUserComponent
  ]
})
export class UserModule { }
