import { Injectable} from '@angular/core';
import{HttpClient} from '@angular/common/http';
import { Observable } from 'rxjs';
import { Manual } from '../models/manual-interface';
import { environment } from '../../environments/environment';
import { API } from '../shared/API/api';
import { ManualFull } from '../models/manualFull-interface';
@Injectable({
    providedIn: 'root'
})

export class CompedioService {
    constructor(private http: HttpClient) {}
    obtenerManuales() : Observable<Manual[]> {
        return this.http.get<Manual[]> (`${environment.apiUrl}${API.MANUALS.GETALL}`);
    }
    obtenerManualFull(manual_code : string) : Observable<ManualFull> {
        return this.http.get<ManualFull> (`${environment.apiUrl}${API.MANUALS.GETFULL}/${manual_code}`);
    }
}
