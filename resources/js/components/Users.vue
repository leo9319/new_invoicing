<template>
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
                                            <button class="btn btn-primary btn-sm" >Edit</button>
                                            <button class="btn btn-danger btn-sm" >Delete</button>
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
	            // errors: new Errors()
			}
		},
		methods: {
            addNewUser() {
                this.message = '';
                this.edit = false;
                this.unsetUser();
                // $('#userModal').modal();
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