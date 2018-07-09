class Persona {

    constructor () {

        this.attributes = {
            id:'',
            dni:'',
            nombre:'',
            apellidos:'',
            sexo:'',
            edoCivil:'',
            telefono:'',
            idPais:'',
            provincia:'',
            ciudad:'',
            calle:'',
        };
        this.containers = {

        };
        this.listeners = {
            keyup_pais:'.listener_pais'
        };
        this.routes = {
            create:'/create',
            update:'/update/'+this.attributes.id,
            delete:'/delete/'+this.attributes.id,
        };
        this.activateListener();
    };

    /**
     * Crear una nueva persona
     */
    create(){}

    /**
     * Actualizar una persona
     */
    update(){}

    /**
     * borrar una persona
     */
    delete(){}

    show(){
        console.log(this.attributes)
    }

    /**
     * Servira para setear todos los datos de atributos cuando la data viene de un request
     * @param data
     */
    fillPersona(data){

    };

    /**
     * Activa los listeners que escucharan todos los eventos del formulario
     */
    activateListener(){
        var self = this;
        $(self.listeners.keyup_pais).on('keypress',function () {

            if ($(self.listeners.keyup_pais).val().length >= 2){
                console.log('envio request de pais');

            }

        });

        /**
         * Se esta encargando de ir llenando los atributos de la clase
         */
        $(document).find('input').on('change',function () {

            self.attributes[$(this).attr('name')] = $(this).val();

            self.show();
        });

    };

}