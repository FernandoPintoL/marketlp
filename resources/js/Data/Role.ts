import { BaseData } from '@/Data/BaseData';

export interface Role {
    id: number;
    name: string;
    guard_name: string;
    created_at: string;
    updated_at: string;
}
export class RoleData extends BaseData<Role>{
    protected path_api_url: string = 'api.role';
}
export function getDefaultAttributes() {
    return {
        id: true,
        name: true,
        guard_name: true,
        created_at: false,
        updated_at: false,
    } as Record<string, boolean>;
}
export const selectedAttributes = getDefaultAttributes();
export const attributesHead = [
    { key: 'id', label: 'ID', isSearch: true },
    { key: 'name', label: 'Nombre', isSearch: true },
    { key: 'guard_name', label: 'Guard Name', isSearch: true },
    { key: 'acciones', label: 'Acciones', isSearch: false },
];
