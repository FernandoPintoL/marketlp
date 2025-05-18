import axios from "axios";
import {route} from "ziggy-js";
class EmpleadoCargoService{
    path_url = 'empleado-cargo'; // Ruta API
    async index(){
        return await axios.get('/api/'+this.path_url);
    }
    async query(consulta, page, perPage, attributes, dateStart, dateEnd){
        const url = route(this.path_url+'.query', {
            query: consulta,
            page: page,
            perPage: perPage,
            attributes: attributes,
            dateStart: dateStart,
            dateEnd: dateEnd
        });
        return await axios.post(url);
    }
    async store(model){
        const url = route(this.path_url+'.store', model);
        return await axios.post(url, model);
    }
    async update(model, id){
        const url = route(this.path_url+'.update', id);
        return await axios.put(url, model);
    }
    async destroy(id){
        const url = route(this.path_url+'.destroy', id);
        return await axios.delete(url);
    }
    async show(id){
        return await axios.get(`/api/${this.path_url}/${id}`);
    }
}
export default new EmpleadoCargoService();
