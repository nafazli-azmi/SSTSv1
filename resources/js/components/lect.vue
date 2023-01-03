<template>
    <div class="p-0">
        <div class="card">
            <div class="card-header ui-sortable-handle" style="cursor: move;">
                <h3 class="card-title">
                    <i class="fas fa-users mr-2 fa-lg" style="color: #339af0;"></i>
                    Lecturers List
                </h3>
            </div><!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-bordered">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Cluster</th>
                            <th>No. of Students</th>
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users" :key="user.id">
                            <td>{{ user.newid }}</td>
                            <td>{{ user.id }}</td>
                            <td>{{ user.name }}</td>
                            <td>{{ user.cluster_id }}</td>
                            <td>{{ user.nostu }}</td>
                            <!-- <td>
                               <button  class="btn btn-sm btn-danger" @click="deleteUser(user)"> <i class="fa fa-trash"></i> Delete </button>
                            </td> -->

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
