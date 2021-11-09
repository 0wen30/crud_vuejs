<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.21/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.24.0/axios.min.js"></script>
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
    <div id="app">
        <button @click="nuevoUsuario=true">nuevo</button>

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
                        <button @click="eliminarUsuario=true;elegirUsuario(paisaje)">ELIMINAR</button>
                    </td>
                </tr>
            </tbody>
        </table>

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
                    <button @click="editarUsuario=false;insertarPaisajes()">CREAR</button>
                </div>
            </div>
        </div>

        <div class="contenedor" v-if="editarUsuario">
            <div class="modal">
                <div class="header">
                    <button class="close" @click="editarUsuario=false">x</button>
                    <h1>EDITAR</h1>
                </div>
                <div class="contenido">
                    <input type="hidden" name="eid" id="eid" v-model="elegido.id">
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

        <div class="contenedor" v-if="eliminarUsuario">
            <div class="modal">
                <div class="header">
                    <button class="close" @click="eliminarUsuario=false">x</button>
                    <h1>ELIMINAR</h1>
                </div>
                <div class="contenido">
                    <p>{{elegido.nombre}}</p>
                    <input type="hidden" name="did" id="did" v-model="elegido.id">
                    <button @click="eliminarUsuario=false;eliminarPaisajes()">SI</button>
                    <button @click="eliminarUsuario=false">NO</button>
                </div>
            </div>
        </div>

    </div>
    <script src="script.js"></script>
</body>
</html>