import { TestBed } from '@angular/core/testing';
import { CompedioService } from './compedio-service';

describe('CompedioService', () => {
  let service: CompedioService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(CompedioService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
