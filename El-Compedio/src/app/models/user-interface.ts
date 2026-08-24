import {Role} from './role-interface';

export interface User {
    id: number;
    github_id:number;
    username: string;
    email: string;
    image: string;
    role_id: Role;
}