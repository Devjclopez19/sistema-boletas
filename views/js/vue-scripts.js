/*Pagina de Login */
const lv = new Vue({
    el: '#login',
    data: {
        formType: true,
        message: {
            username: '',
            password: '',                    
        },
        passwordFieldType: 'password'
    },
    methods: {
        validateData(e) {
            let input = e.target

            if(input.value.trim() == '') {
                this.message[input.name] = `Campo Obligatorio, ${input.title}`;      input.classList.add('u-error')
            } else {
                this.message[input.name] = ''
                input.classList.remove('u-error')
            }
        },
        showPassword(e) {
            this.passwordFieldType = this.passwordFieldType === 'password' ? 'text' : 'password'
        },
        validarDatos(e){
            if(this.message['username'] != '' || this.message['password'] != ''){
                e.preventDefault();
            }
        }
    }
});
/* Pagina de Registro*/
const pr = new Vue({
    el: '#registro',
    data: {
        formType: true,
        message: {
            full_name: '',
            dni: '',
            email: '',
            celular: '',
            username: '',
            password: '',                    
            password2: '',                    
        },
        passwordFieldType: 'password',
        serverResponse: false,
        passValue: '',
        repassValue: '',
        enviando:false
    },
    methods: {
        validateData(e) {
            let input = e.target,
            expresion
            if(input.pattern) {
                let regex = new RegExp(input.pattern)
                expresion = !regex.exec(input.value)
            } else {
                expresion = !input.value
            }

            if(expresion || input.value.trim() == '') {
                this.message[input.name] = `Datos Incorrectos, ${input.title}`;         
                input.classList.add('u-error')
            } else {
                this.message[input.name] = ''
                
                if(input.name == 'password') {
                    this.passValue = input.value;
                    if(this.passValue != this.repassValue){
                        this.message['password2'] = 'Las constraseñas no coinciden';
                    }else {
                        this.message['password2'] = ''
                    }
                }
                if(input.name == 'password2') {
                    this.repassValue = input.value;
                    if(this.passValue != this.repassValue){
                        this.message['password2'] = 'Las constraseñas no coinciden';
                    }else {
                        this.message['password2'] = ''
                    }
                }
                input.classList.remove('u-error')
            }
        },
        verificarUsuario(e) {
            let input = e.target,
                formData = new FormData()
            if(input.value.trim() != '' || input.value != ''){
                formData.append("nombreUsuario",input.value)
                axios.post('../../controllers/usuariosController.php',formData)
                    .then(response => {
                        if(response.data == 'existe') {
                            this.message[input.name] = 'El usuario ya existe, ingrese otro usuario';
                        }else {
                            this.message[input.name] = ''
                        }
                    })
                    .catch(error => {
                        console.log(error)
                    }) 
            }
        },
        showPassword(e) {
            this.passwordFieldType = this.passwordFieldType === 'password' ? 'text' : 'password'
        },
        sendForm(e){
            if(this.message['full_name'] == '' && this.message['dni'] == '' && this.message['email'] == '' && this.message['celular'] == '' && this.message['username'] == '' && this.message['password'] == '' && this.message['password2'] == '') {
                //console.log('enviando')
                this.enviando = true
                let formRegistro = document.getElementById('formRegistro');              
                let formData = new FormData(formRegistro)
                axios.post('../../controllers/registroController.php',formData)
                    .then(response => {
                        //console.log(response.data)
                        this.enviando = false
                        if(response.data == 'enviado'){
                            Swal.fire(
                                'Correcto',
                                'Usuario Registrado, validaremos sus datos y procederemos con la activación de su cuenta, se le enviará un correo de confirmación al email proporcionado.',
                                'success'
                            ).then(function(){
                                formRegistro.reset();
                                window.location = "login"
                            })
                            
                        }else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'No se logró el registro, revise su información y vuelva a intentarlo',
                                type: 'error'
                            })
                        }
                    })
                    .catch(error => {
                        this.enviando = false
                        Swal.fire({
                            title: 'Error!',
                            text: 'No se pudo enviar el formulario',
                            type: 'error'
                        })
                    }) 

            }else {
                e.preventDefault();
            }
        }
    }
});
/* Pagina de reestablecer password */
const rc = new Vue({
    el: '#recuperar',
    data: {
        formType: true,
        message: {
            email: '',
            dni: '',                    
        },
        enviando: false,

    },
    methods: {
        validateData(e) {
            let input = e.target,
            expresion
            if(input.pattern) {
                let regex = new RegExp(input.pattern)
                expresion = !regex.exec(input.value)
            } else {
                expresion = !input.value
            }

            if(expresion || input.value.trim() == '') {
                this.message[input.name] = `Datos Incorrectos, ${input.title}`;
                input.classList.add('u-error')
            } else {
                if(input.name == 'dni'){
                    if(input.value.length < 8) {
                        this.message[input.name] = `Datos Incorrectos, ${input.title}`; 
                    }else {
                        this.message[input.name] = ''; 
                    }                        
                }else {
                    this.message[input.name] = ''; 
                }
                input.classList.remove('u-error')
            }
        },
        recuperar(e){
            if(this.message['dni'] == '' && this.message['email'] == '') {
                //console.log('enviando')
                this.enviando = true
                let nuevoPass = this.generarPass()
                let formRec = document.getElementById('formRecuperar');              
                let formData = new FormData(formRec)
                formData.append('nuevoPass',nuevoPass)
                axios.post('../../controllers/registroController.php',formData)
                    .then(response => {
                        this.enviando = false
                        if(response.data == 'enviado'){
                            Swal.fire(
                                'Correcto',
                                'Contraseña reestablecida, revise su correo para iniciar sesion.',
                                'success'
                            ).then(function(){
                                formRec.reset()
                                window.location = "login"
                            })
                            
                        }else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'No se logró reestablecer la contraseña, revise su información y vuelva a intentarlo',
                                type: 'error'
                            })
                        }
                    })
                    .catch(error => {
                        this.enviando = false
                        Swal.fire({
                            title: 'Error!',
                            text: 'No se pudo enviar el formulario',
                            type: 'error'
                        })
                    }) 

            }else {
                e.preventDefault();
            }
        },
        generarPass(){
            let CharacterSet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            let passGen = ''
            for(let i=0; i < 10; i++) {
                passGen += CharacterSet.charAt(Math.floor(Math.random() * CharacterSet.length));
            }
            return passGen;
        }
    }
});
/* Pagina cuenta*/
const cuenta = new Vue({
    el: '#cuenta',
    data: {
        formType: true,
        message: {
            full_name: '',
            dni: '', 
            password:'',
            newP:'',
            rnewP:''
        },
        beforeData: {

        },
        editar: false,
        cambiarP: false,
        passValue:'',
        repassValue:'',
        serverResponse: false
    },
    computed: {
        formTitle() {
            return (this.editar) ? 'Editando Información' : 'Información de la cuenta'
        },
        passTitle(){
            return (this.editar) ? 'Ingrese su contraseña' : 'Contraseña'
        }
    },
    methods: {
        habilitarForm(){
            this.editar = !this.editar
            let form = document.getElementById('editarCuenta')
            this.beforeData['full_name'] = form.full_name.value
            this.beforeData['dni'] = form.dni.value
            form.password.value = ''
            
        },
        cancelar() {
            this.editar = !this.editar
            this.cambiarP = false
            let form = document.getElementById('editarCuenta')
            form.full_name.value = this.beforeData['full_name']
            form.dni.value = this.beforeData['dni']
            form.password.value = '******'
            this.message['dni'] = ''
            this.message['full_name'] = ''
            form.full_name.classList.remove('u-error')
            form.dni.classList.remove('u-error')
        },
        validateData(e) {
            let input = e.target,
            expresion
            if(input.pattern) {
                let regex = new RegExp(input.pattern)
                expresion = !regex.exec(input.value)
            } else {
                expresion = !input.value
            }

            if(expresion || input.value.trim() == '') {
                this.message[input.name] = `Datos Incorrectos, ${input.title}`;
                input.classList.add('u-error')
            } else {
                if(input.name == 'dni'){
                    if(input.value.length < 8) {
                        this.message[input.name] = `Datos Incorrectos, ${input.title}`; 
                        input.classList.add('u-error')
                    }else {
                        this.message[input.name] = ''; 
                    }                        
                }else {
                    this.message[input.name] = ''; 
                    input.classList.remove('u-error')
                }
                if(input.name == 'newP') {
                    this.passValue = input.value;
                    if(this.passValue != this.repassValue){
                        this.message['rnewP'] = 'Las constraseñas no coinciden';
                    }else {
                        this.message['rnewP'] = ''
                    }
                }
                if(input.name == 'rnewP') {
                    this.repassValue = input.value;
                    if(this.passValue != this.repassValue){
                        this.message['rnewP'] = 'Las constraseñas no coinciden';
                    }else {
                        this.message['rnewP'] = ''
                    }
                }
                input.classList.remove('u-error')
            }
        },
        sendForm(e) {
            if(this.message['full_name'] == '' && this.message['dni'] == '' && this.message['password'] == '' && this.message['newP'] == '' && this.message['rnewP'] == '') {

            let form = document.getElementById('editarCuenta'),
                formData = new FormData(form)
            axios.post('../../controllers/cuentaController.php',formData)
                .then(response => {
                    //console.log(response.data)
                    if(response.data == 'ok'){
                        Swal.fire(
                            'Correcto',
                            'Datos actualizados!',
                            'success'
                        )
                        .then(function(){
                            window.location = "cuenta"
                        })
                    }else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'No se actualizaron los datos',
                            type: 'error',
                            confirmButtonText: 'Cool'
                        })
                    }
                })
                .catch(error => {
                    console.log(error)
                    Swal.fire({
                        title: 'Error!',
                        text: 'No se enviaron los datos',
                        type: 'error',
                        confirmButtonText: 'Cool'
                    })
                })    
            }else {
                e.preventDefault();
            }
        }
    }
});
/* Pagina ugel*/
const ugel = new Vue({
    el: '#ugel',
    data: {
        formType: true,
        message: {
            razon_social: '',
            ruc: '', 
            director:'',
            email:'',
            telefono:'',
            direccion:''
        },
        beforeData: {

        },
        editar: false
    },
    computed: {
        formTitle() {
            return (this.editar) ? 'Editando Información' : 'Información de la Ugel'
        }
    },
    methods: {
        habilitarForm(e){
            e.preventDefault();
            this.editar = !this.editar
            let form = document.getElementById('editarUgel')
            this.beforeData['ruc'] = form.ruc.value
            this.beforeData['director'] = form.director.value
            this.beforeData['email'] = form.email.value
            this.beforeData['telefono'] = form.telefono.value
            this.beforeData['direccion'] = form.direccion.value
            
        },
        cancelar() {
            this.editar = !this.editar
            let form = document.getElementById('editarUgel')
            form.ruc.value = this.beforeData['ruc']
            form.director.value = this.beforeData['director']
            form.email.value = this.beforeData['email']
            form.telefono.value = this.beforeData['telefono']
            form.direccion.value = this.beforeData['direccion']
            this.message['ruc'] = ''
            this.message['director'] = ''
            this.message['email'] = ''
            this.message['telefono'] = ''
            this.message['direccion'] = ''
            form.ruc.classList.remove('u-error')
            form.director.classList.remove('u-error')
            form.email.classList.remove('u-error')
            form.telefono.classList.remove('u-error')
            form.direccion.classList.remove('u-error')
        },
        validateData(e) {
            let input = e.target,
            expresion
            if(input.pattern) {
                let regex = new RegExp(input.pattern)
                expresion = !regex.exec(input.value)
            } else {
                expresion = !input.value
            }

            if(expresion || input.value.trim() == '') {
                this.message[input.name] = `Datos Incorrectos, ${input.title}`;
                input.classList.add('u-error')
            } else {
                if(input.name == 'ruc'){
                    if(input.value.length < 11) {
                        this.message[input.name] = `Datos Incorrectos, ${input.title}`; 
                        input.classList.add('u-error')
                    }else {
                        this.message[input.name] = ''; 
                    }                        
                }else {
                    this.message[input.name] = ''; 
                    input.classList.remove('u-error')
                }
                input.classList.remove('u-error')
            }
        },
        sendForm(e) {
            
            if(this.message['ruc'] != '' || this.message['director'] != '' || this.message['email'] != '' || this.message['telefono'] != '' || this.message['direccion'] != '') {
                console.log('no enviado')
                e.preventDefault();   
            }

        }
    }
});
/* Modal registrar usuario*/
const mru = new Vue({
    el: '#usuarios',
    data: {
        message: {
            full_name: '',
            dni: '',
            email: '',
            celular: '',
            username: '',
            password: ''                   
        },
        serverResponse: false,
        passValue: '',
        estado: false,
        editar:false,
        editarPass:false,
        tipo_boleta:'',
        idEliminar: '',
        enviando:false

    },
    computed:{
        formTitle() {
            return (this.editar) ? 'Editar Usuario' : 'Agregar Usuario al Sistema'
        },
        btnTitle() {
            return (this.editar) ? 'Guardar' : 'Agregar'
        }
    },
    methods: {
        validateData(e) {
            let input = e.target,
            expresion
            if(input.pattern) {
                let regex = new RegExp(input.pattern)
                expresion = !regex.exec(input.value)
            } else {
                expresion = !input.value
            }

            if(expresion || input.value.trim() == '') {
                this.message[input.name] = `Datos Incorrectos, ${input.title}`;         
                input.classList.add('u-error')
            } else {
                if(input.name == 'dni'){
                    if(input.value.length < 8) {
                        this.message[input.name] = `Datos Incorrectos, ${input.title}`; 
                    }else {
                        this.message[input.name] = ''; 
                    }                        
                }else {
                    this.message[input.name] = ''; 
                }
                input.classList.remove('u-error')
            }
        },
        verificarUsuario(e) {
            let input = e.target,
                formData = new FormData()
            if(input.value.trim() != '' || input.value != ''){
                formData.append("nombreUsuario",input.value)
                axios.post('../../controllers/usuariosController.php',formData)
                    .then(response => {
                        if(response.data == 'existe') {
                            this.message[input.name] = 'El usuario ya existe, ingrese otro usuario';
                        }else {
                            this.message[input.name] = ''
                        }
                    })
                    .catch(error => {
                        console.log(error)
                    }) 
            }
        },
        generarPass(e){
            this.message['password']=''
            e.target.parentElement.nextElementSibling.classList.remove('u-error')
            let CharacterSet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            let passGen = ''
            for(let i=0; i < 10; i++) {
                passGen += CharacterSet.charAt(Math.floor(Math.random() * CharacterSet.length));
            }
            this.passValue = passGen
        },
        guardarUsuario(e) {
            if(this.message['full_name'] == '' && this.message['dni'] == '' && this.message['email'] == '' && this.message['celular'] == '' && this.message['username'] == '' && this.message['password'] == '') {
                //console.log('enviando')
                this.enviando = true
                let formUsuario = document.getElementById('formUsuario');              
                let formData = new FormData(formUsuario)
                axios.post('../../controllers/usuariosController.php',formData)
                    .then(response => {
                        this.enviando = false
                        console.log(response.data)
                        if(response.data == 'ok'){                            
                            if(formUsuario.agregar){
                                Swal.fire(
                                    'Correcto',
                                    'Usuario Registrado',
                                    'success'
                                ).then(function(){
                                    formUsuario.reset();
                                    $('#usuario').modal('toggle')
                                    window.location = "usuarios"
                                })
                            }else {
                                Swal.fire(
                                    'Correcto',
                                    'Usuario Actualizado',
                                    'success'
                                ).then(function(){
                                    formUsuario.reset();
                                    $('#usuario').modal('toggle')
                                    this.editar = false
                                    window.location = "usuarios"
                                })
                            }
                            
                        }else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'No se pudo guardar la información',
                                type: 'error'
                            })
                        }
                    })
                    .catch(error => {
                        this.enviando = false
                        Swal.fire({
                            title: 'Error!',
                            text: 'No se pudo enviar el formulario',
                            type: 'error'
                        })
                    }) 

            }else {
                e.preventDefault();
            }
        },
        activarUsuario(e,id){
            let formData = new FormData()
            formData.append("activarUser",id)
            axios.post('../../controllers/usuariosController.php',formData)
                    .then(response => {
                        //console.log(response.data)
                        if(response.data == 'ok'){
                            e.classList.add('d-none')
                            e.nextElementSibling.classList.remove('d-none')
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    }) 
        },
        editarUsuario(id){
            this.editar = true
            $('#usuario').modal('show')
            let form = document.getElementById('formUsuario'),
                formData = new FormData()
            formData.append('editarUsuario',id)
            axios.post('../../controllers/usuariosController.php',formData)
                .then(response => {
                    form.full_name.value = response.data.user['full_name']                 
                    form.dni.value = response.data.user['dni']                   
                    form.email.value = response.data.user['email']                   
                    form.celular.value = response.data.user['celular']                  
                    form.username.value = response.data.user['username']
                    this.tipo_boleta = response.data.user['tipo_boleta']  
                    form.id_user.value = id          
                })
                .catch(error => {
                    console.log(error);
                }) 
        },
        closeForm(){
            if(this.editar == true){
                this.editar = false
                document.getElementById('formUsuario').reset()
            }
        },
        eliminar(){
            if(this.idEliminar == ''){
                e.preventDefault();
            }
            let formData = new FormData()
            formData.append('eliminar',this.idEliminar)
            axios.post('../../controllers/usuariosController.php',formData)
            .then(response => {
                if(response.data == 'ok'){
                    Swal.fire(
                        'Correcto',
                        'Usuario Eliminado',
                        'success'
                    ).then(function(){
                        $('#modal-eliminar').modal('toggle')
                        window.location = "usuarios"
                    })
                    
                }else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'No se pudo procesar la información',
                        type: 'error'
                    })
                }
            })
            .catch(error => {
                Swal.fire({
                    title: 'Error!',
                    text: 'No se pudo enviar el formulario',
                    type: 'error'
                })
            }) 
        },
        eliminarUsuario(id){
            $('#modal-eliminar').modal('show')
            this.idEliminar = id            
        }
        
    }
});

