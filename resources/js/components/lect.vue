<template>
    <div class="p-0">
        <div class="card">
            <div class="card-header ui-sortable-handle" style="cursor: move;">
                <h3 class="card-title">
                    <i class="fas fa-users mr-2 fa-lg" style="color: #339af0;"></i>
                    Lecturers List
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
                            <th>No</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Cluster</th>
                            <th>Action</th>
                            <th>No. of Students</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users" :key="user.id">
                            <td>{{ user.newid }}</td>
                            <td>{{ user.id }}</td>
                            <td>{{ user.name }}</td>
                            <td>{{ user.cluster_id }}</td>
                            <td>
                                <!-- <button class="btn btn-sm btn-info" @click="assignMode(user)"> <i class="fas fa-user-astronaut"></i> Assign Supervisor</button> -->
                                <!-- <button  class="btn btn-sm btn-warning" @click="editUser(user)"> <i class="fa fa-edit"></i> Edit</button>
                                <button  class="btn btn-sm btn-danger" @click="deleteUser(user)"> <i class="fa fa-trash"></i> Delete </button> -->
                            </td>
                            <td>{{ user.nostu }}</td>

                        </tr>
                    </tbody>
                </table>
            </div><!-- /.card-body -->
        </div>

    </div>















</template>

<script>

//for reference error $ not defined
import loading from './loading.vue';
export default {

components: { loading },
    data(){
        return {
            loading: false, 
            searchWord: '',
            svby:{},
            svbies:[],
            user: {},
            users: [],
        }//return
    },//data
    methods:{
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

        getSVby(){
             axios.get('/getSVby').then((response)=>{
                this.svbies = response.data.svbies
            });           
        },
    },//methods
    created(){
        this.getSVby();

        this.getLects();
    }//created
}
</script>
