import { Item, ItemData } from '@/Data/Item';
import { BaseNegocio } from '@/Negocio/BaseNegocio';
import { CategoriaNegocio } from '@/Negocio/CategoriaNegocio';
import { UnidadNegocio } from '@/Negocio/UnidadNegocio';
import { CodigoItemsData } from '@/Data/CodigoItems';
import { ParamsConsulta } from '@/Data/PaginacionLaravel';
import { Unidad } from '@/Data/Unidad';
import { Categoria } from '@/Data/Categoria';

export class ItemNegocio extends BaseNegocio<Item>{
    public model: string = 'item';
    protected dataService: ItemData;
    public codigoItemData: CodigoItemsData;
    public precioItemData: ItemData;
    public categoriaNegocio : CategoriaNegocio;
    public unidadNegocio: UnidadNegocio;
    constructor() {
        super();
        this.dataService = new ItemData();
        this.codigoItemData = new CodigoItemsData();
        this.precioItemData = new ItemData();
        this.categoriaNegocio = new CategoriaNegocio();
        this.unidadNegocio = new UnidadNegocio();
    }
    public async cargarUnidades(): Promise<Unidad[]>{
        try {
            const params : ParamsConsulta = {
                query: ""
            };
            const response = await this.unidadNegocio.consultar(params);
            console.log(response);
            return response.data as Unidad[];
        } catch (error) {
            if (error instanceof Error) {
                throw new Error(`Error al cargar unidades: ${error.message}`);
            } else {
                throw new Error('Error al cargar unidades');
            }
        }
    }
    public async cargarCategorias(): Promise<Categoria[]>{
        try {
            const params : ParamsConsulta = {
                query: ""
            };
            const response = await this.categoriaNegocio.consultar(params);
            return response.data as Categoria[];
        } catch (error) {
            if (error instanceof Error) {
                throw new Error(`Error al cargar categorías: ${error.message}`);
            } else {
                throw new Error('Error al cargar categorías');
            }
        }
    }
    protected validar(item: Item) {
        if (!item.name) {
            throw new Error('El nombre es requerido');
        }
        if (!item.descripcion) {
            throw new Error('La descripción es requerida');
        }
        // ... otras validaciones
    }
    private prepararItemParaCrear(item: Item) {
        // Lógica de negocio para preparar el item
        return {
            ...item,
            created_at: new Date()
        };
    }
    private prepararItemParaActualizar(item: Item) {
        // Lógica de negocio para preparar el item
        return {
            ...item,
            updated_at: new Date()
        };
    }
    public validateField(field: string, value: string | number | Event): { value: any; error: string } {
        switch (field) {
            case 'cod_barra':
                return this.validateCodBarra(value as Event);
            case 'name':
                return this.validateName(value as Event);
            case 'descripcion':
                return this.validateDescripcion(value as Event);
            case 'categoria_id':
                return this.validateCategoria(value as string | number);
            case 'unidad_id':
                return this.validateUnidad(value);
            default:
                return { value: null, error: 'Campo no reconocido' };
        }
    }

    private validateCodBarra(e: Event): { value: string; error: string } {
        const target = e.target as HTMLInputElement;
        if (target.value.length === 0) {
            return { value: '', error: '' };
        }
        return { value: target.value, error: '' };
    }

    private validateName(e: Event): { value: string; error: string } {
        const target = e.target as HTMLInputElement;
        if (target.value.length === 0) {
            return { value: '', error: 'El nombre es requerido.' };
        }
        if (target.value.length < 2) {
            return { value: '', error: 'El nombre debe tener al menos 2 caracteres.' };
        }
        return { value: target.value, error: '' };
    }

    private validateDescripcion(e: Event): { value: string; error: string } {
        const target = e.target as HTMLTextAreaElement;
        if (target.value.length === 0) {
            return { value: '', error: '' };
        }
        return { value: target.value, error: '' };
    }

    private validateCategoria(value: string | number): { value: string | number; error: string } {
        if (!value || value.toString().length === 0) {
            return { value: '', error: 'La categoría es requerida.' };
        }
        return { value, error: '' };
    }

    private validateUnidad(e: Event | string | number): { value: string | number; error: string } {
        let value: string | number;

        if (typeof e === 'object' && e !== null && 'target' in e) {
            const target = e.target as HTMLSelectElement;
            value = target.value;
        } else {
            value = e as string | number;
        }

        if (!value || value.toString().length === 0) {
            return { value: '', error: 'La unidad es requerida.' };
        }
        return { value, error: '' };
    }

}
