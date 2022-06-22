import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { GlobalConstants, User } from '../models';
import { HttpService } from './http.service';

@Injectable()
export class UserService {

    constructor(
        private httpService: HttpService
    ) { }

    getUsers(): Observable<any> {
        return this.httpService.get(GlobalConstants.ApiUrl.User.GetAllUsers);
    }

    addUser(user: User): Observable<any> {
        return this.httpService.post(GlobalConstants.ApiUrl.User.AddUser, user);
    }

}
