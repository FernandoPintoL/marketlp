import moment from "moment";
class UtilsServices{

    //funcion para convertir la primer letra en mayuscula
    capitalizeFirstLetter(cadena) {
        return cadena.charAt(0).toUpperCase() + cadena.slice(1);
    }

    fecha(date){
        return moment(date).format('YYYY-MM-DD HH:MM a')
    }
}
export default new UtilsServices();
