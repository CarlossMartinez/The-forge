import { User } from "./user-interface";

import {ManualType} from '../shared/enums/manual-type.enum';

export interface Manual {
  manual_code: string;
  name: string;
  description: string;
  system: string;
  manual_type: ManualType;
  user_id: User; 
  createdAt: Date;
  updatedAt: Date;
}