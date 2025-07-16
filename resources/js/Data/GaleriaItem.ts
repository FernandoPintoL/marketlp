import { BaseData } from '@/Data/BaseData';
export interface GaleriaItem {
    id: number;
    item_id: number;
    photo_path: string;
    created_at: string;
    updated_at: string;
}
export class GaleriaItemData extends BaseData<GaleriaItem>{
    protected path_api_url: string = 'api.galeriaitem';
}
export function getDefaultAttributes() {
    return {
        id: true,
        item_id: true,
        photo_path: false,
        created_at: false,
        updated_at: false,
    } as Record<string, boolean>;
}
export const selectedAttributes = getDefaultAttributes();
export const attributesHead = [
    { key: 'id', label: 'ID', isSearch: true },
    { key: 'item_id', label: 'Item ID', isSearch: true },
    { key: 'photo_path', label: 'Photo Path', isSearch: true },
    { key: 'acciones', label: 'Acciones', isSearch: false },
];
