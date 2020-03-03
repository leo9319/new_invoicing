@extends('layouts.master') 

@section('title', 'Test') 

@section('content')

<div class="app-main__inner">
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">

                <div class="card-header">Tests
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            <a class="btn btn-success" href="{{ route('tests.create') }}"> Create New</a>
                        </div>
                    </div>
                </div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                  <p>{{ $message }}</p>
                </div>
                @endif

                <div class="card-body">
                    <div class="table-responsive">
                        <div class="container">
                            <table id="tests" class="align-middle mb-0 table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID.</th>
                                        <th>Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(test, index) in tests">
                                        <td class="text-muted">@{{ index + 1 }}</td>
                                        <td>@{{ test.name }}</td>
                                        <td>
                                            <button class="btn btn-info button-2" @click="editTest(test)">Edit</button>
                                            <button class="btn btn-danger button-2" @click="deleteTest(test.id)">Delete</button>                                          
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="d-block text-center card-footer">
                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection

@section('modal')

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Name</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form @submit.prevent="formSubmit">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" v-model="test.name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('footer_scripts')

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>

<script>
    var app = new Vue({
        el: '#app',
        data: {
            tests: [],
            test: {
                id: '',
                name: ''
            }
        },
        created() {
            this.fetchTests();
        },
        methods: {
            fetchTests() {
                axios.get('api/test')
                    .then(response => this.tests = response.data.data);
            },
            deleteTest(id) {
                axios.delete(`api/test/${id}`)
                    .then(() => this.fetchTests());
            },
            editTest(test) {
                $('#exampleModal').modal();
                this.test.id = test.id;
                this.test.name = test.name;
            },
            formSubmit() {
                axios.put(`api/test/${this.test.id}`, { name: this.test.name })
                    .then(() => this.fetchTests());
                $('#exampleModal').modal('toggle');
            }
            
        }
    })
</script>

@endsection