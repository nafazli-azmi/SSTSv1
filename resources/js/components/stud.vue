<template>
    <div class="p-0">
        <div class="card">
            <div class="card-header ui-sortable-handle" style="cursor: move;">
                <h3 class="card-title">
                    <i class="fas fa-users mr-2 fa-lg" style="color: #339af0;"></i>
                    Students List
                </h3>
                <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                        <li class="nav-item">
                            <div class="input-group mt-0 input-group-md" style="width: 350px;">
                                <input type="text" name="table_search" v-model="searchWord" class="form-control float-right" placeholder="Search by name">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-md" ><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div><!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-bordered">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>no</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Cluster</th>
                            <th>Project Title</th>
                            <th>Supervisor</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users" :key="user.id">
                            <td>{{ user.newid }}</td>
                            <td>{{ user.id }}</td>
                            <td>{{ user.name }}</td>
                            <td>{{ user.cluster_id}}</td>
                            <td>Project Title</td>
                            <td>{{ user.sv_name}}</td>
                            <td>
                                <button class="btn btn-sm btn-info" @click="assignMode(user)"> <i class="fas fa-user-astronaut"></i> Assign Supervisor</button>
                                <!-- <button  class="btn btn-sm btn-warning" @click="editUser(user)"> <i class="fa fa-edit"></i> Edit</button>
                                <button  class="btn btn-sm btn-danger" @click="deleteUser(user)"> <i class="fa fa-trash"></i> Delete </button> -->
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div><!-- /.card-body -->
        </div>

        <!-- Modal Assign SV -->
        <div class="modal fade" id="assignSV" tabindex="-1" aria-labelledby="assignSVModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="assignSVModalLabel" >Assign Supervisor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="assignSV()">            
                        <div class="modal-body">

<!-- update here -->
<!-- update here -->
<!-- update here -->
<!-- update here -->
<!-- update here -->
<!-- update here -->
<!-- update here -->
<!-- update here -->
<!-- update here -->
<!-- update here -->
                            <!-- form sv -->
                            <div class="form-group">
                                <label> Choose Supervisor </label>
                                <b-form-select
                                    v-model="form.asgnSV"
                                    :options="lects"
                                    text-field="name"
                                    value-field="id"  
                                ></b-form-select>
                                <has-error :form="form" field="asgnSV"></has-error>
                            </div>

                        </div>
                        <!-- footer submit/update -->
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-danger"  data-dismiss="modal">Close</button>
                            <b-button variant="primary" v-if="!load" disabled>
                                <b-spinner small type="grow"></b-spinner>
                            </b-button>

                            <button type="submit" class="btn btn-info">Update</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>















</template>

<script>

import $ from "jquery" //for reference error $ not defined
import loading from './loading.vue';
export default {

components: { loading },
    data(){
        return {
            loading: false, 
            searchWord: '',
            load: true,  //button create
            lect: {},
            lects: [],
            user: {},
            users: [],
            form: new Form({
                'id'            : '',
                'asgnSV'        : '',
            })
        }//return
    },//data
    methods:{
        getStuds(){
            this.loading = true;
          //  axios.get("/getStuds")
            axios.get("/getStudents")
            .then((response)=>{ 
                this.loading = false;
                this.users = response.data.users
            }).catch(()=>{
                this.loading = false;
                this.$toastr.e("Unable to load","Error");
            })
        },
        getLects(){
            this.loading = true;
            axios.get("/getLects")
            .then((response)=>{ 
                this.lects = response.data.lects
            }).catch(()=>{
                this.$toastr.e("Unable to load","Error");
            })
        },
        getSvby(){

        },
        assignMode(user){
            this.form.id = user.id;
            $("#assignSV").modal("show");
        },
        assignSV(){
            this.form.put("/assign/sv").then((response)=>{
                this.$toastr.s("User updated successfully","Success");
                Fire.$emit("loadUser");
                $("#assignSV").modal("hide");
                this.form.reset();
            }).catch(() => {               
                this.$toastr.e("Cannot update user, try again","Error");
            });
        },
    },//methods
    created(){
        this.getStuds();
      //  this.getLects();
       // this.getSvby();
        Fire.$on('loadUser', () => {
            this.getStuds();
        });
    }//created
}
</script>
