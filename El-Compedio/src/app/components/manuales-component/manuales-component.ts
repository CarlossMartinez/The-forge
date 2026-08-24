import { Component, inject, signal } from '@angular/core';
import { CompedioService } from '../../services/compedio-service';
import { Manual } from '../../models/manual-interface';
import { Router } from '@angular/router';


@Component({
  imports: [],
  selector: 'app-manuales-component',
  standalone: true,
  styleUrl: './manuales-component.css',
  templateUrl: './manuales-component.html',
})

export class ManualesComponent {

  private compedioService = inject(CompedioService);

  manuales = signal<Manual[]>([]);
  
  cargando = signal<boolean> (true);
  
  contador = signal<number>(0);

  private router = inject(Router);

  error = signal<string | null> (null);

  constructor(){
    this.cargarManuales();
  }
  cargarManuales() : void{
    this.compedioService.obtenerManuales().subscribe({
      next: (data)=>{
        this.manuales.set(data);
        this.cargando.set(false);
      },
      error: (err)=>{
        console.error('Error al obtener los manuales:', err);
        this.error.set('Error al obtener los manuales');
        this.cargando.set(false);
      }
    });
  }
  
  // funcion (parametro:tipo) : Tipo_Return {} 

  navegarAManual(manual_code: string): void {
    this.router.navigate(['manual', manual_code]);
  }
  sumarClick(): void {
    this.contador.update(valorActual => valorActual + 1);
  }

}
