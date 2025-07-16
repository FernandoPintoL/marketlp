import { BaseData } from '@/Data/BaseData';

export interface Inventario {
    item_id: number;
    almacen_id: number;
    sector_id: number;
    stock: number;
    created_at: string;
    updated_at: string;
}
export class InventarioData extends BaseData<Inventario>{
    protected path_api_url: string = 'api.inventario';
}

export function getDefaultAttributes() {
    return {
        item_id: true,
        almacen_id: true,
        sector_id: true,
        stock: true,
        created_at: false,
        updated_at: false,
    } as Record<string, boolean>;
}
export const selectedAttributes = getDefaultAttributes();
export const attributesHead = [
    { key: 'item_id', label: 'Item ID', isSearch: true },
    { key: 'almacen_id', label: 'Almacen ID', isSearch: true },
    { key: 'sector_id', label: 'Sector ID', isSearch: true },
    { key: 'stock', label: 'Stock', isSearch: true },
    { key: 'acciones', label: 'Acciones', isSearch: false },
];
