import { ComponentFixture, TestBed } from '@angular/core/testing';
import { ManualDetailed } from './manual-detailed';

describe('ManualDetailed', () => {
  let component: ManualDetailed;
  let fixture: ComponentFixture<ManualDetailed>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [ManualDetailed],
    }).compileComponents();

    fixture = TestBed.createComponent(ManualDetailed);
    component = fixture.componentInstance;
    await fixture.whenStable();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
