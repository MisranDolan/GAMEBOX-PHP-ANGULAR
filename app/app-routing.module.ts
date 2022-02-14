import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { CreateListingComponent } from './create-listing/create-listing.component';


const routes: Routes = [{ path: 'create_listing', component: CreateListingComponent },];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
