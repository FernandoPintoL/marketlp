import { BaseData } from '@/Data/BaseData';
export interface Almacen {
    id?: number;
    sigla: string;
    detalle: string;
    direccion: string;
    created_at?: string;
    updated_at?: string;
}
export class AlmacenData extends BaseData<Almacen> {
    protected path_api_url: string = 'api.almacen';
}
export function getDefaultAttributes() {
    return {
        id: true,
        sigla: true,
        detalle: true,
        direccion: true,
        created_at: false,
        updated_at: false,
    } as Record<string, boolean>;
}
export const selectedAttributes = getDefaultAttributes();
export const attributesHead = [
    { key: 'id', label: 'ID', isSearch: true },
    { key: 'sigla', label: 'Sigla', isSearch: true },
    { key: 'detalle', label: 'Detalle', isSearch: true },
    { key: 'direccion', label: 'Dirección', isSearch: true },
    { key: 'acciones', label: 'Acciones', isSearch: false },
];
