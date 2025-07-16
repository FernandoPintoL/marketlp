import { BaseData } from '@/Data/BaseData';

export interface Sector {
    id: number;
    almacen_id: number;
    codigo: string;
    nombre: string;
    descripcion: string;
    maximo: number;
    minimo: number;
    created_at: string;
    updated_at: string;
}
export class SectorData extends BaseData<Sector>{
    protected path_api_url: string = 'api.sector';
}
export function getDefaultAttributes() {
    return {
        id: true,
        almacen_id: true,
        codigo: true,
        nombre: true,
        descripcion: false,
        maximo: true,
        minimo: true,
        created_at: false,
        updated_at: false,
    } as Record<string, boolean>;
}
export const selectedAttributes = getDefaultAttributes();
export const attributesHead = [
    { key: 'id', label: 'ID', isSearch: true },
    { key: 'almacen_id', label: 'Almacen ID', isSearch: true },
    { key: 'codigo', label: 'Codigo', isSearch: true },
    { key: 'nombre', label: 'Nombre', isSearch: true },
    { key: 'descripcion', label: 'Descripcion', isSearch: true },
    { key: 'maximo', label: 'Maximo', isSearch: true },
    { key: 'minimo', label: 'Minimo', isSearch: true },
    { key: 'acciones', label: 'Acciones', isSearch: false },
];
