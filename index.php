<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.21/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.24.0/axios.min.js"></script>
</head>
<body>
    <div id="app">
        <button @click="nuevoUsuario=true">nuevo</button>

        <!--  -->

        <table>
            <thead>
                <th>ID</th><th>NOMBRE</th><th>foto</th><th>ACCION</th>
            </thead>
            <tbody>
                <tr v-for="paisaje in paisajes">
                    <td>{{paisaje.id}}</td>
                    <td>{{paisaje.nombre}}</td>
                    <td><img width="100" :src="'img/'+paisaje.foto"></td>
                    <td>
                        <button @click="editarUsuario=true;elegirUsuario(paisaje)">EDITAR</button>
                        <button @click="eliminarUsuario=true">ELIMINAR</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- nuevo -->

        <div class="contenedor" v-if="nuevoUsuario">
            <div class="modal">
                <div class="header">
                    <button class="close" @click="nuevoUsuario=false">x</button>
                    <h1>nuevo</h1>
                </div>
                <div class="contenido">
                    <input type="text" name="nombre" id="nombre">
                    <input type="text" name="descripcion" id="descripcion">
                    <img v-if="url" :src="url" width="100">
                    <input type="file" name="foto" ref="foto" id="foto" v-on:change="verImagen()">
                    <button @click="insertarUsuario=false;insertarPaisajes()">CREAR</button>
                </div>
            </div>
        </div>

        <!-- EDICION -->

        <div class="contenedor" v-if="editarUsuario">
            <div class="modal">
                <div class="header">
                    <button class="close" @click="editarUsuario=false">x</button>
                    <h1>EDITAR</h1>
                </div>
                <div class="contenido">
                    <input type="text" name="enombre" id="enombre">
                    <input type="text" name="edescripcion" id="edescripcion">
                    <div v-if="eurl">
                        <img :src="eurl" width="100">
                    </div>
                    <div v-else="eurl">
                        <img :src="'img/'+elegido.foto" width="100">
                    </div>
                    <input type="file" name="efoto" ref="efoto" id="efoto" v-on:change="everImagen()">
                    <button @click="editarUsuario=false;editarPaisajes()">Editar</button>
                </div>
            </div>
        </div>

        <!-- eliminar -->

        <div class="contenedor" v-if="eliminarUsuario">
            <div class="modal">
                <div class="header">
                    <button class="close" @click="eliminarUsuario=false">x</button>
                    <h1>ELIMINAR</h1>
                </div>
                <div class="contenido">
                    contenidos
                </div>
            </div>
        </div>

    </div>
    <script>
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
                    formdata('nombre',getElementById('nombre').value);
                    formdata('descripcion',getElementById('descripcion').value);
                    formdata('foto',getElementById('foto').value);
                    axios.post("http://localhost:81/phpvue/api.php?accion=insertar",formdata)
                        .then(response=>console.log(response))
                },
                editarPaisajes:function() {
                    let formdata = new FormData();
                    formdata('eid',getElementById('eid').value);
                    formdata('enombre',getElementById('enombre').value);
                    formdata('edescripcion',getElementById('edescripcion').value);
                    formdata('efoto',getElementById('efoto').value);
                    axios.post("http://localhost:81/phpvue/api.php?accion=editar",formdata)
                        .then(response=>console.log(response))
                },
                elegirUsuario(paisaje){
                    app.elegido=paisaje
                }
            }
        });
    </script>
<style type="text/css">

body{
    background: url(img/bg.jpg);
    background-size: cover;
}
#app{
    background: white;
    color: black;
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px black;
}
.contenedor{
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(0, 0, 0, 0.5);
}
.modal{
    background: white;
    border-radius: 10px;
    padding: 5px;
    width: 600px;
    margin: 50px auto;
}
.close{
    float: right;
}
h1{
    background: blue;
    color: white;
    text-align: center;
    margin: 0;
}

</style>
</body>
</html>