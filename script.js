var app = new Vue({
            el: "#app",
            data:{
                nuevoUsuario:false,
                editarUsuario:false,
                eliminarUsuario:false,
                paisajes:[],
                elegido:{},
                url:null,
                eurl:null
            },
            mounted: function(){
                this.mostrarPaisajes()
            },
            methods:{
                mostrarPaisajes:function(){
                    axios.get("http://localhost:81/phpvue/api.php?accion=mostrar")
                        .then(response=>app.paisajes = response.data.paisajes)
                },
                verImagen:function() {
                    var _this = this
                    _this.file = _this.$refs.foto.files[0];
                    _this.url = URL.createObjectURL(_this.file);
                },
                everImagen:function() {
                    var _this = this
                    _this.file = _this.$refs.efoto.files[0];
                    _this.url = URL.createObjectURL(_this.file);
                },
                insertarPaisajes:function() {
                    let formdata = new FormData();
                    formdata.append('nombre',document.getElementById('nombre').value);
                    formdata.append('descripcion',document.getElementById('descripcion').value);
                    formdata.append('foto',document.getElementById('foto').value);
                    axios.post("http://localhost:81/phpvue/api.php?accion=insertar",formdata)
                        .then(
                            response=>{
                            app.mensaje = response.data.mensaje
                            app.mostrarPaisajes()
                        })
                },
                editarPaisajes:function() {
                    let formdata = new FormData();
                    formdata.append('eid',document.getElementById('eid').value);
                    formdata.append('enombre',document.getElementById('enombre').value);
                    formdata.append('edescripcion',document.getElementById('edescripcion').value);
                    formdata.append('efoto',document.getElementById('efoto').files[0]);
                    axios.post("http://localhost:81/phpvue/api.php?accion=editar",formdata)
                        .then(
                            response=>{
                            app.mensaje = response.data.mensaje
                            app.mostrarPaisajes()
                        })
                },
                eliminarPaisajes:function() {
                    let formdata = new FormData();
                    formdata.append('did',document.getElementById('did').value);
                    axios.post("http://localhost:81/phpvue/api.php?accion=eliminar",formdata)
                        .then(
                            response=>{
                            app.mensaje = response.data.mensaje
                            app.mostrarPaisajes()
                        })
                },
                elegirUsuario(paisaje){
                    app.elegido=paisaje
                }
            }
        });