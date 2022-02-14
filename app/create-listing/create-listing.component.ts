//Component file that exports the listing class, and defines the logic for pushing listing information from the front end
import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpErrorResponse, HttpParams } from '@angular/common/http';
import { Listing } from '../listing';
import { ListingService } from '../listing.service';
@Component({
  selector: 'app-create-listing',
  templateUrl: './create-listing.component.html',
  styleUrls: ['./create-listing.component.css']
})
export class CreateListingComponent implements OnInit {

  myFiles: string[] = [];


  ngOnInit(): void {
  }
  constructor(private listingService: ListingService) { }
  listingModel = new Listing('', '', '', null, '', '', '');

  conditions = ['New', 'Used'];
  consoles = ["PS4", "Nintendo Switch", "Xbox One", "PC", "PS3", "Xbox 360", "Wii U", "Wii"];
  onFileChange(event) {

    for (var i = 0; i < event.target.files.length; i++) {
      this.myFiles.push(event.target.files[i]);
    }
  }

  onSubmit(data): void {
    //this.responsedata = this.orderService.onSubmit(data)
    console.log(data)

    function readCookie(name) {
      var cookiename = name + "=";
      var ca = document.cookie.split(';');
      for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(cookiename) == 0) return c.substring(cookiename.length, c.length);
      }
      return null;
    }

    let formData = new FormData();
    readCookie('site')
    formData.append("username", readCookie('usernamejs'))
    for (var i = 0; i < this.myFiles.length; i++) {
      formData.append("file[]", this.myFiles[i]);
    }

    for (var x in data) {
      formData.append(x, data[x]);
    }

    this.listingService.sendListing(formData)
      .subscribe((res) =>
        console.log("formData")
      );
  }
}
