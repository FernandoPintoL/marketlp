import { BaseData } from '@/Data/BaseData';
import { TipoPrecios } from '@/Data/TipoPrecios';
export interface PrecioItem {
    id?: number;
    items_id: number;
    tipo_precio_id: number;
    precio: number;
    created_at?: string;
    updated_at?: string;
    tipo_precio?: TipoPrecios;
}
export class PrecioItemData extends BaseData<PrecioItem> {
    protected path_api_url: string = 'api.precioitem';
}
export function getDefaultAttributes() {
    return {
        id: true,
        items_id: true,
        tipo_precio_id: true,
        precio: true,
        created_at: false,
        updated_at: false,
    } as Record<string, boolean>;
}
export const selectedAttributes = getDefaultAttributes();
export const attributesHead = [
    { key: 'id', label: 'ID', isSearch: true },
    { key: 'items_id', label: 'Item', isSearch: true },
    { key: 'tipo_precio_id', label: 'Tipo Precio', isSearch: true },
    { key: 'precio', label: 'Precio', isSearch: true },
    { key: 'acciones', label: 'Acciones', isSearch: false },
];
