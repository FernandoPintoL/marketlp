import { BaseData } from '@/Data/BaseData';
export interface EmpleadoCargo {
    id?: number;
    sigla: string;
    detalle: string;
    created_at?: string;
    updated_at?: string;
}
export class EmpleadoCargoData extends BaseData<EmpleadoCargo> {
    protected path_api_url: string = 'api.empleadocargo';
}
export function getDefaultAttributes() {
    return {
        id: true,
        sigla: true,
        detalle: true,
        created_at: false,
        updated_at: false,
    } as Record<string, boolean>;
}
export const selectedAttributes = getDefaultAttributes();
export const attributesHead = [
    { key: 'id', label: 'ID', isSearch: true },
    { key: 'sigla', label: 'Sigla', isSearch: true },
    { key: 'detalle', label: 'Detalle', isSearch: true },
    { key: 'acciones', label: 'Acciones', isSearch: false },
];
