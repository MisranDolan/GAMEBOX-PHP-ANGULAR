//Service file that allows the creation of new listings to be pushed to the database
import { Injectable } from '@angular/core';
import { HttpClient, HttpErrorResponse, HttpParams } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';

import { Listing } from './listing';


@Injectable({
  providedIn: 'root'
})
export class ListingService {

  listing = new Listing('', '', '', null, '', '', '');

  constructor(private http: HttpClient) { }

  sendRequest(data: any): Observable<any> {
    // return this.http.post('http://localhost/cs4640/inclass11/ngphp-post.php', data, {responseType: 'text'});
    // return this.http.post('http://localhost/cs4640/inclass11/ngphp-post.php', data, {responseType: 'json'});
    return this.http.post('http://localhost/gamebox/ngphp-post.php', data);
  }

  sendListing(data): Observable<any> {
    return this.sendRequest(data);
  }
}
