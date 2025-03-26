class ValidacionService{
    validarCampoVacio(campo) {
        return campo.trim() === '';
    }

    validarEmail(email) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }

    validarTelefono(telefono) {
        const regex = /^\d{10}$/;
        return regex.test(telefono);
    }

    validarFecha(fecha) {
        const regex = /^\d{4}-\d{2}-\d{2}$/;
        return regex.test(fecha);
    }

    validarDetalle(detalle) {
        const regex = /^[a-zA-Z0-9\s.,;:!?]{3,}$/;
        return detalle === '' || regex.test(detalle);
    }

    validarSigla(sigla) {
        const regex = /^[a-zA-Z0-9]{2,}$/;
        return regex.test(sigla);
    }
    validarNombre(nombre) {
        const regex = /^[a-zA-Z\s]{3,}$/;
        return regex.test(nombre);
    }
    validarDireccion(direccion) {
        const regex = /^[a-zA-Z0-9\s.,-]{3,}$/;
        return regex.test(direccion);
    }
    validarNumero(numero) {
        const regex = /^\d+$/;
        return regex.test(numero);
    }
}
export default new ValidacionService;
