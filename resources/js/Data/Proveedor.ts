import { BaseData } from '@/Data/BaseData';
export interface Proveedor {
    id: number;
    name: string;
    num_id: string;
    direccion: string;
    telefono: string;
    email: string;
    contacto: string;
    tipo_documento_id: number;
    created_at: string;
    updated_at: string;
}
export class ProveedorData extends BaseData<Proveedor> {
    protected path_api_url: string = 'api.proveedor';
}
export function getDefaultAttributes() {
    return {
        id: true,
        name: true,
        num_id: true,
        direccion: true,
        telefono: true,
        email: true,
        contacto: true,
        tipo_documento_id: true,
        created_at: false,
        updated_at: false,
    } as Record<string, boolean>;
}
export const selectedAttributes = getDefaultAttributes();
export const attributesHead = [
    { key: 'id', label: 'ID', isSearch: true },
    { key: 'name', label: 'Nombre', isSearch: true },
    { key: 'num_id', label: 'Número de ID', isSearch: true },
    { key: 'direccion', label: 'Dirección', isSearch: true },
    { key: 'telefono', label: 'Teléfono', isSearch: true },
    { key: 'email', label: 'Email', isSearch: true },
    { key: 'contacto', label: 'Contacto', isSearch: true },
    { key: 'tipo_documento_id', label: 'Tipo Documento ID', isSearch: true },
    { key: 'acciones', label: 'Acciones', isSearch: false },
];
