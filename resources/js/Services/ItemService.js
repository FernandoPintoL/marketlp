import axios from "axios";
import {route} from "ziggy-js";
class ItemService{
    path_url = 'item'; // Ruta API
    async index(){
        return await axios.get('/api/'+this.path_url);
    }
    async query(consulta, is_query_table, page, perPage, attributes, dateStart, dateEnd){
        console.log('ItemService.query', consulta, page, perPage, attributes, dateStart, dateEnd);
        // const url = route(this.path_url+'.query');
        // console.log('ItemService.query url', url);
        const url = route('api.'+this.path_url+'.query', {
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
        const url = route(this.path_url+'.store');

        // Use FormData to handle file uploads
        const formData = new FormData();
        for (const key in model) {
            if (model[key] !== null && model[key] !== undefined) {
                formData.append(key, model[key]);
            }
        }

        return await axios.post(url, formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });
    }
    async update(model, id){
        const url = route(this.path_url+'.update', id);

        // Use FormData to handle file uploads
        const formData = new FormData();
        for (const key in model) {
            if (model[key] !== null && model[key] !== undefined) {
                formData.append(key, model[key]);
            }
        }

        // For Laravel PUT requests with FormData, we need to append _method
        formData.append('_method', 'PUT');

        return await axios.post(url, formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });
    }
    async destroy(id){
        const url = route(this.path_url+'.destroy', id);
        return await axios.delete(url);
    }
    async show(id){
        return await axios.get(`/api/${this.path_url}/${id}`);
    }
}
export default new ItemService();
