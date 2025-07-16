import axios from "axios";
import {route} from "ziggy-js";
class UnidadService{
    path_url = 'api.unidad'; // Ruta API
    async index(){
        return await axios.get('/api/'+this.path_url);
    }
    async query(consulta, is_query_table, page, perPage, attributes, dateStart, dateEnd){
        const url = route(this.path_url+'.query', {
            is_query_table: is_query_table,
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
export default new UnidadService();
