import { BaseData } from '@/Data/BaseData';
export interface Empresa {
    id?: number;
    name: string;
    num_id: number;
    telefono: string;
    email: string;
    direccion: string;
    tipo_empresa: string;
    tipo_documento: string;
    photo_path: string;
    user_id: number;
    created_at?: string;
    updated_at?: string;
}
export class EmpresaData extends BaseData<Empresa> {
    protected path_api_url: string = 'api.empresa';
}
export function getDefaultAttributes() {
    return {
        id: true,
        name: true,
        num_id: true,
        telefono: true,
        email: true,
        direccion: true,
        tipo_empresa: true,
        tipo_documento: true,
        photo_path: false,
        user_id: false,
        created_at: false,
        updated_at: false,
    } as Record<string, boolean>;
}
export const selectedAttributes = getDefaultAttributes();
export const attributesHead = [
    { key: 'id', label: 'ID', isSearch: true },
    { key: 'name', label: 'Nombre', isSearch: true },
    { key: 'num_id', label: 'Número ID', isSearch: true },
    { key: 'telefono', label: 'Teléfono', isSearch: true },
    { key: 'email', label: 'Email', isSearch: true },
    { key: 'direccion', label: 'Dirección', isSearch: true },
    { key: 'tipo_empresa', label: 'Tipo Empresa', isSearch: true },
    { key: 'tipo_documento', label: 'Tipo Documento', isSearch: true },
    { key: 'acciones', label: 'Acciones', isSearch: false },
];
