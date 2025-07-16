import { BaseData } from '@/Data/BaseData';

export interface Item {
    id?: number;
    name: string;
    descripcion: string;
    photo_path?: string;
    categoria_id: number;
    unidad_id: number;
    created_at?: string;
    updated_at?: string;
}

export class ItemData extends BaseData<Item> {
    protected path_api_url: string = 'api.item';
}

export function getDefaultAttributes() {
    return {
        id: true,
        name: true,
        descripcion: true,
        photo_path: false,
        categoria_id: true,
        unidad_id: true,
        created_at: false,
        updated_at: false,
    } as Record<string, boolean>;
}

export const selectedAttributes = getDefaultAttributes();

export const attributesHead = [
    { key: 'id', label: 'ID', isSearch: true },
    { key: 'name', label: 'Nombre', isSearch: true },
    { key: 'descripcion', label: 'Descripción', isSearch: true },
    { key: 'categoria_id', label: 'Categoría', isSearch: true },
    { key: 'unidad_id', label: 'Unidad', isSearch: true },
    { key: 'acciones', label: 'Acciones', isSearch: false },
];

interface ItemValidationErrors{
    nameError: string;
    descripcionError?: string;
    categoria_idError?: string;
    unidad_idError?: string;
}
