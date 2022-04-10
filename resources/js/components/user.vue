 <template>
    <div class="p-0">
        <div class="card">
            <div class="card-header ui-sortable-handle" style="cursor: move;">
                <h3 class="card-title">
                    <i class="fas fa-users mr-2 fa-lg" style="color: #339af0;"></i>
                    Users
                </h3>
                    <button class="btn btn-md btn-primary ml-2" @click="getUsers()" > All Users</button>
                    <button class="btn btn-md btn-primary ml-2" @click="getLects()" > Lecturers</button>
                    <button class="btn btn-md btn-primary ml-2" @click="getStuds()" > Students</button>

                <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                        <li class="nav-item mr-1">
                            <button class="btn btn-md btn-primary" @click="createMode()" ><i class="fas fa-plus-circle" ></i> Add User</button>
                        </li>
                        <li class="nav-item">
                            <div class="input-group mt-0 input-group-md" style="width: 350px;">
                                <input type="text" name="table_search" v-model="searchWord" class="form-control float-right" placeholder="Search by name,email">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-md" @click="search"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div><!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-bordered">
                    <thead :style="bgPurple" class=" text-white">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Action</th>
                            <th>Date Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users" :key="user.id">
                            <td>{{ user.id }}</td>
                            <td>{{ user.name }}</td>
                            <td>{{ user.role }}</td>
                            <td>{{ user.email }}</td>
                            <td>
                                <button  class="btn btn-sm btn-warning" @click="editUser(user)"> <i class="fa fa-edit"></i> Edit</button>
                                <button  class="btn btn-sm btn-danger" @click="deleteUser(user)"> <i class="fa fa-trash"></i> Delete </button>
                            </td>
                            <td>{{ user.created_at | date }}</td>
                        </tr>
                    </tbody>
                </table>
            </div><!-- /.card-body -->
            <loading :loading="loading"></loading> <!-- /loading spinner component -->
        </div>

                <!-- Modal Create User-->
        <div class="modal fade" id="createUser" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="createUserModalLabel" v-show="!editMode">Create New User</h5>
                        <h5 class="modal-title" id="createUserModalLabel" v-show="editMode">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="!editMode ? createUser() : updateUser() ">            
                        <div class="modal-body">
                            <div class="form-group"><!-- form name-->
                                <label> Name </label>
                                <input v-model="form.name" type="text" name="name" placeholder="Name"
                                    class="form-control" :class="{'is-invalid': form.errors.has('name')}">
                                <has-error :form="form" field="name"></has-error>                            
                            </div>

                            <div class="form-group"><!-- form email-->
                                <label> Email </label>
                                <input v-model="form.email" type="text" name="email" placeholder="Email"
                                    class="form-control" :class="{'is-invalid': form.errors.has('email')}">
                                <has-error :form="form" field="email"></has-error>                            
                            </div>           
                                    
                            <!-- form password-->
                            <div class="form-group">
                                <label> Password </label>
                                <input v-model="form.password" type="password" name="password" placeholder="Password"
                                    class="form-control" :class="{'is-invalid': form.errors.has('password')}">
                                <has-error :form="form" field="password"></has-error>
                            </div>
                            
                            <!-- form cluster -->
                            <div class="form-group">
                                <label> Choose Cluster </label>
                                <b-form-select
                                    v-model="form.cluster"
                                    :options="clusters"
                                    text-field="name"
                                    value-field="id"  
                                ></b-form-select>
                                <has-error :form="form" field="cluster"></has-error>
                            </div>
                            
                            <!-- form role -->
                            <div class="form-group">
                                <label> Choose Role </label>
                                <b-form-select
                                    v-model="form.role"
                                    :options="roles"
                                    text-field="name"
                                    value-field="id"  
                                ></b-form-select>
                                <has-error :form="form" field="role"></has-error>
                            </div>
                        </div>

                        <!-- footer submit/update -->
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-danger"  data-dismiss="modal">Close</button>
                            <b-button variant="primary" v-if="!load" disabled>
                                <b-spinner small type="grow"></b-spinner>
                                {{ action }}
                            </b-button>
                            <button type="submit" v-if="load" v-show="!editMode" class="btn btn-primary">Create</button>
                            <button type="submit" v-if="load" v-show="editMode" class="btn btn-info">Update</button>

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
            bgPurple:{
                backgroundColor:"#6c72cb"  
            }, 
            bgPinkysh:{
            backgroundColor:"#cb69c1" 
            },
            action: '',
            searchWord: '',
            loading: false, //fetch user from db
            editMode: false,
            load: true,  //button create
            user: {},           
            users: [],
            roles: [],
            permissions: [],
            clusters: [],
            form: new Form({
                'id'            : '',
                'name'          : '',
                'password'      : '',
                'email'         : '',
                'cluster'       : '',
              //  'role'          : '',
                'permissions'   : [],
            })
        }//return
    },//data
    methods:{
        search(){
            this.loading = true;
            axios.get('/search/user?s='+this.searchWord).then((response) =>{
                this.loading = false;
                this.users = response.data.users
            }).catch(() => {
                this.loading = false;
                toast.fire({
                    icon: 'error',
                    title: "search failed"
                })
            })
        },
        createMode(){
            this.form.reset();
            this.editMode =false;
            $("#createUser").modal("show");
        },
        editUser(user){
            this.editMode =true;
            this.form.reset();
            this.form.fill(user);
            this.form.cluster = user.cluster_id;
            this.form.role = user.roles[0].id;
            this.form.permissions = user.userPermissions
            $("#createUser").modal("show");
        },
        getLects(){
            this.loading = true;
            axios.get("/getLects")
            .then((response)=>{ 
                this.loading = false;
                this.users = response.data.users
            }).catch(()=>{
                this.loading = false;
                this.$toastr.e("Unable to load","Error");
            })            
        },
        getStuds(){
            this.loading = true;
            axios.get("/getStuds")
            .then((response)=>{ 
                this.loading = false;
                this.users = response.data.users
            }).catch(()=>{
                this.loading = false;
                this.$toastr.e("Unable to load","Error");
            })            
        },
        getUsers(){
            this.loading = true;
            axios.get("/getAllUsers")
            .then((response)=>{ 
                this.loading = false;
                this.users = response.data.users
            }).catch(()=>{
                this.loading = false;
                this.$toastr.e("Unable to load","Error");
            })
        },
        getRoles(){
            axios.get('/getAllRoles').then((response)=>{
                this.roles = response.data.roles
            });
        },
        getPermissions(){
            axios.get('/getAllPermissions').then((response)=>{
                this.permissions = response.data.permissions
            });
        },
        getClusters(){
             axios.get('/getAllClusters').then((response)=>{
                this.clusters = response.data.clusters
            });           
        },
        createUser(){
            this.action = 'Creating User...'
            this.load = false;
            this.form.post("/account/create").then((response)=>{
                this.load = true;
                this.$toastr.s("User created successfully","Success");
                Fire.$emit("loadUser");
                $("#createUser").modal("hide");
            }).catch(() => {
                this.load = true;                
                this.$toastr.e("Cannot create user, try again","Error");
            });
        },

        updateUser(){
            this.action = 'Updating...'
            this.load = false;
            this.form.put("/account/update/" +this.form.id).then((response)=>{
                this.load = true;
                this.$toastr.s("User updated successfully","Success");
                Fire.$emit("loadUser");
                $("#createUser").modal("hide");
                this.form.reset();
            }).catch(() => {
                this.load = true;                
                this.$toastr.e("Cannot update user, try again","Error");
            });
        },

        deleteUser(user){
            swal.fire({
                title: 'Are you sure?',
                    text: user.name + " will be deleted!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.value) {
                    axios.delete('/delete/user/' + user.id ).then(() =>{
                        toast.fire({
                            icon: 'success',
                            title: user.name +" has been deleted."
                        })
                        Fire.$emit("loadUser");
                    }).catch(()=>{
                        toast.fire({
                            icon: 'error',
                            title: user.name +" was unable to be deleted. Try again."                        
                        })
                    })
                }   
            })
        },

    },
    created(){

        this.getClusters();
        this.getUsers();
        this.getRoles();
        this.getPermissions();
        Fire.$on('loadUser', () => {
            this.getUsers();
        });
    }
}
</script>