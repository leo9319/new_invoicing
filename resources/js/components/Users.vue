<template>
    <div>
    	<div class="app-main__inner">
    	    <div class="row">
    	        <div class="col-md-12">
    	            <div class="main-card mb-3 card">
    	                <div class="card-header mb-3">All Users
    	                    <div class="btn-actions-pane-right">

                                <div roles="group" class="btn-group-sm btn-group" v-if="$can('user-create')">
                                    <button class="btn btn-success" @click="addNewUser"> Add New User</button>
                                </div>

    	                    </div>
    	                </div>

    	                <div class="alert alert-success" v-if="message">
    	                  	<p>{{ message }}</p>
    	                </div>

                        <div class="table-responsive">
                            <div class="container">
                                <table id="users" class="align-middle table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID.</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Roles</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr 
                                            v-for="(user, index) in users"
                                            :key="user.id"
                                        >
                                            <td class="text-muted">{{ user.id }}</td>
                                            <td>{{ user.name }}</td>
                                            <td>{{ user.email }}</td>
                                            <td>
                                                <label class="badge badge-success">{{ user.roles[0].name }}</label>
                                            </td>
                                            <td>
                                                <button 
                                                    class="btn btn-primary btn-sm" 
                                                    @click="editUser(user)"
                                                    v-if="$can('user-edit')"
                                                >
                                                    Edit
                                                </button>
                                                <button 
                                                    class="btn btn-danger btn-sm" 
                                                    @click="deleteUser(user.id)"
                                                    v-if="$can('user-delete')"

                                                >
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

    	                <div class="d-block text-center card-footer">
    	                </div>
    	            </div>
    	        </div>
    	    </div>
    	</div>

        <div class="modal fade" id="userModal" tabindex="-1" roles="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" roles="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="formSubmit(user.id)">

                        <div class="alert alert-danger" v-if="errorMessage">
                            <p>{{ errorMessage }}</p>
                        </div>

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
                                            required="required"
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
        </div>

        <div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
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
        </div>
    </div>
</template>

<script>
	export default {
		data() {
			return {
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
                errorMessage: '',
	            errors: new Errors()
			}
		},
		methods: {
            addNewUser() {
                this.message = '';
                this.errorMessage = '';
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
                this.errorMessage = '';
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
                            this.message = response.data.message;
                            this.getAllUsers();
                            this.errors.clear();
                            $('#userModal').modal('toggle');
                        })
                        .catch(error => { 
                            console.log(error);
                            this.errorMessage = error.response.data.message;
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
                        console.log(error);
                        this.errorMessage = error.response.data.message;
                        this.errors.record(error.response.data.errors);
                    })
                }
            },
            getRoles() {
                axios.get(`api/roles/get-all-roles`)
                    .then(response => this.role_types = response.data)
            },
            unsetUser() {
                for(var key in this.user) {
                    if(key != 'roles') {
                        this.user[key] = '';
                    }
                }
            },
        },
        created() {
            this.getAllUsers();
            this.getRoles();
        }
	}
</script>