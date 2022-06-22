import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { GlobalConstants } from '../models';

@Injectable()
export class HttpService {
    constructor(
        private http: HttpClient
    ) { }

    get(apiPath: string): Observable<any> {
        return this.http.get(GlobalConstants.Host + apiPath);
    }

    post(apiPath: string, requestObject: Object): Observable<any> {
        return this.http.post(GlobalConstants.Host + apiPath, requestObject);
    }

}
