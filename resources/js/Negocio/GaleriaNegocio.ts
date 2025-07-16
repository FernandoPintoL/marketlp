import { BaseNegocio } from '@/Negocio/BaseNegocio';
import { GaleriaItem, GaleriaItemData } from '@/Data/GaleriaItem';
import { ItemNegocio } from '@/Negocio/ItemNegocio';

export class GaleriaItemNegocio extends BaseNegocio<GaleriaItem>{
    public model: string = 'galeriaitem';
    protected dataService: GaleriaItemData;
    public negocioItem: ItemNegocio;

    constructor() {
        super();
        this.dataService = new GaleriaItemData();
        this.negocioItem = new ItemNegocio();
    }

    protected validar(galeriaItem: GaleriaItem) {
        if (!galeriaItem.item_id) {
            throw new Error('El ID del item es requerido');
        }
        if (!galeriaItem.photo_path) {
            throw new Error('La imagen es requerida');
        }
        // ... otras validaciones
    }

    private prepararGaleriaItemParaCrear(galeriaItem: GaleriaItem) {
        // Lógica de negocio para preparar el galería item
        return {
            ...galeriaItem,
            created_at: new Date()
        };
    }

    private prepararGaleriaItemParaActualizar(galeriaItem: GaleriaItem) {
        // Lógica de negocio para preparar el galería item
        return {
            ...galeriaItem,
            updated_at: new Date()
        };
    }
}
