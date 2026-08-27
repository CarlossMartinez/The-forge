import { User } from './user-interface';
import {ManualType} from '../shared/enums/manual-type.enum';

export interface ManualFull {
    manual_code: string,
    name: string,
    description: string,
    system: string,
    manual_type: ManualType,
    is_active : boolean,
    user_id: User,
    spells: {
        name : string,
        description : string,
        level : number,
        school : string,
        casting_time: string,
        duration: string,
        range : string,
        components : string,
    },
    races:{
        name: string,
        description : string,
    },
    subraces:{
        name : string,
        description : string,
        race_id : number, 
    },
    feats : {
        name : string,
        description : string,
    },
    backgrounds: {
        name : string,
        description : string,
    },
    classes : {
        name : string,
        description : string,
        hit_die : number,
        spelcaster: boolean,
        spellcasting_ability : string,
    },
    subclasses : {
        name : string,
        description : string,
        clase_id : number,
    },
    items : {
        name : string,
        description : string,
        type : string,
        rarity : string,
        wheight : number,
        value : number,
    },
    passives : {
        name : string,
        description : string,
    },
    stats: {
        name: string,
        description: string,
    }
}