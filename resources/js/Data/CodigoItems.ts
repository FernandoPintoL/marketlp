import { BaseData } from '@/Data/BaseData';
import { TipoCodigo } from '@/Data/TipoCodigos';
export interface CodigoItems {
    id?: number;
    item_id: number;
    tipo_codigo_id: number;
    codigo: string;
    created_at?: string;
    updated_at?: string;
    tipo_codigo?: TipoCodigo;
}
export class CodigoItemsData extends BaseData<CodigoItems> {
    protected path_api_url: string = 'api.codigoitems';
}
export function getDefaultAttributes() {
    return {
        id: true,
        item_id: true,
        tipo_codigo_id: true,
        codigo: true,
        created_at: false,
        updated_at: false,
    } as Record<string, boolean>;
}
export const selectedAttributes = getDefaultAttributes();
export const attributesHead = [
    { key: 'id', label: 'ID', isSearch: true },
    { key: 'item_id', label: 'Item', isSearch: true },
    { key: 'tipo_codigo_id', label: 'Tipo Código', isSearch: true },
    { key: 'codigo', label: 'Código', isSearch: true },
    { key: 'acciones', label: 'Acciones', isSearch: false },
];
