<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        <a class="btn btn-primary" href="/todo">Todo (Test)</a>
                        <a class="btn btn-primary" href="/infinite-loading">Infinite Loading and Draggable (Test)</a> | 
                        <a class="btn btn-danger" href="/user">Example (Learn)</a>
                        <b-dropdown variant="danger" right text="Datatable (Learn)">
                            <b-dropdown-item href="/intro1">intro</b-dropdown-item>
                            <b-dropdown-item href="/intro2">intro2</b-dropdown-item>
                        </b-dropdown>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
