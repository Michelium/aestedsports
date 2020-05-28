<template>
    <main>
        <exercise-form v-if="showForm" @close="showForm = false" @completed="exercisePost" :exercise="exercises[clickedId-1]"></exercise-form>
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <table class="table table-sm table-hover">
                    <thead>
                    <tr>
                        <th style="width: 80%">Naam</th>
                        <th style="width: 20%">acties</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="exercise in exercises" :key="exercise.id">
                        <td>{{ exercise.title }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" @click="showForm = true; clickedId = exercise.id">update</button>
                            <button class="btn btn-danger btn-sm" @click="exerciseDelete(exercise.id)">delete</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <button class="btn btn-sm btn-success" @click="showForm = true; clickedId = 0">Create exercise</button>
            </div>
        </div>
    </main>
</template>

<script>
    import ExerciseForm from "../components/ExerciseForm";

    export default {
        name: "ExerciseList",
        components: {
            ExerciseForm,
        },
        data() {
            return {
                exercises: null,
                showForm: false,
                clickedId: null,
            }
        },
        async created() {
            let _this = this;
            $.getJSON('/api/exercise/findall', function (data) {
                _this.exercises = data[0].exercises;
            });
        },
        methods: {
            exercisePost() {
                let _this = this;
                this.showForm = false;
                $.getJSON('/api/exercise/findall', function (data) {
                    _this.exercises = data[0].exercises;
                });
            },
            exerciseDelete(id) {
                let _this = this;
                $.ajax({
                    url: "/api/exercise/"+id+"/delete",
                    success: function (data) {
                        _this.exercises = data[0].exercises;
                    }
                })
            }
        },
    }
</script>