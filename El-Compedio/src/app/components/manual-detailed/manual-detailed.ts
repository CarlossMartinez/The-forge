import { CompedioService } from './../../services/compedio-service';
import { Component, inject, signal } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { ManualFull } from '../../models/manualFull-interface';
import { Router } from '@angular/router';

@Component({
  imports: [],
  selector: 'app-manual-detailed',
  styleUrl: './manual-detailed.css',
  templateUrl: './manual-detailed.html',
})

/**
 * 
 * ? Porque tanto comentario en el codigo? Eso se pregunta el Carlos que haga mantenimiento a esto
 * ? Pues como dice Robe justo ahora a fecha del 25/08/2026 "Y es que soy maestro en la contradicción" Que sino me paso 3h revisando codigo sin entender
 */

export class ManualDetailed {
  // Mediante Inject, tengo acceso a mi Service, Al router para SPA y a la Url. en este orden 
  private CompedioService = inject(CompedioService);

  private router = inject(Router);
  private route = inject(ActivatedRoute);

  // Esto llevará el manual entero 
  manualFull = signal<ManualFull[]> ([]);

  // ! Tratado de cargado y errores 
  cargando = signal<boolean> (true);
  error = signal<string | null> (null);

  manual_code : string  = ""; 
  constructor(){
    this.manual_code = this.route.snapshot.paramMap.get('manual_code') ?? '';
    this.cargarManualFull();
  }
  /**
   * ? Para esta funcion "Necesito saber, dime tu Nombre (manual_code)"
   * @param manual_code lo recuperamos de la ruta pero lo guardaré como variable global
   */
  cargarManualFull() : void {
    this.CompedioService.obtenerManualFull(this.manual_code).subscribe({
      next: (data) => {
        this.manualFull.set(data);
        this.cargando.set(false);
      },
      error : (err) =>{
        console.error('Error al obtener el manual completo', err);
        this.cargando.set(false);
        this.error.set('Error al obtener el manual completo');
      }
    });
  }
}
