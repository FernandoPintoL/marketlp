import axios from "axios";
import {route} from "ziggy-js";
class CategoriaService{
    path_url = 'categoria'; // Ruta API
    async index(){
        return await axios.get('/api/'+this.path_url);
    }
    async query(consulta, page, perPage, attributes){
        console.log('Consulta: '+consulta);
        console.log(attributes);
        const url = route(this.path_url+'.query', {
            query: consulta,
            page: page,
            perPage: perPage,
            attributes: attributes
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
export default new CategoriaService();
