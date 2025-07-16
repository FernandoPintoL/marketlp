import { Menu, MenuData } from '@/Data/Menu';
import { BaseNegocio } from '@/Negocio/BaseNegocio';

export class MenuNegocio extends BaseNegocio<Menu>{
    public model: string = 'api.menu';
    protected dataService: MenuData;
    constructor() {
        super();
        this.dataService = new MenuData();
    }
    protected validar(menu: Menu) {
        if (!menu.title) {
            throw new Error('El nombre es requerido');
        }
        if (!menu.href) {
            throw new Error('La URL es requerida');
        }
        // ... otras validaciones
    }
    protected prepararMenuParaCrear(menu: Menu) {
        // Lógica de negocio para preparar el menú
        return {
            ...menu,
            created_at: new Date()
        };
    }
    protected prepararMenuParaActualizar(menu: Menu) {
        // Lógica de negocio para preparar el menú
        return {
            ...menu,
            updated_at: new Date()
        };
    }
}
