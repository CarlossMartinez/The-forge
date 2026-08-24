import { signal } from '@angular/core';
import { Manual } from '../models/manual-interface';

export const selectedManual = signal<Manual | null>(null);