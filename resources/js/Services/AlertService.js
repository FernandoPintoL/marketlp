import Swal from 'sweetalert2';
class AlertService{
    success_text = "Exitoso";
    error_text = "Error";
    warning_text = "Advertencia";
    info_text = "Información";
    success(message){
        return Swal.fire({
            icon: 'success',
            title: this.success_text,
            text: message
        });
    }
    error(message){
        return Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: this.error_text,
            text: message
        });
    }
    warning(message){
        return Swal.fire({
            position: 'top-end',
            icon: 'warning',
            title: this.warning_text,
            text: message
        });
    }
    info(message){
        return Swal.fire({
            icon: 'info',
            title: this.info_text,
            text: message
        });
    }
    confirm(message) {
        return Swal.fire({
            title: '¿Estás seguro de realizar esta operacion?',
            text: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Sí, estoy seguro!',
        });
    }
}
export default new AlertService();
