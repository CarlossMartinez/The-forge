import { Routes } from '@angular/router';
import { ManualesComponent } from './components/manuales-component/manuales-component';
import { ManualDetailed } from './components/manual-detailed/manual-detailed';
export const routes: Routes = [
  { path: '', component: ManualesComponent },
  { path:'manual/:manual_code', component: ManualDetailed }
];