<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Trip Builder
                    </div>

                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item" v-for="trip in trips">
                                trip #{{ trip.id }}
                                <br />
                                <a :href="'/trips/' + trip.id" class="btn btn-primary">Manage</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data() {
            return{
                trips: {}
            }
        },
        created() {
            this.$http.get('/api/trips/').then((response) => {
                this.trips = response.body;
            }, (response) =>{

            });
        },
    }
</script>
