<template>
    <main>
        <div class="row mt-5">
            <div class="col-lg-2 offset-lg-2">
                <h3 class="text-center pt-2">Filters</h3>
                <ul>
                    <li>Lorem ipsum</li>
                    <li>Lorem ipsum</li>
                    <li>Lorem ipsum</li>
                    <li>Lorem ipsum</li>
                    <li>Lorem ipsum</li>
                    <li>Lorem ipsum</li>
                    <li>Lorem ipsum</li>
                </ul>
            </div>
            <div class="col-lg-6">
                <h1 class="text-center py-1">Aested Sports</h1>
                <div class="row">
                    <div class="col-lg-3 col-md-4 mt-2" v-for="exercise in exercises" :key="exercise.id">
                        <div class="card">
                            <div class="card-header">{{ exercise.title }}</div>
                            <div class="card-body">{{ exercise.description }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
    export default {
        name: "Catalogue",
        data() {
            return {
                exercises: null,
            }
        },
        created: function() {
            let _this = this;
            $.getJSON('/api/exercise/findall', function (data) {
                _this.exercises = data[0].exercises;
                console.log(data);
            })
        }
    }
</script>

<style scoped>

</style>