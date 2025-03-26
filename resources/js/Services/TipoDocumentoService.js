import axios from "axios";
import {route} from "ziggy-js";
class TipoDocumentoService{
    path_url = 'tipo-documento'; // Ruta API
    async index(){
        return await axios.get('/api/'+this.path_url);
    }
    async query(consulta){
        const url = route(this.path_url+'.query', {query: consulta.toUpperCase()});
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
export default new TipoDocumentoService();