// cargar boletas
const cb = new Vue({
    el: '#cargar-boletas',
    data: {
        message: {
            periodo:'',
            boleta:''                   
        },
        anio:'',
        mes:'',
        tipo_boleta:'',
        anios:[
            
            {id:2023,name:'2023'},
            {id:2022,name:'2022'},
            {id:2021,name:'2021'},
            {id:2020,name:'2020'},
            {id:2019,name:'2019'},
            {id:2018,name:'2018'},
            {id:2017,name:'2017'},
            {id:2016,name:'2016'},
            {id:2015,name:'2015'},
            {id:2014,name:'2014'},
            {id:2013,name:'2013'},
            {id:2012,name:'2012'},
            {id:2011,name:'2011'},
            {id:2011,name:'2011'},
            {id:2010,name:'2010'}
        ],
        meses:[
            {id:'enero',name:'enero'},
            {id:'febrero',name:'febrero'},
            {id:'marzo',name:'marzo'},
            {id:'abri',name:'abril'},
            {id:'mayo',name:'mayo'},
            {id:'junio',name:'junio'},
            {id:'julio',name:'julio'},
            {id:'agosto',name:'agosto'},
            {id:'setiembre',name:'setiembre'},
            {id:'octubre',name:'octubre'},
            {id:'noviembre',name:'noviembre'},
            {id:'diciembre',name:'diciembre'},
        ],
        tipos:[
            {id:'activo',name:'Activos'},
            {id:'nombrado',name:'Nombrados'},
            {id:'contratado',name:'Contratados'},
            {id:'judicial',name:'Judiciales'},
            {id:'cesante-tit',name:'Cesantes - Titulares'},
            {id:'cesante-sob',name:'Cesantes - Sobrevivientes'},
            {id:'cafae',name:'Cafae'},
        ],
        existe:false,
        aniob:'',
        tipob:'nombrado',
        boletas:[],
        errorBusqueda:false,
        editar:false,
        editarBol:false,
        id_boleta:'',
        idEliminar: '',
        serverResponse: false,
        enviando:false

    },
    mounted(){
        this.getYear()
        this.getBoletas(this.aniob,this.tipob)
    },
    computed:{
        formTitle() {
            return (this.editar) ? 'Editar Boleta' : 'Agregar Nueva Boleta'
        },
        btnTitle() {
            return (this.editar) ? 'Guardar' : 'Agregar'
        }
    },
    methods: {
        validateData(e) {
            let input = e.target,
            expresion
            if(input.pattern) {
                let regex = new RegExp(input.pattern)
                expresion = !regex.exec(input.value)
            } else {
                expresion = !input.value
            }

            if(expresion || input.value.trim() == '') {
                this.message[input.name] = `Datos Incorrectos, ${input.title}`;         
                input.classList.add('u-error')
            } else {
                this.message[input.name] = ''; 
                input.classList.remove('u-error')
            }
        },
        verificarArchivo(e){
            let input = e.target
            let type = input.files[0].type;
            let size = input.files[0].size;
            //console.log(size)
            if(type != 'text/plain' || size > 10000000 ){
                this.message[input.name] = 'Archivo no válido y/o tamaño máximo superado'
            }else{
                this.message[input.name] = ''
            }
        },
        guardarBoleta(e) {
            if(!this.editar){
                let formD = new FormData()
                formD.append('verificar',true)
                formD.append('aniov',this.anio)
                formD.append('mesv',this.mes)
                formD.append('tipov',this.tipo_boleta)
                axios.post('../../controllers/cboletasController.php',formD)
                    .then(response =>{
                        //console.log(response.data)
                        if(response.data == 'existe'){
                            Swal.fire({
                                title: 'Error!',
                                text: 'La boleta ya existe, verifique los datos a enviar',
                                type: 'error'
                            })
                            e.preventDefault();
                        }else{
                            if(this.message['periodo'] == '' && this.message['boleta'] == '') {
                    
                                let formBoleta = document.getElementById('formBoleta');              
                                let formData = new FormData(formBoleta)
                                this.enviando = true;
                                axios.post('../../controllers/cboletasController.php',formData)
                                    .then(response => {
                                        console.log(response.data)
                                        if(response.data == 'ok'){
                                            this.enviando = false;
                                            Swal.fire(
                                                'Correcto',
                                                'Boleta Registrada',
                                                'success'
                                            ).then(function(){
                                                formBoleta.reset();
                                                $('#c-boleta').modal('toggle')
                                                window.location = "cargar_boletas"
                                            })
                                            
                                        }else {
                                            this.enviando = false;
                                            Swal.fire({
                                                title: 'Error!',
                                                text: 'No se pudo guardar la información',
                                                type: 'error'
                                            })
                                        }
                                    })
                                    .catch(error => {
                                        this.enviando = false;
                                        Swal.fire({
                                            title: 'Error!',
                                            text: 'No se pudo enviar el formulario',
                                            type: 'error'
                                        })
                                    }) 
                
                            }else {
                                e.preventDefault();
                            }
                        }
                    })
                    .catch(error => {
                        this.enviando = false;
                    });
            }else{
                let formEditar = document.getElementById('formBoleta')
                let formDataE = new FormData(formEditar)
                formDataE.append('anio',this.anio)
                formDataE.append('mes',this.mes)
                formDataE.append('tipo_boleta',this.tipo_boleta)
                axios.post('../../controllers/cboletasController.php',formDataE)
                    .then(response => {
                        console.log(response.data)
                        if(response.data == 'ok'){
                            Swal.fire(
                                'Correcto',
                                'Boleta Actualizada',
                                'success'
                            ).then(function(){
                                formBoleta.reset();
                                $('#c.boleta').modal('toggle')
                                this.editar = false
                                window.location = "cargar_boletas"
                            })                            
                        }else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'No se pudo guardar la información',
                                type: 'error'
                            })
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            title: 'Error!',
                            text: 'No se pudo enviar el formulario',
                            type: 'error'
                        })
                    })

            }
        },
        getYear(){
            let date = new Date()
            this.aniob = date.getFullYear()
        },
        getBoletas(anio,tipo_boleta){
            let formData = new FormData()
            formData.append("aniob",anio)
            formData.append("tipob",tipo_boleta)
            axios.post('../../controllers/cboletasController.php',formData)
                    .then(response => {
                        //console.log(response.data)
                        if(response.data == 'error'){
                            this.errorBusqueda = true
                            this.boletas = []
                        }else{
                            this.boletas = response.data
                            this.errorBusqueda = false
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    }) 
        },
        filtrarBoleta(e){
            this.getBoletas(this.aniob,this.tipob)
        },
        editarBoleta(boleta){
            this.editar = true
            $('#c-boleta').modal('show')
            let form = document.getElementById('formBoleta')
            this.anio = boleta.anio
            this.mes = boleta.mes
            this.tipo_boleta = boleta.tipo_boleta
            form.periodo.value = boleta.periodo
            form.descripcion.value = boleta.descripcion
            this.id_boleta = boleta.id
        },
        closeForm(){
            if(this.editar == true){
                this.editar = false
                document.getElementById('formBoleta').reset()
            }
        },
        eliminar(){
            if(this.idEliminar == ''){
                e.preventDefault();
            }
            let formData = new FormData()
            formData.append('eliminar',this.idEliminar)
            axios.post('../../controllers/cboletasController.php',formData)
            .then(response => {
                if(response.data == 'ok'){
                    Swal.fire(
                        'Correcto',
                        'Boleta Eliminada',
                        'success'
                    ).then(function(){
                        $('#modal-eliminar').modal('toggle')
                        window.location = "cargar_boletas"
                    })
                    
                }else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'No se pudo procesar la información',
                        type: 'error'
                    })
                }
            })
            .catch(error => {
                Swal.fire({
                    title: 'Error!',
                    text: 'No se pudo enviar el formulario',
                    type: 'error'
                })
            }) 
        },
        eliminarBoleta(id){
            $('#modal-eliminar').modal('show')
            this.idEliminar = id            
        }
        
    }
});
// cargar boletas
const consulta = new Vue({
    el: '#consulta',
    data: {
        anios:[
            
            {id:2023,name:'2023'},
            {id:2022,name:'2022'},
            {id:2021,name:'2021'},
            {id:2020,name:'2020'},
            {id:2019,name:'2019'},
            {id:2018,name:'2018'},
            {id:2017,name:'2017'},
            {id:2016,name:'2016'},
            {id:2015,name:'2015'},
            {id:2014,name:'2014'},
            {id:2013,name:'2013'},
            {id:2012,name:'2012'},
            {id:2011,name:'2011'},
            {id:2011,name:'2011'},
            {id:2010,name:'2010'}
        ],
        meses:[
            {id:'enero',name:'enero'},
            {id:'febrero',name:'febrero'},
            {id:'marzo',name:'marzo'},
            {id:'abri',name:'abril'},
            {id:'mayo',name:'mayo'},
            {id:'junio',name:'junio'},
            {id:'julio',name:'julio'},
            {id:'agosto',name:'agosto'},
            {id:'setiembre',name:'setiembre'},
            {id:'octubre',name:'octubre'},
            {id:'noviembre',name:'noviembre'},
            {id:'diciembre',name:'diciembre'},
        ],
        tipos:[
            {id:'activo',name:'Activos'},
            {id:'nombrado',name:'Nombrados'},
            {id:'contratado',name:'Contratados'},
            {id:'judicial',name:'Judiciales'},
            {id:'cesante-tit',name:'Cesantes - Titulares'},
            {id:'cesante-sob',name:'Cesantes - Sobrevivientes'},
            {id:'cafae',name:'Cafae'},
        ],
        aniob:'',
        tipob:'nombrado',
        mesb:'',
        dnib:'',
        errorBusqueda:false

    },
    created(){
        this.getYear()
    },
    methods: {
        getYear(){
            let date = new Date()
            this.aniob = date.getFullYear()
            let mes = date.getMonth();
            let meses = ['enero','febrero','marzo','abril','mayo','junio','julio','agosto','setiembre','octubre','noviembre','diciembre']
            this.mesb = meses[mes]
        },
        cargarBoleta(){
            let link = "views/reportes/boleta.php?dni="+this.dnib+"&mes="+this.mesb+"&anio="+this.aniob+"&tipo_boleta="+this.tipob;
            window.open(link, "_blank"); 
        }
        
    }
});
// cargar boletas
const bol = new Vue({
    el: '#boletasU',
    data: {
        anios:[            
            {id:2020,name:'2020'},
            {id:2019,name:'2019'},
            {id:2018,name:'2018'},
            {id:2017,name:'2017'},
            {id:2016,name:'2016'},
            {id:2015,name:'2015'},
            {id:2014,name:'2014'},
            {id:2013,name:'2013'},
            {id:2012,name:'2012'},
            {id:2011,name:'2011'},
            {id:2011,name:'2011'},
            {id:2010,name:'2010'}
        ],
        aniob:'',
        tipob:'',
        boletas:[],
        dni:'',
        errorBusqueda:false

    },
    created(){
        this.getYear()
        this.getDNI()
        this.getTipoBoleta()
        this.getBoletas(this.aniob,this.tipob);
    },
    methods: {
        getYear(){
            let date = new Date()
            this.aniob = date.getFullYear()
        },
        getTipoBoleta(){
            let tipo = document.getElementById('t').innerText
            this.tipob = tipo
        },
        getDNI(){
            let dni = document.getElementById('d').innerText
            this.dni = dni
        },
        getBoletas(anio,tipo_boleta){
            let formData = new FormData()
            formData.append("aniob",anio)
            formData.append("tipob",tipo_boleta)
            axios.post('../../controllers/cboletasController.php',formData)
                    .then(response => {
                        //console.log(response.data)
                        if(response.data == 'error'){
                            this.errorBusqueda = true
                            this.boletas = []
                        }else{
                            this.boletas = response.data
                            this.errorBusqueda = false
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    }) 
        },
        filtrarBoleta(e){
            this.getBoletas(this.aniob,this.tipob)
        },
        verBoleta(mes,tipo_boleta){
            let link = "views/reportes/boleta.php?dni="+this.dni+"&mes="+mes+"&anio="+this.aniob+"&tipo_boleta="+tipo_boleta;
            window.open(link, "_blank"); 
        }
        
    }
});
/* Pagina Datos Personales*/
const datos = new Vue({
    el: '#datos',
    data: {
        formType: true,
        message: {
            full_name: '',
            dni: '', 
            password:'',
            email:'',
            celular:'',
            newP:'',
            rnewP:''
        },
        beforeData: {

        },
        editar: false,
        cambiarP: false,
        passValue:'',
        repassValue:'',
        serverResponse: false
    },
    computed: {
        formTitle() {
            return (this.editar) ? 'Editando Información' : 'Información de la Cuenta'
        },
        passTitle(){
            return (this.editar) ? 'Ingrese su contraseña' : 'Contraseña'
        }
    },
    methods: {
        habilitarForm(){
            this.editar = !this.editar
            let form = document.getElementById('editarDatos')
            this.beforeData['full_name'] = form.full_name.value
            this.beforeData['dni'] = form.dni.value
            this.beforeData['email'] = form.email.value
            this.beforeData['celular'] = form.celular.value
            form.password.value = ''
            
        },
        cancelar() {
            this.editar = !this.editar
            this.cambiarP = false
            let form = document.getElementById('editarDatos')
            form.full_name.value = this.beforeData['full_name']
            form.dni.value = this.beforeData['dni']
            form.email.value = this.beforeData['email']
            form.celular.value = this.beforeData['celular']
            form.password.value = '******'
            form.newP.value = ''
            form.rnewP.value = ''
            this.message['dni'] = ''
            this.message['full_name'] = ''
            this.message['email'] = ''
            this.message['celular'] = ''
            this.message['newP'] = ''
            this.message['rnewP'] = ''
            this.message['password'] = ''
            form.full_name.classList.remove('u-error')
            form.dni.classList.remove('u-error')
            form.password.classList.remove('u-error')
            form.email.classList.remove('u-error')
            form.celular.classList.remove('u-error')
            form.newP.classList.remove('u-error')
            form.rnewP.classList.remove('u-error')
        },
        validateData(e) {
            let input = e.target,
            expresion
            if(input.pattern) {
                let regex = new RegExp(input.pattern)
                expresion = !regex.exec(input.value)
            } else {
                expresion = !input.value
            }

            if(expresion || input.value.trim() == '') {
                this.message[input.name] = `Datos Incorrectos, ${input.title}`;
                input.classList.add('u-error')
            } else {
                if(input.name == 'dni'){
                    if(input.value.length < 8) {
                        this.message[input.name] = `Datos Incorrectos, ${input.title}`; 
                        input.classList.add('u-error')
                    }else {
                        this.message[input.name] = ''; 
                    }                        
                }else {
                    this.message[input.name] = ''; 
                    input.classList.remove('u-error')
                }
                if(input.name == 'newP') {
                    this.passValue = input.value;
                    if(this.passValue != this.repassValue){
                        this.message['rnewP'] = 'Las constraseñas no coinciden';
                    }else {
                        this.message['rnewP'] = ''
                    }
                }
                if(input.name == 'rnewP') {
                    this.repassValue = input.value;
                    if(this.passValue != this.repassValue){
                        this.message['rnewP'] = 'Las constraseñas no coinciden';
                    }else {
                        this.message['rnewP'] = ''
                    }
                }
                input.classList.remove('u-error')
            }
        },
        sendForm(e) {
            if(this.message['full_name'] == '' && this.message['dni'] == '' && this.message['password'] == '' && this.message['newP'] == '' && this.message['rnewP'] == '' && this.message['email'] == '' && this.message['celular'] == '') {

            let form = document.getElementById('editarDatos'),
                formData = new FormData(form)
            axios.post('../../controllers/cuentaController.php',formData)
                .then(response => {
                    //console.log(response.data)
                    if(response.data == 'ok'){
                        Swal.fire(
                            'Correcto',
                            'Datos actualizados!',
                            'success'
                        )
                        .then(function(){
                            window.location = "datos"
                        })
                    }else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'No se actualizaron los datos',
                            type: 'error',
                            confirmButtonText: 'Cool'
                        })
                    }
                })
                .catch(error => {
                    console.log(error)
                    Swal.fire({
                        title: 'Error!',
                        text: 'No se enviaron los datos',
                        type: 'error',
                        confirmButtonText: 'Cool'
                    })
                })    
            }else {
                e.preventDefault();
            }
        }
    }
});
/* Pagina Datos Personales*/
const contacto = new Vue({
    el: '#contacto',
    data: {
        message: {
            asunto: '',
            mensaje: '', 
        },
        enviando:false
    },
    methods: {
        validateData(e) {
            let input = e.target,
            expresion
            if(input.pattern) {
                let regex = new RegExp(input.pattern)
                expresion = !regex.exec(input.value)
            } else {
                expresion = !input.value
            }

            if(expresion || input.value.trim() == '') {
                this.message[input.name] = `Datos Incorrectos, ${input.title}`;
                input.classList.add('u-error')
            } else {
                this.message[input.name] = ''; 
                input.classList.remove('u-error')
            }
        },
        sendForm(e) {
            if(this.message['asunto'] == '' && this.message['mensaje'] == '') {
            this.enviando = true
            let form = document.getElementById('editarContacto'),
                formData = new FormData(form)
            axios.post('../../controllers/contactoController.php',formData)
                .then(response => {
                    //console.log(response.data)
                    this.enviando = false
                    if(response.data == 'enviado'){
                        Swal.fire(
                            'Correcto',
                            'Mensaje enviado!',
                            'success'
                        )
                        .then(function(){
                            form.reset()
                        })
                    }else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'No se pudo enviar el mensaje, recargue la página y  vuelva a intentarlo',
                            type: 'error',
                        })
                    }
                })
                .catch(error => {
                    //console.log(error)
                    this.enviando = false
                    Swal.fire({
                        title: 'Error!',
                        text: 'No se enviaron los datos',
                        type: 'error',
                    })
                })    
            }else {
                e.preventDefault();
            }
        }
    }
});