<template>
    <main>
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">

                    <div class="modal-header">
                        <slot name="header">
                            Exercise form
                        </slot>
                    </div>

                    <div class="modal-body">
                        <slot name="body">
                            <form @submit.prevent="onSubmit">
                                <span class="text-danger" v-text="errors"></span>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" id="title" class="form-control" v-model="title">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea type="text" id="description" class="form-control" rows="5" v-model="description"></textarea>
                                </div>
                                <button type="submit" class="btn btn-success btn-sm">Submit</button>
                            </form>
                        </slot>
                    </div>

                    <div class="modal-footer">
                        <slot name="footer">
                            <button class="modal-default-button btn btn-danger btn-sm" @click="$emit('close')">
                                Close
                            </button>
                        </slot>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
    export default {
        name: "ExerciseForm",
        data() {
            return {
                title: '',
                description: '',
                errors: '',
                isLoading: false,
            }
        },
        props: {
            exercise: {
                type: Object,
                required: false,
            }
        },
        mounted() {
            this.fillForm();
        },
        methods: {
            onSubmit() {
                this.isLoading = true;
                this.postExercise();
            },
            postExercise() {
                let _this = this;
                let url = this.exercise !== undefined ? "/api/exercise/"+this.exercise.id : "/api/exercise"
                $.ajax({
                    method: "POST",
                    url: url,
                    data: _this.$data,
                })
                    .always(function (response) {
                        _this.title = '';
                        _this.description = '';
                        _this.isLoading = false;
                        _this.$emit('completed', response.data);
                    })
                    .fail(function (response) {
                        _this.errors = response.response.data.errors;
                        _this.isLoading = false;
                    });
            },
            fillForm() {
                if (this.exercise !== undefined) {
                    this.title = this.exercise.title;
                    this.description = this.exercise.description;
                }
            }
        }
    }
</script>

<style scoped>
    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: table;
        transition: opacity 0.3s ease;
    }

    .modal-wrapper {
        display: table-cell;
        padding-top: 10%;
    }

    .modal-container {
        width: 70%;
        margin: 0 auto;
        padding: 20px 30px;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
        transition: all 0.3s ease;
        font-family: Helvetica, Arial, sans-serif;
    }

    .modal-header h3 {
        margin-top: 0;
        color: #42b983;
    }

    .modal-body {
        margin: 20px 0;
    }

    .modal-default-button {
        float: right;
    }

    .modal-enter {
        opacity: 0;
    }

    .modal-leave-active {
        opacity: 0;
    }

    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }
</style>