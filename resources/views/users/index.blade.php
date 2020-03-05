@extends('layouts.master') 

@section('title', 'All Users') 

@section('content')
<users></users>

@endsection

@section('modal')

{{-- <div class="modal fade" id="userModal" tabindex="-1" roles="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" roles="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form @submit.prevent="formSubmit(user.id)">
                <div class="modal-body">
                    <div class="form-row">

                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="name">Name</label>
                                <input 
                                    v-model="user.name"
                                    id="name"
                                    class="form-control"
                                    placeholder="Full Name"
                                >
                                <span 
                                    class="help text-danger" 
                                    v-if="errors.has('name')" 
                                    v-text="errors.get('name')"
                                ></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="email">Email</label>
                                <input 
                                    v-model="user.email"
                                    id="email"
                                    type="email" 
                                    class="form-control"
                                    placeholder="email"
                                    required="required" 
                                >
                                <span 
                                    class="help text-danger" 
                                    v-if="errors.has('email')" 
                                    v-text="errors.get('email')"
                                ></span>
                            </div>
                        </div>

                    </div>

                    <div class="position-relative form-group">
                        <label for="roles">Roles</label>
                        <select 
                            v-model="user.roles[0].name"
                            class="form-control"
                            required="required" 
                        >
                            <option 
                                v-for="role in role_types"
                                :key="role.id"
                                v-text="role.name"
                            ></option>
                        </select>
                    </div>

                    <div class="form-row">

                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="password">Password</label>
                                <input 
                                    v-model="user.password"
                                    type="password"
                                    class="form-control"
                                    autocomplete="off" 
                                    id="password" 
                                    placeholder="Password" 
                                >
                                <span 
                                    class="help text-danger" 
                                    v-if="errors.has('password')" 
                                    v-text="errors.get('password')"
                                ></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="confirm-password">Password</label>
                                <input 
                                    v-model="user.confirmPassword"
                                    type="password"
                                    class="form-control"
                                    autocomplete="off" 
                                    id="confirm-password"
                                    placeholder="Confirm Password" 
                                >
                                <span 
                                    class="help text-danger" 
                                    v-if="errors.has('password')" 
                                    v-text="errors.get('password')"
                                ></span>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div> --}}

{{-- <div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="exampleModalLongTitle">WARNING!</h5>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this user?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary" @click="onDeleteUser(user.id)">Yes</button>
            </div>
        </div>
    </div>
</div> --}}

@endsection

@section('footer_scripts')

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
{{-- <script>
    class Errors {
        constructor() {
            this.errors = {};
        }

        record(errors) {
            this.errors = errors;
        }

        has(field) {
            return this.errors.hasOwnProperty(field);
        }

        get(field) {
            if(this.errors[field]) {
                return this.errors[field][0];
            }
        }

        clear(field) {
        if (field) {
            delete this.errors[field];

            return;
        }

        this.errors = {};
    }
    }

    var app = new Vue({
        el: '#app',
        data: {
            users: [],
            user: {
                id: '',
                name: '',
                email: '',
                roles: [{ name: 'Admin'}],
                password: '',
                confirmPassword: '',

            },
            role_types: [],
            edit: false,
            message: '',
            errors: new Errors()
        },
        methods: {
            addNewUser() {
                this.message = '';
                this.edit = false;
                this.unsetUser();
                $('#userModal').modal();
            },
            editUser(user) {
                this.user.id = user.id;
                this.user.name = user.name;
                this.user.email = user.email;
                this.user.roles = user.roles;
                this.user.password = '';
                this.user.confirmPassword = '';
                this.edit = true;
                this.message = '';
                $('#userModal').modal();
            },
            deleteUser(id) {
                this.user.id = id;
                $('#deleteUserModal').modal();
            },
            onDeleteUser(id) {
                axios.delete(`api/users/${id}`)
                    .then(response => { 
                        this.message = response.data.message;
                        this.getAllUsers();
                    })
                    .catch(error => console.log(response.data.message));
                $('#deleteUserModal').modal('toggle');
            },
            getAllUsers() {
                axios.get(`api/users/get-all-users`)
                    .then(response => this.users = response.data)
            },
            formSubmit() {
                if(!this.edit) {
                    axios.post(`api/users/store`, {
                            name: this.user.name,
                            email: this.user.email,
                            roles: this.user.roles[0].name,
                            password: this.user.password,
                            confirmPassword: this.user.confirmPassword
                        })
                        .then(response => {
                            this.getAllUsers();
                            this.errors.clear();
                            $('#userModal').modal('toggle');
                        })
                        .catch(error => { 
                            console.log(error.response.data);
                            this.message = error.response.data.message;
                            this.errors.record(error.response.data.errors);
                        })
                } else {
                    axios.put(`api/users/${this.user.id}`, {
                        name: this.user.name,
                        email: this.user.email,
                        roles: this.user.roles[0].name,
                        password: this.user.password,
                        confirmPassword: this.user.confirmPassword
                    })
                    .then(response => {
                        this.message = response.data.message;
                        this.getAllUsers();
                        this.errors.clear();
                        $('#userModal').modal('toggle');
                    })
                    .catch(error => { 
                        console.log(error.response.data);
                    })
                }
            },
            getRoles() {
                axios.get(`api/roles/get-all-roles`)
                    .then(response => this.role_types = response.data)
            },
            unsetUser() {
                for(key in this.user) {
                    if(key != 'roles') {
                        this.user[key] = '';
                    }
                }
            }
        },
        created() {
            this.getAllUsers()
            this.getRoles()
        }
    })
</script> --}}

@endsection