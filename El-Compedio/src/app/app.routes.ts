import { Routes } from '@angular/router';
import { ManualesComponent } from './components/manuales-component/manuales-component';

export const routes: Routes = [
  { path: '', component: ManualesComponent },
  { path:'manual/:manual_code', component: ManualesComponent }
];