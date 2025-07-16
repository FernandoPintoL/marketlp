import { BaseNegocio } from '@/Negocio/BaseNegocio';
import { Unidad, UnidadData } from '@/Data/Unidad';

export class UnidadNegocio extends BaseNegocio<Unidad>{
    public model: string = 'unidad';
    protected dataService: UnidadData;

    constructor() {
        super();
        this.dataService = new UnidadData();
    }

    protected validar(unidad: Unidad) {
        if (!unidad.sigla) {
            throw new Error('El nombre es requerido');
        }
        if (!unidad.detalle) {
            throw new Error('La descripción es requerida');
        }
        // ... otras validaciones
    }

    private prepararUnidadParaCrear(unidad: Unidad) {
        // Lógica de negocio para preparar la unidad
        return {
            ...unidad,
            created_at: new Date()
        };
    }

    private prepararUnidadParaActualizar(unidad: Unidad) {
        // Lógica de negocio para preparar la unidad
        return {
            ...unidad,
            updated_at: new Date()
        };
    }
}
