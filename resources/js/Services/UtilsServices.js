import moment from "moment";
class UtilsServices{

    fecha(date){
        return moment(date).format('YYYY-MM-DD HH:MM a')
    }
}
export default new UtilsServices();
